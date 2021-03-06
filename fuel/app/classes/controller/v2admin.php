<?php

class Controller_V2admin extends Controller_Baseend
{
    public $template = 'v2admin/template';
    public $smsPerTime = 60;
    public function before()
    {
        parent::before();
        if (! in_array(Request::active()->action, array('login', 'logout', 'sendpwd', 'login2')))
        {
            $this -> admincheck();
        }
        list($driver, $groupid) = $this->auth->get_groups();
        $this->groupid = $groupid;
    }

    private function admincheck()
    {
        if (!$this->auth->check())
        {
            Response::redirect('v2admin/login');
        }

        $login_time = \Session::get('login_time', 0);
        $limit_time = \Config::get('simpleauth.limit_time', 10 * 60);
        //\Log::error('time = '.(time() - $login_time));
        if ((time() - $login_time) > $limit_time){
            Session::set_flash('login_error', e('超过10分钟没操作了，退出登录,请重新登录'));
            Response::redirect('v2admin/logout');
        }else{
            \Session::set('login_time', time());
        }

        $group = Auth::group()->groups();
        list($driver, $groupid) = $this->auth->get_groups();
        $contorller = Request::active()->controller;
        Config::load('admin');
        $rights = Config::get('rights');
        if (is_null($rights)){
            Session::set_flash('error', e('无权限配置文件'));
            Response::redirect('v2admin');
        }
        $actions = [];
        foreach($rights as $row){
            if ($row['controller'] == Request::active()->controller){
                $actions = $row['action'];
            }
        }

        if (!$actions){
            Session::set_flash('error', e('无controller '.Request::active()->controller));
            Response::redirect('v2admin');
        }
        if (!array_key_exists(Request::active()->action, $actions)){
            Session::set_flash('error', e('无action '.Request::active()->controller.'.'.Request::active()->action));
            Response::redirect('v2admin');
        }
        $group = $actions[Request::active()->action];
        if ($group > $groupid){
            Session::set_flash('error', e('您没有权限操作'));
            Response::redirect('v2admin');
        }
    }


    public function action_login2()
    {
        // Already logged in
        $this->auth->check() and Response::redirect('v2admin');
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
                    Response::redirect('v2admin');
                }
                else
                {
                    $this->template->set_global('login_error', '登陆失败');
                }
            }
        }
        $this->template->title = '管理登陆';
        $this->template->content = View::forge('v2admin/login', array('val' => $val), false);
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
        Response::redirect('/v2admin/login');
    }

    /*
    * 发送手机短信
    */
    public function action_sendpwd()
    {
        $this->auth->check() and Response::redirect('v2admin');
        $username = trim(Input::post('user'));
        $user = Model_User::find_by_username($username);
        if (!$user){
            $res['msg'] = $username.'不存在';
            return json_encode($res);
        }
        //检测数据库里是否有该电话
        $res = ['code'=>1];
        $time = Session::get('time', 0);
        $phone = Session::get('mobile');
        $mobile = $user->mobile;
        $now = time();
        if ($phone == $mobile){
            if (!empty($time) && (($now - $time) <= $this->smsPerTime)){
                $res['code'] = 2;
                $res['msg'] = $mobile.'获取太频繁了';
                return json_encode($res);
            }
        }
        /*$val = Validation::forge();
        $val->add_callable(new \Classes\MyRules());
        $val->add_field('mobile', '手机', 'required|is_mobile');
        if (!$val->run()){
            $res['msg'] = $mobile.'格式不正确';
            return json_encode($res);
        }*/


        //生成随机验证码
        $time = time();
        $code = substr(crc32($time.$mobile),0, 6);

        // 发送
        $content = $code;
        $sms = new Classes\Sms();
        $r = $sms->send($mobile, $content);
        \Log::error(sprintf('短信： %s | %s', $mobile, $content));
        if ($r){
            $res['code'] = 0;
            $res['msg'] = '已发送';
            Session::set('password', $code);
            Session::set('time', $time);
            Session::set('mobile', $mobile);
            return json_encode($res);
        }
        $res['msg'] = '发送失败';
        return json_encode($res);
    }

    /*
    * 手机快速登陆
    */
    public function action_login()
    {
        $this->auth->check() and Response::redirect('v2admin');

        $val = Validation::forge();
        $val->add_callable(new \Classes\MyRules());
        $val->add_field('password', '密码', 'required|min_length[6]|max_length[6]');
        if (Input::method() == 'POST' && $val->run()){
            $username = trim(Input::post('mobile'));
            $pwd = trim(Input::post('password'));
            $phone = Session::get('mobile');
            $user = Model_User::find_by_username($username);
            if (!$user){
                Session::set_flash('login_error',$username.'不存在');
                Response::redirect("v2admin/login");
            }
            $code = Session::get('password');
            $time = Session::get('time');
            $now = time();
            $flag = ($now - $time) <= $this->smsPerTime && ($code == $pwd) && $user->mobile == Session::get('mobile');
            if ($flag){
                $this->auth->force_login($user->id);
                Session::delete('password');
                Session::delete('time');
                Session::delete('mobile');
                return Response::redirect('v2admin');
            }else{
                Session::set_flash('login_error', '您输入的密码不正确或者已经过期了');
            }
        }
        $users = Model_User::find('all', ['where'=>
                                                            ['is_delete'=>0, ['mobile', '!=', ''], ['mobile', '!=', '0']]
                                                            ]);
        $user = [];
        foreach ($users as $row) {
            $user[$row->username] = $row->username;
        }
        $this->template->title = '管理登陆';
        $this->template->content = View::forge('v2admin/login1', ['val' => $val, 'users'=>$user], false);
    }

    /**
     * The index action.
     *
     * @access  public
     * @return  void
     */
    public function action_index()
    {
        $this->template->title = '管理首页';
        $this->template->content = View::forge('v2admin/dashboard');
    }

}

/* End of file admin.php */
