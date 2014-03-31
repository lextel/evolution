
<?php

class Controller_Center extends Controller_Frontend
{
    //public $auth;
    public function before()
    {
        parent::before();
        if (! in_array(Request::active()->action, ['signin', 'signup', 'findpassword', 'newpassword', 'forgotemail', 'getforgot', 'sendok', 'checkname']))
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

    /*
    *用户登陆系统
    */
    public function action_signin()
    {
        $this->auth->check() and Response::redirect('/u');
        if (Input::method() == 'POST')
        {
            $val = Model_Member::validateSignin('signin');
            
            if ($val->run())
            {
                $username = Input::post('username');
                $password = Input::post('password');
                if ($this->auth->check() or $this->auth->login($username, $password))
                {
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
                    $url = Input::server('HTTP_REFERER', '/u');
                    return Response::redirect($url);
                }
                Session::set_flash('signError', '用户名或者密码错误');
            }
            Session::set_flash('signError', '用户名或者密码格式错误');
            return Response::redirect('/signin');
        }
        return Response::forge(View::forge('member/signin', [], false));
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
        $url = Input::server('HTTP_REFERER', '/signin');
        return Response::redirect($url);
    }

    public function action_signup()
    {

        $this->auth->check() and Response::redirect('/u');
        if (Input::method() == 'POST')
        {
            $val = Model_Member::validateSignin('signup');
            $username = Input::post('username');
            $password = Input::post('password');
            if ($val->run())
            {

                try{
                    $email = $username;
                    if (!strpos($username, '@')){ 
                        $user = new Model_Member();
                        $user->username = $username;
                        $user->password = $this->auth->hash_password((string) $password);
                        $user->save();
                    }else{                                      
                        $user = $this->auth->create_user($username, $password, $email);
                    }
                    if ($this->auth->check() or $user)
                    {
                        $current_user = Model_Member::find_by_username($this->auth->get_screen_name());
                        Config::load('common');

                        $memberHelper = new \Helper\Member();
                        $ip = $memberHelper->getIp();
                        $current_user -> avatar = Config::get('default_headico');
                        $current_user->ip = $ip;
                        if (!strpos('@', $username)){ 
                            $current_user->mobile = $mobile;
                        }
                        $current_user -> save();

                        // 邀请注册处理  ------ start ------------
                        $invit_id = intval(Session::get('invit_id')); 
                        if(!empty($invit_id)) {

                            // 保存关系
                            $invit = [
                                'member_id' => $invit_id,
                                'invit_id'  => $current_user->id,
                                ];

                            $invitModel = new Model_Member_Invit($invit);
                            $invitModel->save();

                            $points = Config::get('point') * Config::get('invitPoints');

                            // 更新余额
                            $member = Model_Member::find($invit_id);
                            $member->points = $member->points + $points;
                            $member->save();

                            // 写佣金记录
                            $brokerage = [
                                'type_id' => 1,
                                'member_id' => $invit_id,
                                'target_id' => $current_user->id,
                                'points' => $points,
                                ];
                            $brokerageModel = new Model_Member_Brokerage($brokerage);
                            $brokerageModel->save();

                            Session::set('invit_id', '');
                        }
                        //  邀请注册 --------------end -------------

                        // 邀请码处理
                        if(Config::get('openInvitCode')) {
                            $code = Input::post('invitcode');
                            $codeModel = new Model_Invitcode();
                            if($codeModel->check($code)) {
                                $codeModel->used($current_user->id, $code);
                            }
                        }


                        Session::set_flash('success', e('欢迎登陆, '.$current_user->username));
                        Response::redirect('/u/getnickname');
                    }
                    else
                    {
                        Session::set_flash('usernameError', e('已经存在用户名了'));
                    }
                }catch (Exception $e){
                    echo $e;
                    Session::set_flash('usernameError', e('已经存在用户名了'));

                }
            }else{
                Session::set_flash('usernameError', e('用户名格式不对'));
            }
            Session::set_flash('username', e($username));
            Response::redirect('/signup');
        }
        $this->template->title = '用户注册页面';
        $this->template->layout = View::forge('member/signup', [], false);
    }

    /**
    * 打开忘记密码页面
    */
    public function action_getforgot()
    {
        Session::set_flash('error', null);
        $this->template->title = '用户找回密码';
        $this->template->layout = View::forge('member/forgot', [], false);
    }

    /**
    * 忘记密码之发送邮件成功
    */
    public function action_sendok()
    {
       $email = Session::get('email', null);
       if (!$email)
       {
           Response::redirect('/signin');
       }
       Session::delete('email');
       return Response::forge(View::forge('member/sendok', ['email'=>$email], true));
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
                   'view'=>'member/email/findpassword',
                   'type'=>'password',
                   "subject"=>"乐乐淘用户找回密码"];
               $send = Model_Member_Email::sendEmail($data);
               Session::set('email', $email);
               return Response::redirect('/sendok');
            }
        }
        Session::set_flash('error', e('你输入的邮箱错误'));
        Response::redirect('/forgot');
    }

    /*
    * 验证用户邮箱的真实性之验证返回的KEY，强制登陆
    */
    public function action_emailok()
    {
       $key = Input::get('key');
       if (Model_Member_Email::check_key($key, 'email')){

          $email = Model_Member_Email::find_by_key($key);
          $this->auth->force_login($email->member_id);
          return json_encode(['key' => $key]);
       }else{
          return json_encode(['error'=>'key 错误']);
       }
    }

    /*
    *  新密码填写,先验证KEY的正确性, 则直接登陆,member_id作为会话
    */
    public function action_findpassword()
    {
        $header = ['Content-Type' => 'application/json'];
        $header = [];
        $key = Input::get('key');
        if (Model_Member_Email::check_key($key, 'password'))
        {
           $email = Model_Member_Email::find_by_key($key);
           $member = Model_Member::find_by_email($email->email);
           if (!$member)
           {
              return Response::forge(json_encode(['error'=>'用户数据库 错误']),200, $header);
           }
           Session::set('member_id', $member->id);
           return Response::redirect('newpwd');
        }else{
           return Response::forge(json_encode(['error'=>'key 错误']),200, $header);
        }

    }

    /*
    *  忘记密码之新密码提交,需要检测会话是否来自KEY
    */
    public function action_newpassword()
    {
        $header = [];
        $member_id = Session::get('member_id', null);
        if (!$member_id)
        {
            return Response::redirect('signup');
        }
        if (!(Input::method() == 'POST'))
        {
            return Response::forge(View::forge('member/findpwd'));
        }

        if ($this->auth->force_login($member_id)){
                Session::delete('member_id');
        }
        $newpassword = Input::post('newpassword');
        $user = Model_Member::find($member_id);
        $newrandpwd = $this->auth->reset_password($this->auth->get_screen_name());
        $res = $this->auth->change_password($newrandpwd, $newpassword, $this->auth->get_screen_name());
        if ($res)
        {
           return Response::redirect('u');
           //return Response::forge(json_encode(['error'=>'key 错误']),200, $header);
        }
        return Response::forge(View::forge('member/findpwd'));
    }
    
    /*
    * 验证手机号码或者邮箱是否存在
    */
    public function action_checkname()
    {
        $res = ['status' => 'n', 'info' => '手机/邮箱已存在'];
        $username = Input::post('param');
        if (is_null($username)){
            return json_encode($res);
        }
        $check = Model_Member::count(['where'=>[
                           ['username', '=', $username],
                           'or'=>[['mobile', '=', $username]]
                           ]]);
        if ($check == 0){
            $res['status'] = 'y';
            $res['info'] = ' ';
        }
        return json_encode($res);
    }
}
