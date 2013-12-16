<?php

class Controller_Admin extends Controller_Base
{
	public $template = 'admin/template';
    //public $auth;
    
	public function before()
	{
		parent::before();
        //$this->auth = Auth::instance('Simpleauth');
		if (! in_array(Request::active()->action, array('login', 'logout')))
		{
			$this -> admincheck();
		}
	}
    
    private function admincheck()
    {
    	//$this->auth = Auth::instance('Simpleauth');
    	if ($this->auth->check())
		{    
			if ($this->auth->check())
			{
				$admin_group_id = Config::get('auth.driver', 'Simpleauth') == 'Ormauth' ? 6 : 100;
				if ( ! $this->auth->member($admin_group_id))
				{
					Session::set_flash('error', e('You don\'t have access to the admin panel'));
					Response::redirect('/');
				}
			}
			else
			{
				Response::redirect('admin/login');
			}
		}
	}

	public function action_login()
	{
		// Already logged in
		//$this->auth = Auth::instance('Simpleauth');
		$this->auth->check() and Response::redirect('admin');   
        $val = Validation::forge();

        if (Input::method() == 'POST')
        {
            $val->add('email', 'Email or Username')
                ->add_rule('required');
            $val->add('password', 'Password')
                ->add_rule('required');

			if ($val->run())
			{

				// check the credentials. This assumes that you have the previous table created
				if ($this->auth->check() or $this->auth->login(Input::post('email'), Input::post('password')))
				{
					// credentials ok, go right in
					var_dump(Config::get('auth.driver', 'Simpleauth'));
					if (Config::get('auth.driver', 'Simpleauth') == 'Ormauth')
					{
						echo $this->auth->get_screen_name();
						$current_user = Model\Auth_User::find_by_username($this->auth->get_screen_name());
					}
					else
					{
						$current_user = Model_User::find_by_username($this->auth->get_screen_name());
					}
					$this->auth->remember_me();
					Session::set_flash('success', e('Welcometest1, '.$current_user->username));
					Response::redirect('admin');
				}
				else
				{
					$this->template->set_global('login_error', 'Fail');
				}
			}
		}

        $this->template->title = 'Login';
        $this->template->content = View::forge('admin/login', array('val' => $val), false);
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
		Response::redirect('admin');
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
        $this->template->content = View::forge('admin/dashboard');
    }

}

/* End of file admin.php */
