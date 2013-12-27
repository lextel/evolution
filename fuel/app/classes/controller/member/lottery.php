<?php
class Controller_Member_Lottery extends Controller_Center{

    //public $template = 'memberlayout';

    public function action_index($pagenum=1)
    {
        $count = Model_Lottery::count(['where'=>['member_id'=>$this->current_user->id]]);
        
        $data['count'] = $count;
        $page = new \Helper\Page();
        $config = $page->setCofigPage('/u/win/p', $count, 4, 4);
        $pagination = Pagination::forge('ulottery', $config);
        $data['list'] = Model_Lottery::find('all', [
                                                  'where'=>['member_id'=>$this->current_user->id],
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,]
                                         );
        $this->template->title = "用户获得商品";
        $this->template->layout->content = View::forge('member/mylottery', $data);
    }

    public function action_view($id = null)
    {
    }
}