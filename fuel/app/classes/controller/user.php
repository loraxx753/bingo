<?php

class Controller_User extends Controller_Template
{

	public function action_login()
	{
		$data = array();
		if(Input::post('login'))
		{
	        // first of all, let's get a auth object
	        $auth = Auth::instance();

	        // check the credentials. This assumes that you have the previous table created and
	        // you have used the table definition and configuration as mentioned above.
	        if ($auth->login())
	        {
	            // credentials ok, go right in
	            Response::redirect('/');
	        }
	        else
	        {
	            // Oops, no soup for you. try to login again. Set some values to
	            // repopulate the username field and give some error text back to the view
	            $data['username']    = Input::post('username');
	            $data['login_error'] = 'Wrong username/password combo. Try again';
	        }
		}
		$this->template->title = 'User &raquo; Login';
		$this->template->content = View::forge('user/login', $data);
	}

	public function action_logout()
	{
		$auth = Auth::instance();
		if($auth->logout())
		{
			Session::set_flash('success', array('You successfully logged out!'));
			Response::redirect('/user/login');
		}
	}

	public function action_profile()
	{
		$this->template->title = 'User &raquo; Profile';
		$this->template->content = View::forge('user/profile');
	}

	public function action_register()
	{
		if(Input::post('register'))
		{
			$error = array();
			$post = Input::post();
			foreach($post as $item)
			{
				if(empty($item))
				{
					$error[] = "You must fill everything out";
				}
				break;
			}
			if($post['password'] != $post['password2'])
			{
				$error[] = 'Password mismatch';
			}
			if(empty($post['password']) || empty($post['password2']))
			{
				$error[] = 'Passwords cannot be blank!';
			}
			if(!preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.([A-Za-z]{2,4}|museum)$/", $post['email']))
			{
				$error[] = "Email not formatted";
			}
			if(strlen($post['password']) < 5)
			{
				$error[] = "Password must be longer than 5 characters";
			}
			if(strlen($post['username']) < 5)
			{
				$error[] = "Username must be longer than 5 characters";
			}


			if(count($error) == 0)
			{
				$auth = Auth::instance();
				
				try
				{
					$auth->create_user($post['username'], $post['password'], $post['email']);
				}
				catch(Auth\SimpleUserUpdateException $e)
				{
					$error[] = $e->getMessage();
				}				
			}
			if(count($error) == 0)
			{
				Session::set_flash('success', array("You have successfully registered!"));
			}
			else
			{
				Session::set_flash('error', $error);
				Session::set_flash('info', array('username' => $post['username'], 'email' => $post['email']));
			}
		}

		$this->template->title = 'User &raquo; Register';
		$this->template->content = View::forge('user/register', $data);
	}

}
