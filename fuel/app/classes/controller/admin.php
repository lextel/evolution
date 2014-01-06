<?php

class Controller_Admin extends Controller_Baseend
{
    public $template = 'admin/template';

    public function before()
    {
        parent::before();
        if (! in_array(Request::active()->action, array('login', 'logout')))
        {
            $this -> admincheck();
        }
    }

    private function admincheck()
    {
        if ($this->auth->check())
        {
            $admin_group_id = Config::get('auth.driver', 'Simpleauth') == 'Ormauth' ? 6 : 100;
            if ( Request::active()->controller == 'Controller_Admin_Users' and ! $this->auth->member($admin_group_id))
            {
                Session::set_flash('error', e('您没有权限'));
                Response::redirect('admin');
            }
        }
        else
        {
            Response::redirect('admin/login');
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
                    if (Config::get('auth.driver', 'Simpleauth') == 'Ormauth')
                    {
                        $current_user = Model\Auth_User::find_by_username($this->auth->get_screen_name());
                    }
                    else
                    {
                        $current_user = Model_User::find_by_username($this->auth->get_screen_name());
                    }
                    $this->auth->remember_me();
                    Session::set_flash('success', e('欢迎您, '.$current_user->username));
                    Response::redirect('admin');
                }
                else
                {
                    $this->template->set_global('login_error', '登陆失败');
                }
            }
        }

        $this->template->title = '管理登陆';
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
        Response::redirect('/admin/login');
    }


    /**
     * The index action.
     *
     * @access  public
     * @return  void
     */
    public function action_index()
    {
        $this->template->set_global('breadcrumb', []);
        $this->template->title = 'Dashboard';
        $this->template->content = View::forge('admin/dashboard');
    }

}

/* End of file admin.php */
