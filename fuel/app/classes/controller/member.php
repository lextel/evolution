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


	public function action_profile($id = null)
	{
		$member = Model_Member::validate('edit');
		if ($member->run())
		{
			$member->nickname = Input::post('nickname');	
			$member->bio = Input::post('bio');
			$member->mobile = Input::post('mobile');
			if ($member->save())
			{
				Session::set_flash('success', 'Updated member #' . $id);

				Response::redirect('member');
			}
			else
			{
				Session::set_flash('error', 'Could not update member #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$member->nickname = $val->validated('nickname');
				$member->bio = $val->validated('bio');
				$member->mobile = $val->validated('mobile');
				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('member', $member, false);
		}

		$this->template->title = "Members";
		$this->template->content = View::forge('member/profile');

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
