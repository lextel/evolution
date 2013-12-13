<?php

class Controller_Center extends Controller_Base
{
	public $template = 'admin/template';

	public function before()
	{
		parent::before();
		
	}
    
    private function countcheck()
    {
    	if (Auth::check())
		{
			$admin_group_id = Config::get('auth.driver', 'Simpleauth') == 'Ormauth' ? 6 : 100;
			if ( Request::active()->controller == 'Controller_Admin_Users' and ! Auth::member($admin_group_id))
			{
				Session::set_flash('error', e('You don\'t have access to the admin panel'));
				Response::redirect('/signin');
			}
		}
		else
		{
			Response::redirect('/signin');
		}
    }

	public function action_login()
	{
		// Already logged in
		Auth::check() and Response::redirect('/account/index');

		$val = Validation::forge();

		if (Input::method() == 'POST')
		{
			$val->add('email', 'Email or Username')
			    ->add_rule('required');
			$val->add('password', 'Password')
			    ->add_rule('required');

			if ($val->run())
			{
				$auth = Auth::instance();

				// check the credentials. This assumes that you have the previous table created
				if (Auth::check() or $auth->login(Input::post('email'), Input::post('password')))
				{
					// credentials ok, go right in
					if (Config::get('auth.driver', 'Simpleauth') == 'Ormauth')
					{
						$current_user = Model\Auth_User::find_by_username(Auth::get_screen_name());
					}
					else
					{
						$current_user = Model_User::find_by_username(Auth::get_screen_name());
					}
					Session::set_flash('success', e('Welcome, '.$current_user->username));
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
		Auth::logout();
		Response::redirect('/signup');
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
		$this->template->content = View::forge('account/index');
	}

}

/* End of file admin.php */
