<?php
class Controller_V2admin_Suggests extends Controller_V2admin{
    //反馈意见列表
    public function action_index()
    {        
        $count = Model_Suggest::count();
        
        $page = new \Helper\Page();
        $url = Uri::create('v2admin/suggests');
        $config = $page->setConfig($url, $count, 'page');
        $pagination = Pagination::forge('suggestpage', $config);
        $suggests = Model_Suggest::find('all', [
                                                  //'where' =>$etype,
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,]
                                         );

        $breads = [['name' => '反馈列表']];

        $breadcrumb = new Helper\Breadcrumb();
        $view = View::forge('v2admin/suggests/index');
        $view->set('suggests', $suggests);
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "反馈列表";
        $this->template->content = $view;
    }
    
    public function action_view($id=null)
    {
    
    }
    
}
