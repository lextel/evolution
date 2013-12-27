<?php
class Controller_Wins extends Controller_Frontend{
    /*
    *默认翻页功能
    */
    public function action_index($pagenum=1)
    {
        $count = Model_Lottery::count();
        $page = new \Helper\Page();
        $config = $page->setCofigPage('/w/p', $count, 4, 3);
        $pagination = Pagination::forge('winspage', $config);
        $data['wins'] = Model_Lottery::find('all', [
                                                  
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,
                                                  ]);
        $view = ViewModel::forge('wins/index', 'view');
        $view->set('count', $count);
        $view->set('wins', $data['wins'] );
        $this->template->title = "最新揭晓";
        $this->template->layout = $view;
    }
    
    /*
    *详情功能
    */
    public function action_view($id = null)
    {
        is_null($id) and Response::redirect('w');
        if ( ! $data['win'] = Model_Post::find($id, ['where'=>['is_delete'=>0]]))
        {
            Session::set_flash('error', '未发现该晒单'.$id);
            //Response::redirect('w');
        }
        $view = ViewModel::forge('wins/view', 'view');
        $view->set('win', $data['win'] );
        $this->template->title = "晒单详情页";
        $this->template->layout = $view;
    }
}
