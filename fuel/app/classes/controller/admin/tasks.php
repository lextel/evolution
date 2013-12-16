<?php
class Controller_Admin_Tasks extends Controller_Admin{

	public function action_index()
	{
		$data['tasks'] = Model_Task::find('all', ['order_by' => ['id' => 'desc']]);
		$this->template->title = "任务管理";
		$this->template->content = View::forge('admin/tasks/index', $data);

	}

	public function action_view($id = null)
	{
		$data['task'] = Model_Task::find($id);

		$this->template->title = "任务管理";
		$this->template->content = View::forge('admin/tasks/view', $data);

	}
}