<?php

class Controller_Manager extends Base
{
	public function action_type()
	{
		$data['games'] = Model_Game::find()->where('winner', null)->get();
		foreach ($data['games'] as $game) {
			$game->players = json_decode($game->players, true);
		}
		$this->template->title = 'Manager &raquo; Index';
		$this->template->content = View::forge('manager/index', $data);		
	}
	public function action_index()
	{

		// $type = new Model_Type();
		// $type->name = "Novatnak Bingo";
		// $type->catagory = "not implimented";
		// $type->save();
		// die();
	}

}
