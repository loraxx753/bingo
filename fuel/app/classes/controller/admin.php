<?php

class Controller_Admin extends Base_Admin
{
	public function action_index()
	{
		$user = Model_User::find()->where('login_hash', Session::get('login_hash'))->get_one();
		if($user->group < 100)
		{
			$response = new Response();
			$response->set_header("HTTP/1.1", "403 Forbidden");
			return $response;
		}
		\Config::load('simpleauth');
		$data['groups'] = \Config::get('groups');
		$data['catagories'] = Model_Category::find()->get();
		$data['users'] = Model_User::find()->get();

		$this->template->js = array("https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", 'admin.js');
		$this->template->title = "Admin Panel";
		$this->template->content = View::forge('admin/index', $data);
	}

	public function action_category($action, $id = null)
	{
		switch($action)
		{
			case "add":
				$this->add_category();
				break;
			case "delete":
				$this->delete_category($id);
				break;
		}
		Response::redirect('/admin');
	}
	private function add_category()
	{
		$name = Input::post();
		$category = Model_Category::forge();
		$category->name = $name;
		try 
		{
			$category->save();
		}
		catch(Exception $e)
		{
			Session::set_flash('error', array("Problem saving the category!"));
			return;
		}
		Session::set_flash('success', array("Category has been added."));
		return;
	}
	private function delete_category($id)
	{
		$category = Model_Category::find_by_id($id);

		try 
		{
			$category->delete();
		}
		catch(Exception $e)
		{
			Session::set_flash('error', array("Problem deleting the category!"));
			return;
		}
		Session::set_flash('success', array("Category has been deleted."));
		return;
	}
}