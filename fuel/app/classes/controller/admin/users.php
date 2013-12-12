<?php
class Controller_Admin_Users extends Controller_Admin{

	public function action_index()
	{
		$data['users'] = Model_User::find('all');
		$this->template->title = "";
		$this->template->content = View::forge('admin/users/index', $data);

	}

	public function action_view($id = null)
	{
		$data['user'] = Model_User::find($id);
		$this->template->title = "";
		$this->template->content = View::forge('admin/users/view', $data);

	}

	public function action_create()
	{   
		if (Input::method() == 'POST')
		{
			$val = Model_User::validate('create');
			if ($val->run())
			{
				$username = Input::post('username');
			    $password = Input::post('password');
			    $email = Input::post('email');
			    $group = Input::post('group');
			    try
			    {
				    $user_id = Auth::create_user($username, $password, $email, $group);
                    Session::set_flash('success', e('Added user #'.$user_id.'.'));
			        Response::redirect('admin/users');
			    }
			    catch (Exception $e)
			    {		
			        Log::error($e);		
					Session::set_flash('error', e('Could not save user.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}
		$this->template->title = "";
		$this->template->content = View::forge('admin/users/create');
	}

	public function action_edit($id = null)
	{
		$user = Model_User::find($id);
		$val = Model_User::validate('edit');

		if ($val->run())
		{
			//$user->username = Input::post('username');
			$user->group = Input::post('group');
			if (Auth::update_user(array('group'=>$user->group), $user->username))
			{
				Session::set_flash('success', e('Updated user #' . $id));
				Response::redirect('admin/users');
			}

			else
			{
				Session::set_flash('error', e('Could not update user #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$user->username = $val->validated('username');
				$user->password = $val->validated('password');
				$user->email = $val->validated('email');
				$user->group = $val->validated('group');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('user', $user, false);
		}

		$this->template->title = "";
		$this->template->content = View::forge('admin/users/edit');

	}

	public function action_delete($id = null)
	{
		if ($user = Model_User::find($id))
		{
            Auth::delete_user($user->username);
			Session::set_flash('success', e('Deleted user #'.$id));
		}
		else
		{
			Session::set_flash('error', e('Could not delete user #'.$id));
		}

		Response::redirect('admin/users');

	}


}