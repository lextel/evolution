<?php
class Controller_Member_Wins extends Controller_Center{

    //public $template = 'memberlayout';

    public function action_index($pagenum=1)
    {
        $word = Input::get('word');
        $date1 = Input::get('date1');
        $date2 = Input::get('date2');
        $where = ['member_id'=>$this->current_user->id];
        if (!is_null($word))
        {
           $where = [];
        }
        if (!is_null($date1) and !isnull($date2))
        {
           $where = [];
        }
        $count = Model_Phase::count(['where'=>$where]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('/u/win/p', $count, 4, 4);
        $pagination = Pagination::forge('ulottery', $config);
        $list = Model_Phase::find('all', [
                                                  'where'=>$where,
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,]
                                         );
        $view = ViewModel::forge('wins/my', 'view');
        $view->set('list', $list);
         $view->set('wincount', $count);
        $this->template->title = "用户获得商品";
        $this->template->layout->content = $view;
    }
    
}
