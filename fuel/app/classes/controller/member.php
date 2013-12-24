<?php
class Controller_Member extends Controller_Center{

    public $template = 'memberlayout';

    public function action_index()
    {
        $data['members'] = Model_Member::find('all');
        $this->template->title = "Members";
        $this->template->content = View::forge('member/index', $data);
    }

    public function action_view($id = null)
    {
        is_null($id) and Response::redirect('member');

        if ( ! $data['member'] = Model_Member::find($id))
        {
            Session::set_flash('error', 'Could not find member #'.$id);
            Response::redirect('member');
        }

        $this->template->title = "Member";
        $this->template->content = View::forge('member/view', $data);

    }

    /*
    *获得当前收货地址列表
    */
    public function action_getaddressindex()
    {
        $address = Model_Member_Address::find_by('member_id', $this->current_user->id);
        $data['address'] = $address;
        $this->template->title = '用户修改收获地址';
        $this->template->content = View::forge('member/address', $data);
    }

    /*
    *获得当前快递地址
    */
    public function action_getaddress($id=null)
    {
        $address = Model_Member_Address::find($id);
        $data['address'] = $address;
        $this->template->title = '用户修改收获地址';
        $this->template->content = View::forge('member/address', $data);
    }

     /*
     *更新用户快递地址
     */
    public function action_address()
    {
        !Input::method() == 'POST' and Response::redirect('/u/getaddress');
        $val = Model_Member_Address::validate('edit');
        if ($val->run())
        {
            $post = Model_Member_Address::find_by('member_id', $this->current_user->id);
            if (!$post)
            {
                $post = Model_Member_Address::add($this->current_user->id);
            }
            $post->address = Input::post('address');
            if ($post and $post->save())
            {
                Session::set_flash('success', e('修改地址成功, '));
                Response::redirect('/u');
            }
        }
        $this->template->set_global('error', '修改地址失败，请核对输入');
        Response::redirect('/u/getaddress');
    }

    /*
    *获得用户头像数据
    */
    public function action_getavatar()
    {
        $member = Model_Member::find_by_username($this->current_user->username);
        $data['member'] = $member;
        $this->template->title = '修改用户头像';
        $this->template->content = View::forge('member/avatar', $data);
    }

    /*
    *修改用户头像
    */
    public function action_avatar()
    {
        !Input::method() == 'POST' and Response::redirect('/u/getavatar');
        $val = Model_Member::validate('edit');
        if ($val->run())
        {
            $post = $member = Model_Member::find_by_username($this->current_user->username);
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
        $member = Model_Member_Info::checkInfo($this->current_user->id);
        $data['member'] = $member;
        $this->template->title = "用户基本设置";
        $this->template->content = View::forge('member/profile', $data);
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
        $val = Model_Member_Info::validate('edit');
        if ($val->run())
        {
            $member = Model_Member_Info::checkInfo($this->current_user->id);
            if (!Model_Member::checkNickname(Input::post('nickname')))
            {
                Session::set_flash('error', '用户昵称已经存在了');
                Response::redirect('/u/getprofile');
            }
            Model_Member::updateNickname($this->current_user->id,Input::post('nickname'), Input::post('bio'));
            $member->nickname = Input::post('nickname');
            $member->local = Input::post('local');
            $member->address = Input::post('address');
            $member->gender = Input::post('gender');
            $member->birth = Input::post('birth');
            $member->qq = Input::post('qq');
            $member->horoscope = Input::post('horoscope');
            $member->salary = Input::post('salary');
            if ($member and $member->save())
            {
                Session::set_flash('success', '更新个人设置');
                Response::redirect('/u');
            }
            else{
                $res = Model_Member_Infocreate::create();
                $res and Response::redirect('/u');
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
        $this->template->content = View::forge('member/passwd', array('val' => $val), false);
    }

}
