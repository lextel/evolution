<?php
class Controller_Admin_Logs extends Controller_Admin{

    public function action_index()
    {

        $breads = [
            ['name' => '管理日志'], 
        ];

        $logModel = new Model_Log();
        $total = $logModel->countLog(Input::get());

        $page = new \Helper\Page();
        $url = Uri::create('admin/logs', 
                ['user_id' => Input::get('user_id'), 'start_at' => Input::get('start_at'), 'end_at' => Input::get('end_at')], 
                ['user_id' => ':user_id', 'start_at' => ':start_at', 'end_at' => ':end_at']);
        $config = $page->setConfig($url, $total, 'page');
        $pagination = Pagination::forge('mypagination', $config);

        $view = ViewModel::forge('admin/logs/index');

        $get = Input::get();
        $get['offset'] = $pagination->offset;
        $get['limit'] = $pagination->per_page;

        $logs = $logModel->index($get);
        $view->set('logs', $logs);

        $users = Model_User::find('all');
        $view->set('users', $users);

        $breadcrumb = new Helper\Breadcrumb();
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);

        $this->template->title = "管理日志";
        $this->template->content = $view;
    }

}
