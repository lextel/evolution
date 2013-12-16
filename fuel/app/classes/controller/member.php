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


    public function action_avatar($id=null)
    {
        $member->avatar = Input::post('avatar');
    }


	public function action_profile($id = null)
	{
		
		$val = Model_Member::validate('edit');
		if ($val->run())
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
		$this->template->content = View::forge('member/edit');

	}

}
