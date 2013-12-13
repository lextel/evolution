<?php
class Controller_Account extends Controller_Center{

    public $template = 'layout';
    
    

	public function action_index()
	{
		$data['accounts'] = Model_Account::find('all');
		$this->template->content = View::forge('account/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('account');

		if ( ! $data['account'] = Model_Account::find($id))
		{
			Session::set_flash('error', 'Could not find account #'.$id);
			Response::redirect('account');
		}

		$this->template->title = "Account";
		$this->template->content = View::forge('account/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			//$val = Model_Account::validate('create');
			$val = Validation::forge('create');
			$val->add_field('username', 'Username', 'required|max_length[255]');
            $val->add_field('password', 'Password', 'required|max_length[255]');
			if ($val->run())
			{
				$account = Model_Account::forge(array(
					'username' => Input::post('username'),
					'password' => Input::post('password'),
					'nickname' => '',
					'avatar' => 'xxoxooxoxoxo',
					'bio' => '',
					'mobile' => '',
					'points' => 0,
					'last_login' => time(),
				));

				if ($account and $account->save())
				{
					Session::set_flash('success', 'Added account #'.$account->id.'.');

					Response::redirect('account');
				}

				else
				{
					Session::set_flash('error', 'Could not save account.');
				}
				
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		//$this->template->title = "Accounts";
		//$this->template->content = View::forge('account/create');
		return Response::forge(View::forge('account/create'));

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('account');

		if ( ! $account = Model_Account::find($id))
		{
			Session::set_flash('error', 'Could not find account #'.$id);
			Response::redirect('account');
		}

		$val = Model_Account::validate('edit');

		if ($val->run())
		{
			$account->username = Input::post('username');
			$account->password = Input::post('password');
			$account->nickname = Input::post('nickname');
			$account->avatar = Input::post('avatar');
			$account->bio = Input::post('bio');
			$account->mobile = Input::post('mobile');
			$account->points = Input::post('points');
			$account->last_login = Input::post('last_login');

			if ($account->save())
			{
				Session::set_flash('success', 'Updated account #' . $id);

				Response::redirect('account');
			}

			else
			{
				Session::set_flash('error', 'Could not update account #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$account->username = $val->validated('username');
				$account->password = $val->validated('password');
				$account->nickname = $val->validated('nickname');
				$account->avatar = $val->validated('avatar');
				$account->bio = $val->validated('bio');
				$account->mobile = $val->validated('mobile');
				$account->points = $val->validated('points');
				$account->last_login = $val->validated('last_login');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('account', $account, false);
		}

		$this->template->title = "Accounts";
		$this->template->content = View::forge('account/edit');

	}

	


}
