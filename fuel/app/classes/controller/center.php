<?php

class Controller_Center extends Controller_Template
{
	
    public $auth;
	public function before()
	{
		parent::before();
		$this->auth = Auth::instance('Memberauth');
		if (Config::get('auth.driver', 'Memberauth') == 'Ormauth')
		{
			$this->current_user = $this->auth->check() ? Model\Auth_User::find_by_username($this->auth->get_screen_name()) : null;
		}
		else
		{
			$this->current_user = $this->auth->check() ? Model_Member::find_by_username($this->auth->get_screen_name()) : null;
		}
		// Set a global variable so views can use it
		View::set_global('current_user', $this->current_user);
		if (! in_array(Request::active()->action, array('signin', 'signup')))
		{
			//$this -> membercheck();
		}
	}
    
    private function membercheck()
    {
    	if ($this->auth->check())
		{
			//$admin_group_id = Config::get('auth.driver', 'Simpleauth') == 'Ormauth' ? 6 : 100;
			//if ( Request::active()->controller == 'Controller_Member' and ! Auth::member($admin_group_id))
			if ( Request::active()->controller == 'Controller_Member')
			{
				Session::set_flash('error', e('You don\'t have access to the admin panel'));
				Response::redirect('/u');
			}
		}
		else
		{
			Response::redirect('/signin');
		}
    }

	public function action_signin()
	{
		// Already logged in
		$this->auth->check() and Response::redirect('/u');
		$val = Validation::forge();
		if (Input::method() == 'POST')
		{
			$val->add('username', 'Email or Username')
			    ->add_rule('required');
			$val->add('password', 'Password')
			    ->add_rule('required');
            
			if ($val->run())
			{
				// check the credentials. This assumes that you have the previous table created
				if ($this->auth->check() or $this->auth->login(Input::post('username'), Input::post('password')))
				{
					// credentials ok, go right in
					if (Config::get('auth.driver', 'Memberauth') == 'Ormauth')
					{
						$current_user = Model\Auth_Member::find_by_username($this->auth->get_screen_name());
					}
					else
					{
						$current_user = Model_Member::find_by_username($this->auth->get_screen_name());
					}
					Session::set_flash('success', e('Welcome denglu, '.$current_user->username));
					Response::redirect('/u');
				}
				else
				{
					$this->template->set_global('login_error', 'Fail');
				}
			}
		}
		return Response::forge(View::forge('member/signin', array('val' => $val), false));
	}

	/**
	 * The logout action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_signout()
	{
		$this->auth->logout();
		Response::redirect('/signin');
	}
    
    public function action_signup()
	{
		$this->auth->check() and Response::redirect('/u');
		$val = Validation::forge();
		if (Input::method() == 'POST')
		{
			$val->add('username', 'Email or Username')
			    ->add_rule('required');
			$val->add('password', 'Password')
			    ->add_rule('required');
            
			if ($val->run())
			{
				// check the credentials. This assumes that you have the previous table created
				$username = Input::post('username');
				$password = Input::post('password');
				try{
				    $user = $this->auth->create_user($username, $password, $username);
					if ($this->auth->check() or $user)
					{
						$current_user = Model_Member::find_by_username($this->auth->get_screen_name());
						Session::set_flash('success', e('Welcome singnup, '.$current_user->username));
						Response::redirect('/u');
					}
					else
					{
						$this->template->set_global('signup_error', 'Fail');
					}
				}catch (Exception $e){
					$this->template->set_global('signup_error', 'Fail');
				}
				
			}
		}
		return Response::forge(View::forge('member/signup', array('val' => $val), false));
	}

	/**
	 * The index action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_changepassword()
	{
		$val = Validation::forge();
		if (Input::method() == 'POST')
		{
			$val->add('old_password', 'Password')
			    ->add_rule('required');
			$val->add('new_password', 'Password')
			    ->add_rule('required');
            
			if ($val->run())
			{
				// check the credentials. This assumes that you have the previous table created
				$old_password = Input::post('old_password');
				$new_password = Input::post('new_password');
				$res = $this->auth->change_password($old_password, $new_password, $username);
				if ($res)
				{
					$current_user = Model_Member::find_by_username($this->auth->get_screen_name());
					Session::set_flash('success', e('Welcome singnup, '.$current_user->username));
					Response::redirect('/u');
				}
				else
				{
					$this->template->set_global('signup_error', 'Fail');
				}
			}
		}
		return Response::forge(View::forge('member/change_password', array('val' => $val), false));
	}
	/**
    * forgot the password
    * it will send a email to the user Email
    * @access public
	* @return void
	*/
	public function action_forgotpassword()
	{
		
		//$this->template->title = 'Dashboard';
		return Response::forge(View::forge('member/forgot'));
	}

}

/* End of file admin.php */
