<?php
class Controller_V2admin_Applogs extends Controller_V2admin{
    //用户下载APP日志列表
    public function action_index()
    {
        $modelLog = new Model_Awardlog();
        $where = $modelLog->handleWhere(Input::get());
        $count = Model_Awardlog::count(['where' => $where + ['status'=>'6']]);
        $page = new \Helper\Page();
        $url = Uri::create('v2admin/applogs',
                ['member' => Input::get('member'), 'start_at' => Input::get('start_at'), 'end_at' => Input::get('end_at')],
                ['member' => ':member', 'start_at' => ':start_at', 'end_at' => ':end_at']);
        $config = $page->setConfig($url, $count, 'page');
        $pagination = Pagination::forge('applogspage', $config);
        $logs = Model_Awardlog::find('all', [
                                      'where' => $where + ['status'=>'6'],
                                      'order_by' =>array('id' => 'desc'),
                                      'rows_limit'=>$pagination->per_page,
                                      'rows_offset'=>$pagination->offset,]
                                         );

        $breads = [
            ['name' => 'APP管理'],
            ['name' => 'APP用户下载']];

        $breadcrumb = new Helper\Breadcrumb();
        $view = ViewModel::forge('v2admin/applogs/index');
        $view->set('logs', $logs);
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "APP下载日志列表";
        $this->template->content = $view;

    }
    
    //APP下载日志报表
    public function action_report()
    {
        $breads = [
            ['name' => 'APP管理'],
            ['name' => 'APP下载日志报表']];

        $breadcrumb = new Helper\Breadcrumb();
        $view = View::forge('v2admin/applogs/report');
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "APP下载日志报表";
        $this->template->content = $view;
    }
    

}
