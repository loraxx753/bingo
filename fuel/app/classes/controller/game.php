<?php

class Controller_Game extends Controller_Template
{

	public function action_play($crypt)
	{
		$this->template->js = array("https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", 'game.js');
		$game_id = Crypt::decode($crypt);
		$game = Model_Game::find_by_id($game_id);
		$data['players'] = json_decode($game->players, true);

		$data['username'] = Session::get('username');
		if(Session::get('board'))
		{
			$board = Model_Board::find_by_id(Session::get('board'));
			$configuration = json_decode($board->configuration, true);
			$data['squares'] = Model_Square::find();
			foreach ($configuration as $square) {
				$data['squares']->or_where('id', $square);
			}
			$data['squares'] = $data['squares']->get();
		}
		else
		{
			$data['squares'] = Model_Square::find()->order_by(DB::expr('RAND()'))->limit(24)->get();
			$configuration = array();
			foreach($data['squares'] as $square)
			{
				$configuration[] = $square->id;
			}
			$configuration = json_encode($configuration);
			$board = Model_Board::find()->where('configuration', $configuration)->get_one();

			if($board == NULL)
			{
				$board = Model_Board::forge();
				$board->configuration = $configuration;
				$board->save();
			}
			Session::set('board', $board->id);
			Session::set('moves', array());
		}

		$data['moves'] = Session::get('moves');
		$this->template->title = 'Game &raquo; Index';
		$this->template->content = View::forge('game/index', $data);
	}
	public function action_create()
	{
		$this->template = null;
		$game = Model_Game::forge();
		$players = array();
		$players[] = Session::get('username');
		$game->players = json_encode($players);
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
		$game->save();
		Response::redirect('/manager');
	}
	public function action_winner($crypt)
	{
		$this->template = null;
		$game = Model_Game::find_by_id(Crypt::decode($crypt));
		$game->winner = Session::get('username');
		$game->save();
	}
}
