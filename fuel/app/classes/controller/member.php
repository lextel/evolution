<?php
class Controller_Member extends Controller_Template{

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

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Member::validate('create');
			
			if ($val->run())
			{
				$member = Model_Member::forge(array(
					'username' => Input::post('username'),
					'password' => Input::post('password'),
					'nickname' => Input::post('nickname'),
					'avatar' => Input::post('avatar'),
					'bio' => Input::post('bio'),
					'mobile' => Input::post('mobile'),
					'points' => Input::post('points'),
					'last_login' => Input::post('last_login'),
				));

				if ($member and $member->save())
				{
					Session::set_flash('success', 'Added member #'.$member->id.'.');

					Response::redirect('member');
				}

				else
				{
					Session::set_flash('error', 'Could not save member.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Members";
		$this->template->content = View::forge('member/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('member');

		if ( ! $member = Model_Member::find($id))
		{
			Session::set_flash('error', 'Could not find member #'.$id);
			Response::redirect('member');
		}

		$val = Model_Member::validate('edit');

		if ($val->run())
		{
			$member->username = Input::post('username');
			$member->password = Input::post('password');
			$member->nickname = Input::post('nickname');
			$member->avatar = Input::post('avatar');
			$member->bio = Input::post('bio');
			$member->mobile = Input::post('mobile');
			$member->points = Input::post('points');
			$member->last_login = Input::post('last_login');

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
				$member->username = $val->validated('username');
				$member->password = $val->validated('password');
				$member->nickname = $val->validated('nickname');
				$member->avatar = $val->validated('avatar');
				$member->bio = $val->validated('bio');
				$member->mobile = $val->validated('mobile');
				$member->points = $val->validated('points');
				$member->last_login = $val->validated('last_login');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('member', $member, false);
		}

		$this->template->title = "Members";
		$this->template->content = View::forge('member/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('member');

		if ($member = Model_Member::find($id))
		{
			$member->delete();

			Session::set_flash('success', 'Deleted member #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete member #'.$id);
		}

		Response::redirect('member');

	}


}
