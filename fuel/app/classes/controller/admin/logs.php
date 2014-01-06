<?php
class Controller_Admin_Logs extends Controller_Admin{

    public function action_index()
    {

        $breads = [
            ['name' => '管理日志'], 
        ];

        $total = Model_Log::count();

        $page = new \Helper\Page();
        $url = Uri::create('/admin/logs');
        $config = $page->setConfig($url, $total, 'page');
        $pagination = Pagination::forge('mypagination', $config);

        $view = ViewModel::forge('admin/logs/index');

        $logModel = new Model_Log();
        $logs = $logModel->index($pagination->offset, $pagination->per_page);
        $view->set('logs', $logs);

        $breadcrumb = new Helper\Breadcrumb();
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);

        $this->template->title = "管理日志";
        $this->template->content = $view;
    }

}
