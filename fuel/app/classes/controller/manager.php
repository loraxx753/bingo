<?php

class Controller_Manager extends Base
{

	public function action_index()
	{

		$data['games'] = Model_Game::find()->where('winner', null)->get();
		foreach ($data['games'] as $game) {
			$game->players = json_decode($game->players, true);
		}
		$this->template->title = 'Manager &raquo; Index';
		$this->template->content = View::forge('manager/index', $data);
	}

}
