<?php

class Base_Admin extends Controller_Template
{
    public function before()
    {
        parent::before(); // Without this line, templating won't work!

		if(!Session::get('login_hash'))
		{
			Response::redirect('/user/login');
		}
		$user = Model_User::find()->where('login_hash', Session::get('login_hash'))->get_one();
		if($user->group < 100)
		{
			$response = new Response();
			$response->set_header("HTTP/1.1", "403 Forbidden");
			return $response;
		}
	}
}
