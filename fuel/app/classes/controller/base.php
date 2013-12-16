<?php

class Controller_Base extends Controller_Template {
    //public 
    public $auth;
	public function before()
	{
		parent::before();
        $this->auth = Auth::instance('Simpleauth');
        //echo $auth->check();
        //echo $auth->get_screen_name();
		// Assign current_user to the instance so controllers can use it
		if (Config::get('auth.driver', 'Simpleauth') == 'Ormauth')
		{
			echo 22222;
			$this->current_user = $this->auth->check() ? Model\Auth_User::find_by_username($this->auth->get_screen_name()) : null;
		}
		else
		{
			echo 1111, $this->auth->check(), $this->auth->get_screen_name();
			$this->current_user = $this->auth->check() ? Model_User::find_by_username($this->auth->get_screen_name()) : null;
		}

		// Set a global variable so views can use it
		//echo $this->current_user.'ssssssssssssssssssssssssssssssssssssssssssssssssss';

		View::set_global('current_user', $this->current_user);
	}

}