<?php

class Controller_Game extends Base_Manager
{

	public function action_play($crypt)
	{
		$this->template->js = array("https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", 'game.js');
		$game_id = Crypt::decode($crypt);
		$game = Model_Game::find()->where('id', $game_id)->related('parent')->get_one();
		$data['players'] = json_decode($game->players, true);
		$data['type'] = $game->parent->name;
		$data['username'] = Session::get('username');
		if($configuration = Session::get('board'))
		{
			$configuration = unserialize($configuration);
			$data['squares'] = Model_Square::find();
			foreach ($configuration as $square) {
				$data['squares']->or_where('id', $square);
			}
			$data['squares'] = $data['squares']->get();
		}
		else
		{
			$data['squares'] = Model_Square::find()->where('type', $game->type)->order_by(DB::expr('RAND()'))->limit(24)->get();
			$configuration = array();
			foreach($data['squares'] as $square)
			{
				$configuration[] = $square->id;
			}
			$configuration = serialize($configuration);
			Session::set('board', $configuration);
			Session::set('moves', array());
		}

		$data['moves'] = Session::get('moves');
		$this->template->title = 'Game &raquo; Index';
		$this->template->content = View::forge('game/index', $data);
	}
	public function action_create($type)
	{
		$this->template = null;
		$game = Model_Game::forge();
		$players = array();
		$players[] = Session::get('username');
		$game->players = json_encode($players);
		$game->creator = Model_User::find()->where('login_hash', Session::get('login_hash'))->get_one()->id;
		$game->type = $type;
		$game->save();

		$crypt = Crypt::encode($game->id);
		Session::set('game', $crypt);
		Response::redirect('/game/play/'.$crypt);
	}
	public function action_join($crypt)
	{
		$this->template = null;
		$game_id = Crypt::decode($crypt);
		$game = Model_Game::find_by_id($game_id);
		Session::set('game', $crypt);
		$players = json_decode($game->players, true);
		$players[] = Session::get('username');
		$game->players = json_encode($players);
		$game->chat = $this->add_chat($game->chat, "<p class='action'>".Session::get('username')." has joined the game.</p>");
		$game->save();
		Response::redirect('/game/play/'.$crypt);
	}
	public function action_move($crypt)
	{
		$this->template = null;
		$game = Model_Game::find_by_id(Crypt::decode($crypt));
		$moves = json_decode($game->moves, true);
		$moves[] = Input::post('square');
		$game->moves = json_encode((array)$moves);
		$game->save();
	}
	public function action_unmove($crypt)
	{
		$this->template = null;
		$game = Model_Game::find_by_id(Crypt::decode($crypt));
		$moves = json_decode($game->moves, true);
		if (($key = array_search(Input::post('square'), $moves)) !== false) {
		    unset($moves[$key]);
		}
		$game->moves = json_encode($moves);
		$game->save();
	}
	public function action_update($crypt)
	{
		$game = Model_Game::find_by_id(Crypt::decode($crypt));
		$return['players'] = json_decode($game->players, true);
		$return['moves'] = json_decode($game->moves, true);
		$return['winner'] = ($game->winner) ? $game->winner : false;
		$return['chat'] = ($game->chat) ? unserialize($game->chat) : false;
		return json_encode($return);
	}
	public function action_leave($crypt)
	{
		$game = Model_Game::find_by_id(Crypt::decode($crypt));
		$players = json_decode($game->players, true);
		if (($key = array_search(Session::get('username'), $players)) !== false) {
		    unset($players[$key]);
		}
		$game->players = json_encode((array)$players);
		$game->chat = $this->add_chat($game->chat, "<p class='action'>".Session::get('username')." has left.</p>");
		$game->save();
		Response::redirect('/type/'.$game->type);
	}
	public function action_winner($crypt)
	{
		$this->template = null;
		$game = Model_Game::find_by_id(Crypt::decode($crypt));
		$game->winner = Session::get('username');
		$game->save();
	}
	public function action_chat($crypt)
	{
		$this->template = null;
		$game = Model_Game::find_by_id(Crypt::decode($crypt));
		$game->chat = $this->add_chat($game->chat, "<p><strong>".Session::get('username').": </strong> ".htmlspecialchars(Input::post('text'))."</p>");
		$chat = unserialize($game->chat);
		$game->save();

		echo json_encode($chat);
	}
	private function add_chat($chat, $string)
	{
		$chatArray = unserialize($chat);
		$chatArray[] = $string;
		$return = serialize($chatArray);
		return $return;
	}
}
