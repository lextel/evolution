<?php
class Controller_Admin_Notices extends Controller_Admin{

	public function action_index()
	{
		$data['notices'] = Model_Notice::find('all');
		$this->template->title = "Notices";
		$this->template->content = View::forge('admin/notices/index', $data);

	}

	public function action_view($id = null)
	{
		$data['notice'] = Model_Notice::find($id);

		$this->template->title = "Notice";
		$this->template->content = View::forge('admin/notices/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Notice::validate('create');

			if ($val->run())
			{
				$notice = Model_Notice::forge(array(
					'title' => Input::post('title'),
					'summary' => Input::post('summary'),
					'desc' => Input::post('desc'),
				));

				if ($notice and $notice->save())
				{
					Session::set_flash('success', e('Added notice #'.$notice->id.'.'));

					Response::redirect('admin/notices');
				}

				else
				{
					Session::set_flash('error', e('Could not save notice.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Notices";
		$this->template->content = View::forge('admin/notices/create');

	}

	public function action_edit($id = null)
	{
		$notice = Model_Notice::find($id);
		$val = Model_Notice::validate('edit');

		if ($val->run())
		{
			$notice->title = Input::post('title');
			$notice->summary = Input::post('summary');
			$notice->desc = Input::post('desc');

			if ($notice->save())
			{
				Session::set_flash('success', e('Updated notice #' . $id));

				Response::redirect('admin/notices');
			}

			else
			{
				Session::set_flash('error', e('Could not update notice #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$notice->title = $val->validated('title');
				$notice->summary = $val->validated('summary');
				$notice->desc = $val->validated('desc');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('notice', $notice, false);
		}

		$this->template->title = "Notices";
		$this->template->content = View::forge('admin/notices/edit');

	}

	public function action_delete($id = null)
	{
		if ($notice = Model_Notice::find($id))
		{
			$notice->delete();

			Session::set_flash('success', e('Deleted notice #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete notice #'.$id));
		}

		Response::redirect('admin/notices');

	}


}