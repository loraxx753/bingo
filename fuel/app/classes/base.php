<?php

class Base extends Controller_Template
{
    public function before()
    {
        parent::before(); // Without this line, templating won't work!

		if(!Session::get('login_hash'))
		{
			Response::redirect('/user/login');
		}
	}
}
