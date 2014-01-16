<?php

class Controller_Baseend extends Controller_Template {
    //public
    public $auth;
    public function before()
    {
        parent::before();
        $this->auth = Auth::instance('Simpleauth');
        // Assign current_user to the instance so controllers can use it
        if (Config::get('auth.driver', 'Simpleauth') == 'Ormauth')
        {
            $this->current_user = $this->auth->check() ? Model\Auth_User::find_by_username($this->auth->get_screen_name()) : null;
        }
        else
        {
            $this->current_user = $this->auth->check() ? Model_User::find_by_username($this->auth->get_screen_name()) : null;
        }

        // Set a global variable so views can use it
        View::set_global('current_user', $this->current_user);
    }
}
