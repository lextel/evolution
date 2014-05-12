<?php
class Controller_V2admin_Applogs extends Controller_V2admin{
    //用户下载APP日志列表
    public function action_index()
    {
        $modelLog = new Model_Applog();
        $where = $modelLog->handleWhere(Input::get());
        $count = Model_Applog::count(['where' => $where]);
        $page = new \Helper\Page();
        $url = Uri::create('v2admin/applogs', 
                ['member' => Input::get('member'), 'start_at' => Input::get('start_at'), 'end_at' => Input::get('end_at')], 
                ['member' => ':member', 'start_at' => ':start_at', 'end_at' => ':end_at']);
        $config = $page->setConfig($url, $count, 'page');
        $pagination = Pagination::forge('applogspage', $config);
        $logs = Model_Applog::find('all', [
                                      'where' => $where + ['status'=>'1'],
                                      'order_by' =>array('id' => 'desc'),
                                      'rows_limit'=>$pagination->per_page,
                                      'rows_offset'=>$pagination->offset,]
                                         );

        $breads = [['name' => '用户下载APP日志列表']];

        $breadcrumb = new Helper\Breadcrumb();
        $view = ViewModel::forge('v2admin/applogs/index');
        $view->set('logs', $logs);
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "用户下载APP日志列表";
        $this->template->content = $view;

    }
   
}
