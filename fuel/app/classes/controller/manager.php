<?php

class Controller_Manager extends Base_Manager
{
	public function action_category($category)
	{
		$data = array();
		$data['types'] = Model_Type::find()->where('category', $category)->related('types')->get();
		$this->template->title = 'Manager &raquo; Index';
		$this->template->content = View::forge('manager/category', $data);
	}
	public function action_type($type)
	{
		$data = array();
		$data['games'] = array();
		$data['type_id'] = $type;
		$type = Model_Type::find()->where('id', $type)->get_one();
		$games = Model_Game::find()->where('type', $type->id)->where('winner', null)->get();
		if($games)
		{
			$data['games'] = $games;
			foreach ($data['games'] as $game) {
				$game->players = json_decode($game->players, true);
			}
		}
		$data['type'] = $type->name;
		$this->template->title = 'Manager &raquo; Index';
		$this->template->content = View::forge('manager/type', $data);		
	}
	public function action_index()
	{
		$data['categories'] = Model_Category::find()->get();
		$this->template->title = 'Manager &raquo; Index';
		$this->template->content = View::forge('manager/index', $data);		
	}

}
