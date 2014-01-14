<?php
class Controller_Member extends Controller_Center{

    public function action_index()
    {
        $member_id = $this->current_user->id;
        $orders = Model_Order::find('all', [
                            'where'=>['member_id'=>$member_id],
                            'order_by'=>['id'=>'desc'],
                            'rows_limit'=>3,
                            ]);
        $posts = Model_Post::find('all', [
                            'where'=>['member_id'=>$member_id],
                            'order_by'=>['id'=>'desc'],
                            'rows_limit'=>3,
                            ]);
        $wins = Model_Phase::find('all', [
                            'where'=>['member_id'=>$member_id],
                            'order_by'=>['id'=>'desc'],
                            'rows_limit'=>3,
                            ]);
        $view = ViewModel::forge('member/index', 'view');
        $view->set([
                'orders'=>$orders,
                'posts'=>$posts,
                'wins'=>$wins,
                ]);
        $this->template->title = "用户中心";
        $this->template->layout->content = $view;
    }

    /*
    *获得注册用户修改页面
    */
    public function action_getnickname()
    {
        $this->template->title = '添加用户昵称';
        $this->template->layout = View::forge('member/nickname');
    }

    /*
    *增加用户名
    */
    public function action_addnickname()
    {
        !Input::method() == 'POST' and Response::redirect('/u/getnickname');
        $val = Model_Member::validateNickname('create');
        if ($val->run())
        {
            $member = Model_Member::find($this->current_user->id);
            $nickname = Input::post('nickname');
            if (!Model_Member::checkNickname($nickname))
            {
                Session::set_flash('error', '用户昵称已经存在了');
                Session::set_flash('nickname', $nickname);
                Response::redirect('/u/getnickname');
            }

            $member->nickname = $nickname;
            if ($member and $member->save())
            {
                Session::set_flash('success', '更新个人设置OK');
                Response::redirect('/u');
            }
            else{
                $res and Response::redirect('/u/getnickname');
            }
        }
        Session::set_flash('error', '昵称格式不正确');
        Response::redirect('/u/getnickname');

    }

    /*
    *获得用户头像数据
    */
    public function action_getavatar()
    {
        $member = Model_Member::find_by_username($this->current_user->username);
        $data['member'] = $member;
        $this->template->title = '修改用户头像';
        $this->template->layout->content = View::forge('member/avatar', $data);
    }

    /*
    *修改用户头像
    */
    public function action_avatar()
    {
        !Input::method() == 'POST' and Response::redirect('/u/getavatar');
        $val = Model_Member::validateAvatar('edit');
        if ($val->run())
        {
            $post = $member = Model_Member::find($this->current_user->id);
            $post->avatar = Input::post('avatar');
            if($post->save())
            {
                Session::set_flash('success', '更新OK');
                Response::redirect('/u');
            }
        }
        Session::set_flash('error', '更新失败');
        Response::redirect('/u/getavatar');
    }

    /*
    *获得用户基本信息
    */
    public function action_getprofile($id = null)
    {
        $member = Model_Member::find($this->current_user->id);
        $data['member'] = $member;
        $this->template->title = "用户基本设置";
        $this->template->layout->content = View::forge('member/profile', $data);
    }

    /*
    *单独只修改用户签名
    */
    public function action_modifybio()
    {
        !Input::method() == 'POST' and Response::redirect('/u');
        $member = Model_Member::find_by_id($this->current_user->id);
        $member->bio = Input::post('bio');
        $member-save();
        Response::redirect('/u');
    }

    /*
    *修改更新用户基本信息
    */
    public function action_profile($id = null)
    {
        !Input::method() == 'POST' and Response::redirect('/u/getprofile');
        $val = Model_Member::validateProfile('edit');
        if ($val->run())
        {
            $member = Model_Member::find($this->current_user->id);
            if ($member->nickname != Input::post('nickname'))
            {
                if (!Model_Member::checkNickname(Input::post('nickname')))
                {
                    Session::set_flash('error', '用户昵称已经存在了');
                    Response::redirect('/u/getprofile');
                }
            }
            $member->nickname = Input::post('nickname');
            $member->mobile = Input::post('mobile');
            $member->bio = Input::post('bio');
            if ($member and $member->save())
            {
                Session::set_flash('success', '更新个人设置OK');
                Response::redirect('/u/getprofile');
            }
            else{
                $res and Response::redirect('/u/getprofile');
            }
        }
        Session::set_flash('error', '更新个人设置失败');
        Response::redirect('/u/getprofile');
    }
    /*
    * 修改用户密码
    */
    public function action_changepassword()
    {
        $val = Validation::forge();
        if (Input::method() == 'POST')
        {
            $val->add('oldpassword', 'Password')
                ->add_rule('required');
            $val->add('newpassword', 'Password')
                ->add_rule('required');
            if ($val->run())
            {
                // check the credentials. This assumes that you have the previous table created
                $oldpassword = Input::post('oldpassword');
                $newpassword = Input::post('newpassword');
                $username = $this->auth->get_screen_name();
                $res = $this->auth->change_password($oldpassword, $newpassword, $username);
                if ($res)
                {
                    $current_user = Model_Member::find_by_username($this->auth->get_screen_name());
                    Session::set_flash('success', e('修改密码成功, '.$current_user->username));
                    Response::redirect('/u');
                }else{
                    $this->template->set_global('error', '密码修改不成功，请再输入');
                }
            }
        }
        $this->template->title = '用户修改密码页面';
        $this->template->layout->content = View::forge('member/passwd', array('val' => $val), false);
    }
    /*
    *打开充值页面
    */
    public function action_getrecharge()
    {
        $this->template->title = '用户充值页面';
        $this->template->layout->content = View::forge('member/money');
    }

     /*
    *增加余额功能,根据签名充值
    */
    public function action_recharge()
    {
       $response = new Response();
       $response->set_header('Content-Type', 'application/json');
       $data = ['code'=>-1, 'msg'=>''];
       if (!Input::method() == 'POST') {
           return $response->body(json_encode($data));
       }
       $val = Validation::forge();
       $val->add('money', '')
                ->add_rule('required');
       $val->add('source', '')
                ->add_rule('required');
       if (!$val->run()){
            Session::set_flash('error', e('充值失败'));
            return $response->body(json_encode($data));
       }
       $money = Input::post('money');

       // 转换成积分
       Config::load('common');
       $point = intval($money) * Config::get('point');
       $source = Input::post('source');
       $sign = Input::post('sign');
       $res = Model_Member::addMoney($this->current_user->id, $point);
       if ($res){
           //增加充值记录
           Model_Member_Moneylog::recharge_log($this->current_user->id, $point, $source);
           Session::set_flash('success', e('充值成功'));
           $data['code'] = 0;
           return $response->body(json_encode($data));
       }else{
           Session::set_flash('error', e('充值失败'));
           return $response->body(json_encode($data));
       }
    }

    /*
    *
    */
    public function action_msg()
    {
        return;
    }

    // 上传头像图片
    public function action_avatarUpload() 
    {
        $files = Model_Member::upload();
        return json_encode(['files' => $files]);
    }
    
    
    /*
    * 验证用户邮箱的真实性之发送邮件
    */
    public function action_checkemail()
    {
       $header = ['Content-Type' => 'application/json'];
       $email = $this->current_user->email;               
       //data包含邮件标题subject，收件人email，KEY值，URI，模板路径view, type邮件类型
       $data = ["email"=>$email,
                   'uri' => 'emailok',
                   'view'=>'member/email/emailok',
                   'type'=>'email',                   
                   "subject"=>"乐乐淘用户邮箱验证"];   
       if (!Model_Member_Email::check_emailok($email)){    
           $send = Model_Member_Email::sendEmail($data, $this->current_user->id);
           if ($send){
              return Response::forge(json_encode(['email' => $email, 'msg'=>'发送成功']), 200, $header);
           }
           return Response::forge(json_encode(['email' => 0, 'msg'=>'发送邮件失败']), 200, $header);
       }else{
           return Response::forge(json_encode(['email' => 0, 'msg'=>'邮箱已经验证过了']), 200, $header);
       }     
    }
    
    
    
    
}
