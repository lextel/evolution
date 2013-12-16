<?php

class Controller_Center extends Controller_Template
{
	public $template = 'layout';
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
        echo $this->auth->check();
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
				Response::redirect('/center');
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
		$this->auth->check() and Response::redirect('/center');
		$val = Validation::forge();
        echo $this->auth->check();
		if (Input::method() == 'POST')
		{
			$val->add('username', 'Email or Username')
			    ->add_rule('required');
			$val->add('password', 'Password')
			    ->add_rule('required');
            var_dump($val);
			if ($val->run())
			{
				//$auth = $this->auth->instance();
                var_dump($this->auth->check());
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
					Response::redirect('/center');
				}
				else
				{
					$this->template->set_global('login_error', 'Fail');
				}
			}
		}

		//$this->template->title = 'Login';
		return Response::forge(View::forge('member/signin', array('val' => $val), false));
	}

	/**
	 * The logout action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_logout()
	{
		$this->auth->logout();
		Response::redirect('/signin');
	}
    
    public function action_signup()
	{
		$val = '';
		return Response::forge(View::forge('member/signup', array('val' => $val), false));
	}

	/**
	 * The index action.
	 *
	 * @access  public
	 * @return  void
	 */
	public function action_index()
	{
		$this->template->title = 'Dashboard';
		$this->template->content = View::forge('member/index');
	}

}

/* End of file admin.php */
