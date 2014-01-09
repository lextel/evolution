<?php
class Controller_Member_Email extends Controller_Template{

	public function action_index()
	{
		$data['member_emails'] = Model_Member_Email::find('all');
		$this->template->title = "Member_emails";
		$this->template->content = View::forge('member/email/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('member/email');

		if ( ! $data['member_email'] = Model_Member_Email::find($id))
		{
			Session::set_flash('error', 'Could not find member_email #'.$id);
			Response::redirect('member/email');
		}

		$this->template->title = "Member_email";
		$this->template->content = View::forge('member/email/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Member_Email::validate('create');
			
			if ($val->run())
			{
				$member_email = Model_Member_Email::forge(array(
					'email' => Input::post('email'),
					'member_id' => Input::post('member_id'),
					'key' => Input::post('key'),
					'status' => Input::post('status'),
					'type' => Input::post('type'),
					'is_delete' => Input::post('is_delete'),
					'deadtime' => Input::post('deadtime'),
				));

				if ($member_email and $member_email->save())
				{
					Session::set_flash('success', 'Added member_email #'.$member_email->id.'.');

					Response::redirect('member/email');
				}

				else
				{
					Session::set_flash('error', 'Could not save member_email.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Member_Emails";
		$this->template->content = View::forge('member/email/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('member/email');

		if ( ! $member_email = Model_Member_Email::find($id))
		{
			Session::set_flash('error', 'Could not find member_email #'.$id);
			Response::redirect('member/email');
		}

		$val = Model_Member_Email::validate('edit');

		if ($val->run())
		{
			$member_email->email = Input::post('email');
			$member_email->member_id = Input::post('member_id');
			$member_email->key = Input::post('key');
			$member_email->status = Input::post('status');
			$member_email->type = Input::post('type');
			$member_email->is_delete = Input::post('is_delete');
			$member_email->deadtime = Input::post('deadtime');

			if ($member_email->save())
			{
				Session::set_flash('success', 'Updated member_email #' . $id);

				Response::redirect('member/email');
			}

			else
			{
				Session::set_flash('error', 'Could not update member_email #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$member_email->email = $val->validated('email');
				$member_email->member_id = $val->validated('member_id');
				$member_email->key = $val->validated('key');
				$member_email->status = $val->validated('status');
				$member_email->type = $val->validated('type');
				$member_email->is_delete = $val->validated('is_delete');
				$member_email->deadtime = $val->validated('deadtime');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('member_email', $member_email, false);
		}

		$this->template->title = "Member_emails";
		$this->template->content = View::forge('member/email/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('member/email');

		if ($member_email = Model_Member_Email::find($id))
		{
			$member_email->delete();

			Session::set_flash('success', 'Deleted member_email #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete member_email #'.$id);
		}

		Response::redirect('member/email');

	}


}
