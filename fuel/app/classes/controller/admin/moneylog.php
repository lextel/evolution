<?php
class Controller_Admin_Moneylog extends Controller_Admin{
    //用户消费记录查询
    public function action_buy()
    {
        $count = Model_Member_Moneylog::count(['where'=>['type'=>1]]);
        $page = new \Helper\Page();
        $url = Uri::create('/admin/moneylog/buy');
        $config = $page->setConfig($url, $count, 'page');
        $pagination = Pagination::forge('alogspage', $config);
        $logs = Model_Member_Moneylog::find('all', [
                                                  'where'=>['type'=>1],
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,]
                                         );
        $breads = [['name' => '财务管理']];
        $breadcrumb = new Helper\Breadcrumb();
        $view = ViewModel::forge('admin/moneylog/buyindex', 'view');
        //$view = View::forge('admin/moneylog/buyindex');
        $view->set('logs', $logs);
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "用户消费记录列表";
        $this->template->content = $view;
    }
    
    //用户充值记录查询
    public function action_recharge()
    {
        $breads = [['name' => '财务管理']];

        $breadcrumb = new Helper\Breadcrumb();
        //$view = ViewModel::forge('admin/moneylog/rechargeindex', 'view');
        $view = View::forge('admin/moneylog/rechargeindex');
        $view->set('logs', $logs);
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "用户充值记录列表";
        $this->template->content = $view;
    }

}
    
    
    
