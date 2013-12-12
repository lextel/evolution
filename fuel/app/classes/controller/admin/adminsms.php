<?php
class Controller_Admin_Adminsms extends Controller_Admin{
    

    private $config = array(
            'pagination_url' => 'http://www.llt.com/admin/adminsms/',
            'total_items'    => 100,//Model_Adminsm::count(),
            'per_page'       => 10,
            'uri_segment'    => 3,
            'template' => array(
                'page_start'              => '',
                'page_end'                => '',
                'previous_start'          => '<li>',
                'previous_end'            => '</li>',
                'previous_inactive_start' => '<li class="disabled">',
                'previous_inactive_end'   => '</li>',
                'next_start'              => '<li>',
                'next_end'                => '</li>',
                'next_inactive_start'     => '<li class="disabled">',
                'next_inactive_end'       => '</li>',
                'active_start'            => '<li class="active">',
                'active_end'              => '</li>',
                'regular_start'           => '<li>',
                'regular_end'             => '</li>',
        ),
     );
     
	public function action_index()
	{

		$current_user = Model_User::find_by_username(Auth::get_screen_name());
		$user_id = $current_user -> id;
		$pagination = Pagination::forge('default', $this->config);
		$data['adminsms'] = Model_Adminsm::find('all', array(
                          'where' => array(
                             array('ower_id', $user_id),
                             ),
                             'order_by' => array('id' => 'desc'),
                              'limit' => Pagination::get('per_page'),
                              'offset' => Pagination::get('offset')));

        $data['pagination'] = Pagination::create_links();
		$this->template->title = "";
		$this->template->content = View::forge('admin/adminsms/index', $data);

	}

	public function action_view($id = null)
	{
		$adminsm = Model_Adminsm::find($id);
		$adminsm->isread = 1;
		$adminsm->save();
        $data['adminsm'] = $adminsm;
		$this->template->title = "";
		$this->template->content = View::forge('admin/adminsms/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Adminsm::validate('create');

			if ($val->run())
			{
				$adminsm = Model_Adminsm::forge(array(
					'ower_id' => Input::post('ower_id'),
					'action' => Input::post('action'),
					'type' => Input::post('type'),
					'user_id' => Input::post('user_id'),
					'isread' => Input::post('isread'),
					'obj_id' => Input::post('obj_id'),
				));

				if ($adminsm and $adminsm->save())
				{
					Session::set_flash('success', e('Added adminsm #'.$adminsm->id.'.'));

					Response::redirect('admin/adminsms');
				}

				else
				{
					Session::set_flash('error', e('Could not save adminsm.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Adminsms";
		$this->template->content = View::forge('admin/adminsms/create');

	}
    
	/*public function action_edit($id = null)
	{
		$adminsm = Model_Adminsm::find($id);
		$val = Model_Adminsm::validate('edit');

		if ($val->run())
		{
			$adminsm->ower_id = Input::post('ower_id');
			$adminsm->action = Input::post('action');
			$adminsm->type = Input::post('type');
			$adminsm->user_id = Input::post('user_id');
			$adminsm->isread = Input::post('isread');
			$adminsm->obj_id = Input::post('obj_id');

			if ($adminsm->save())
			{
				Session::set_flash('success', e('Updated adminsm #' . $id));

				Response::redirect('admin/adminsms');
			}

			else
			{
				Session::set_flash('error', e('Could not update adminsm #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$adminsm->ower_id = $val->validated('ower_id');
				$adminsm->action = $val->validated('action');
				$adminsm->type = $val->validated('type');
				$adminsm->user_id = $val->validated('user_id');
				$adminsm->isread = $val->validated('isread');
				$adminsm->obj_id = $val->validated('obj_id');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('adminsm', $adminsm, false);
		}

		$this->template->title = "Adminsms";
		$this->template->content = View::forge('admin/adminsms/edit');

	}
    
	public function action_delete($id = null)
	{
		if ($adminsm = Model_Adminsm::find($id))
		{
			$adminsm->delete();

			Session::set_flash('success', e('Deleted adminsm #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete adminsm #'.$id));
		}

		Response::redirect('admin/adminsms');

	}*/


}
