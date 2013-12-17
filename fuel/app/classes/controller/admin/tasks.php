<?php
class Controller_Admin_Tasks extends Controller_Admin{

	public function action_index()
	{
		$tasks = Model_Task::find('all', ['order_by' => ['id' => 'desc']]);

		// $taskModel = new Model_Task();
		// $taskModel->index();
		$this->template->title = "任务管理";
		$view = ViewModel::forge('admin/tasks/index');
		$view ->set('tasks', $tasks);
		$this->template->content = $view;

	}

	public function action_view($id = null)
	{
		$data['task'] = Model_Task::find($id);

		$this->template->title = "任务管理";
		$this->template->content = View::forge('admin/tasks/view', $data);

	}
}