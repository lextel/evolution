<?php
class Controller_Member_Wins extends Controller_Center{

    //public $template = 'memberlayout';

    public function action_index($pagenum=1)
    {
        $word = Input::get('word', null);
        $date1 = Input::get('date1', null);
        $date2 = Input::get('date2', null);
        $where = ['member_id'=>$this->current_user->id];
        
        $url = '/u/win/p';
        if (!is_null($word))
        {
           $where += [['title', 'like', '%'.$word.'%']];
           $url = Uri::update_query_string(['word' => $word], $url);
        }
        if (!is_null($date1) and !is_null($date2))
        {
           $where += [['opentime', '>=', strtotime($date1)], 
                'and'=>['opentime', '<=', strtotime($date2)+3600*24]];
           $url = Uri::update_query_string(['date1' => $date1, 'date2' => $date2], $url);
        } 
        $count = Model_Phase::count(['where'=>$where]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage($url, $count, 4, 4);
        $pagination = Pagination::forge('uwins', $config);     
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
