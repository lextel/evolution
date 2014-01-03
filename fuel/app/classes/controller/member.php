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
        $wins = Model_Lottery::find('all', [
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
       !Input::method() == 'POST' and Response::redirect('/u/getrecharge');
       $val = Validation::forge();
       $val->add('money', '')
                ->add_rule('required');
       $val->add('source', '')
                ->add_rule('required');
       if (!$val->run()){
            Session::set_flash('error', e('充值失败'));
            Response::redirect('/u/getrecharge'); 
       }
       $money = Input::post('money');
       $source = Input::post('source');
       $sign = Input::post('sign');
       $res = Model_Member::addMoney($this->current_user->id, $money);
       if ($res){
           //增加充值记录
           Model_Member_Moneylog::recharge_log($this->current_user->id, $money, $source);
           Session::set_flash('success', e('充值成功'));
           Response::redirect('/u') ;
       }else{
           Session::set_flash('error', e('充值失败'));
           Response::redirect('/u/getrecharge') ;
       }
    }

    /*
    *
    */
    public function action_msg()
    {
        return;
    }

    // 上传图片
    public function action_avatarUpload() {
        $files = Model_Member::upload();
        return json_encode(['files' => $files]);
    }
}
