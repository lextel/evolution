<?php

class Controller_Center extends Controller_Frontend
{

    public function before()
    {
        parent::before();
        if (! in_array(Request::active()->action, ['signin', 'signup', 'findpassword', 
            'newpassword', 'forgotemail', 'getforgot', 'sendok', 'checkname']))
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

            if ($val->run()){
                $username = Input::post('username');
                $password = Input::post('password');

                if ($this->auth->check() or $this->auth->login($username, $password)){
                    if (Config::get('auth.driver', 'Memberauth') == 'Ormauth'){
                        $current_user = Model\Auth_Member::find_by_username($this->auth->get_screen_name());
                    }else{
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
                    if (empty(strpos($username, '@'))){
                        $user = $this->auth->create_user_by_mobile($username, $password);
                    }else{
                        $user = $this->auth->create_user($username, $password, $email);
                    }

                    if ($this->auth->check() or $user)
                    {
                        $current_user = Model_Member::find_by_username($this->auth->get_screen_name());
                        Config::load('common');

                        $memberHelper = new \Helper\Member();
                        $ip = $memberHelper->getIp();
                        $current_user->avatar = Config::get('default_headico');
                        $current_user->ip = $ip;
                        if (empty(strpos($username, '@'))){
                            $current_user->mobile = $username;
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

                        Session::set_flash('success', e('欢迎登陆, '.$current_user->username));
                        Response::redirect('/u/getnickname');
                    }
                    else
                    {
                        Session::set_flash('usernameError', e('已经存在用户名了'));
                    }
                }catch (Exception $e){
                    Log::error($e);
                    Session::set_flash('usernameError', e('已经存在用户名了'));

                }
            }else{
                $val->set_message('required', ':label 为必填项.');
                $val->set_message('valid_email', ':label 格式不正确.');
                $val->set_message('min_length', ':label 不能少于:param:1个字符.');
                $val->set_message('max_length', ':label 不能超过:param:1个字符.');
                $val->set_message('unique', ':用户名 已经存在');
                Session::set_flash('usernameError', $val->show_errors());
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
           Response::redirect('/forgot');
       }
       Session::delete('email');
       $this->template->title = '用户找回密码';
       $this->template->layout = View::forge('member/sendok', ['email'=>$email], true);
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
               $send = Model_Member_Email::sendEmail($data, $member->id);
               Session::set('email', $email);
               return Response::redirect('/sendok');
            }else{
                Session::set_flash('erroremail', '你输入的邮箱未注册');
            }
        }else{
            Session::set_flash('erroremail', '你输入的邮箱不正确');
        }

        Response::redirect('/forgot');
    }

    /*
    * 验证用户邮箱的真实性之验证返回的KEY，强制登陆
    */
    public function action_emailok()
    {
        $key = Input::get('key');
        if (Model_Member_Email::check_key($key, 'email')){
            Model_Member_Email::save_key($key, 'email');
            $email = Model_Member_Email::find_by_key($key);
            $this->auth->force_login($email->member_id);
            Session::set_flash('success', '邮箱验证成功');
        }else{
            Session::set_flash('error', '验证邮箱失败请重新验证');

        }
        Response::redirect('/u/getprofile');
    }

    /*
    *  新密码填写,先验证KEY的正确性, 则直接登陆,member_id作为会话
    */
    public function action_findpassword()
    {
        $header = ['Content-Type' => 'application/json'];
        $header = [];
        $key = Input::get('key', '');
        $res = Model_Member_Email::check_key($key, 'password');
        if ($res)
        {
           Session::set('member_id', $res->member_id);
           Session::set('emailkey', $key);
           return Response::redirect('/newpwd');
        }else{
           Session::set_flash('erroremail', 'KEY不存在或者过期了，请重新再获取一次');
           Response::redirect('/forgot');
        }

    }

    /*
    *  忘记密码之新密码提交,需要检测会话是否来自KEY
    */
    public function action_newpassword()
    {

        $key = Session::get('emailkey', null);
        $member_id = Session::get('member_id', null);
        if (!$member_id){
            return Response::redirect('signup');
        }
        if (!$key){
           Session::set_flash('erroremail', 'KEY不存在或者过期了，请重新再获取一次');
           return Response::redirect('/forgot');
        }
        if (!(Input::method() == 'POST')){
            $this->template->title = '设置新密码';
            $this->template->layout = View::forge('member/findpwd', [], true);
            return;
        }
        $val = Validation::forge('create');
        $val->add_field('newpassword', 'newpassword', 'required|max_length[18]|min_length[6]');
        if (!$val->run()){
            Session::set_flash('newpwderror', '密码格式不正确');
            return Response::redirect('/newpwd');
        }

        $newpassword = Input::post('newpassword');
        $user = Model_Member::find($member_id);
        if (!$this->auth->force_login($member_id)){
            Session::set_flash('newpwderror', '用户不存在');
            return Response::redirect('/newpwd');
        }

        Session::delete('member_id');
        Session::delete('emailkey');
        $newrandpwd = $this->auth->reset_password($this->auth->get_screen_name());
        $res = $this->auth->change_password($newrandpwd, $newpassword, $this->auth->get_screen_name());
        if ($res)
        {
            Model_Member_Email::save_key($key, 'password');
            return Response::redirect('/findok');;
        }
        return Response::redirect('/newpwd');
    }

    public function action_findok()
    {
        $this->template->title = '设置新密码';
        $this->template->layout = View::forge('member/findok', [], true);
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
