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
    
    public function action_address($id=null)
    {
        //$member->avatar = Input::post('avatar');
        $val = Validation::forge();
		if (Input::method() == 'POST')
		{
			$val->add('newaddress', 'Newaddress')
			    ->add_rule('required');        
			if (!$val->run())
			{
				// check the credentials. This assumes that you have the previous table created
				$newaddress = Input::post('newaddress');
				$res = $this->auth->change_password($oldpassword, $newpassword, $username);
				if ($res)
				{
					//$current_user = Model_Member::find_by_username($this->auth->get_screen_name());
					Session::set_flash('success', e('修改地址成功, '.$current_user->username));
					Response::redirect('/u');
				}
				else
				{
					$this->template->set_global('error', '修改地址成功，请再输入');
				}
			}
		}

        $data = array();
        $this->template->title = '';
        $this->template->content = View::forge('member/address', $data);
    }

    public function action_avatar($id=null)
    {
        //$member->avatar = Input::post('avatar');
        $data = array();
        $this->template->title = '';
        $this->template->content = View::forge('member/avatar', $data);
    }

    public function action_getprofile($id = null)
    {
    	$member = Model_Member_Info::find_by_uid($this->current_user->id);
		$val = Model_Member_Info::validate('edit');
		$this->template->title = "用户基本设置";
		$this->template->content = View::forge('member/profile');

    }
	public function action_postprofile($id = null)
	{
		!Input::method() == 'POST' and Response::redirect('/u/profile');
		$member = Model_Member_Info::find_by_uid($this->current_user->id);
		$val = Model_Member_Info::validate('edit');
		if ($val->run())
		{
			$member->nickname = Input::post('nickname');	
			$member->local = Input::post('local');
			$member->address = Input::post('address');
			$member->gender = Input::post('gender');
			$member->birth = Input::post('birth');
			$member->qq = Input::post('qq');
			$member->horoscope = Input::post('horoscope');
			$member->salary = Input::post('salary');
            var_dump($this->current_user);
			if ($member->save())
			{
				Session::set_flash('success', '更新个人设置');
				Response::redirect('/u');
			}
			else
			{
				Session::set_flash('error', '更新个人设置失败');
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$member->nickname = $member->validated('nickname');
				$member->bio = $member->validated('bio');
				$member->mobile = $member->validated('mobile');
				Session::set_flash('error', $member->error());
			}

			$this->template->set_global('member', $member, false);
	    }
	}
	/**
	 * The index action.
	 *
	 * @access  public
	 * @return  void
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
				}
				else
				{
					$this->template->set_global('error', '密码修改不成功，请再输入');
				}
			}
		}
		$this->template->title = '';
		$this->template->content = View::forge('member/passwd', array('val' => $val), false);
	}

}
