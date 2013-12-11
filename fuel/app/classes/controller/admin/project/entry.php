<?php
class Controller_Admin_Project_Entry extends Controller_Admin{

	public function action_index()
	{
		$data['project_entries'] = Model_Project_Entry::find('all');
		$this->template->title = "Project_entries";
		$this->template->content = View::forge('admin/project/entry/index', $data);

	}

	public function action_view($id = null)
	{
		$data['project_entry'] = Model_Project_Entry::find($id);

		$this->template->title = "Project_entry";
		$this->template->content = View::forge('admin/project/entry/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Project_Entry::validate('create');

			if ($val->run())
			{
				$project_entry = Model_Project_Entry::forge(array(
					'title' => Input::post('title'),
					'abstract' => Input::post('abstract'),
					'full_text' => Input::post('full_text'),
					'project_id' => Input::post('project_id'),
					'is_draft' => Input::post('is_draft'),
					'order' => Input::post('order'),
				));

				if ($project_entry and $project_entry->save())
				{
					Session::set_flash('success', e('Added project_entry #'.$project_entry->id.'.'));

					Response::redirect('admin/project/entry');
				}

				else
				{
					Session::set_flash('error', e('Could not save project_entry.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Project_Entries";
		$this->template->content = View::forge('admin/project/entry/create');

	}

	public function action_edit($id = null)
	{
		$project_entry = Model_Project_Entry::find($id);
		$val = Model_Project_Entry::validate('edit');

		if ($val->run())
		{
			$project_entry->title = Input::post('title');
			$project_entry->abstract = Input::post('abstract');
			$project_entry->full_text = Input::post('full_text');
			$project_entry->project_id = Input::post('project_id');
			$project_entry->is_draft = Input::post('is_draft');
			$project_entry->order = Input::post('order');

			if ($project_entry->save())
			{
				Session::set_flash('success', e('Updated project_entry #' . $id));

				Response::redirect('admin/project/entry');
			}

			else
			{
				Session::set_flash('error', e('Could not update project_entry #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$project_entry->title = $val->validated('title');
				$project_entry->abstract = $val->validated('abstract');
				$project_entry->full_text = $val->validated('full_text');
				$project_entry->project_id = $val->validated('project_id');
				$project_entry->is_draft = $val->validated('is_draft');
				$project_entry->order = $val->validated('order');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('project_entry', $project_entry, false);
		}

		$this->template->title = "Project_entries";
		$this->template->content = View::forge('admin/project/entry/edit');

	}

	public function action_delete($id = null)
	{
		if ($project_entry = Model_Project_Entry::find($id))
		{
			$project_entry->delete();

			Session::set_flash('success', e('Deleted project_entry #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete project_entry #'.$id));
		}

		Response::redirect('admin/project/entry');

	}


}