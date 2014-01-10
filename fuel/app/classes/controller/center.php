<?php

class Controller_Center extends Controller_Frontend
{
    //public $auth;
    public function before()
    {
        parent::before();
        if (! in_array(Request::active()->action, array('signin', 'signup')))
        {
            $this -> membercheck();
        }
        $this->template->layout = View::forge('memberlayout');
    }

    private function membercheck()
    {
        if (!$this->auth->check())
        {
            Response::redirect('/signin');
        }
    }

    public function action_signin()
    {
        // Already logged in
        $this->auth->check() and Response::redirect('/u');
        $val = Validation::forge();
        $this->template->set_global('error', '');
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
                    if (!$current_user->nickname){
                        Response::redirect('/u/getnickname');
                    }
                    Session::set_flash('success', e('欢迎登陆, '.$current_user->username));
                    Response::redirect('/u');
                }
                else
                {
                    $this->template->set_global('error', '用户登陆失败');
                }
            }else{
                $this->template->set_global('error', '用户名和密码格式不正确');
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
        $this->template->set_global('signup_error', '');
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
                        Config::load('common');
                        $current_user -> avatar = Config::get('default_headico');
                        $current_user -> save();
                        Session::set_flash('success', e('Welcome singnup, '.$current_user->username));
                        Response::redirect('/u/getnickname');
                    }
                    else
                    {
                        $this->template->set_global('signup_error', '已经存在用户名了');
                    }
                }catch (Exception $e){
                    $this->template->set_global('signup_error', '已经存在用户名了');
                }
            }else{
                $this->template->set_global('signup_error', '用户名格式不对');
            }
        }
        return Response::forge(View::forge('member/signup', array('val' => $val), false));
    }
    /**
    * 打开忘记密码页面
    */
    public function action_getforgot()
    {
        Session::set_flash('error', null);
        return Response::forge(View::forge('member/forgot'));
    }

    /**
    *  填入邮箱 检测邮箱 发送KEY
    */
    public function action_forgotemail()
    {
        !Input::method() == 'POST' and Response::redirect('/forgot');
        $val = Validation::forge('email');
        $val->add_field('email', 'Email', 'required|valid_email|max_length[255]');
        if ($val->run())
        {
            $email = Input::post('email');
            $member = Model_Member::find_by_email($email);
            if ($member)
            {
               //生成KEY发送邮件
               //data包含邮件标题subject，收件人email，KEY值，URI，模板路径view, type邮件类型
               $data = ["email"=>$email,
                   'uri' => 'findpwd',
                   'view'=>'member/email/findpassord',
                   'type'=>'email',                   
                   "subject"=>"乐乐淘用户邮箱验证"];       
               $send = Model_Member_Email::sendEmail($data);
               return Response::forge(View::forge('member/sendok', ['email'=>$email], false));
            }
        }
        Session::set_flash('error', e('你输入的邮箱错误'));
        Response::redirect('/forgot');
    }

    /*
    * 验证用户邮箱的真实性之验证返回的KEY
    */
    public function action_emailok()
    {
       $key = Input::get('key');
       Model_Member_Email::check($key);
       return json_encode(['key' => $key]);
    }


    /*
    *  新密码填写
    */
    public function action_findpassword()
    {

        return Response::forge(View::forge('member/forgot'));
    }

}
