<?php
class Controller_Member_Moneylog extends Controller_Center{

    //public $template = 'memberlayout';

    /*
    *用户充值明细
    */
    public function action_rechargeIndex()
    {
        $where = ['member_id'=>$this->current_user->id,'type'=>0];
        $date1 = Input::get('date1', null);
        $date2 = Input::get('date2', null);
        if (!is_null($date1) and !is_null($date2))
        {
           $where += [['created_at', '>=', strtotime($date1)], 
                'and'=>['created_at', '<=', strtotime($date2)+3600*24]];
        }
        $count = Model_Member_Moneylog::count(['where'=>$where]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('u/moneylog/p', $count, 4, 4);
        $pagination = Pagination::forge('ulogpage', $config);
        $data['list'] = Model_Member_Moneylog::find('all', [
                                              'where'=>$where,
                                              'order_by' =>array('id' => 'desc'),
                                              'rows_limit'=>$pagination->per_page,
                                              'rows_offset'=>$pagination->offset,]
                                             );
        $this->template->title = "用户充值明细";
        $this->template->layout->content = View::forge('member/moneylog/index_recharge', $data);
    }
    /*
    *用户消费明细
    */
    public function action_buyIndex()
    {
        $where = ['member_id'=>$this->current_user->id,'type'=>1];
        $date1 = Input::get('date1', null);
        $date2 = Input::get('date2', null);
        if (!is_null($date1) and !is_null($date2))
        {
           $where += [['created_at', '>=', strtotime($date1)], 
                'and'=>['created_at', '<=', strtotime($date2)+3600*24]];
        }
        $count = Model_Member_Moneylog::count(['where'=>$where]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('u/moneylog/b', $count, 4, 4);
        $pagination = Pagination::forge('ulogpage', $config);
        $data['list'] = Model_Member_Moneylog::find('all', [
                                              'where'=>$where,
                                              'order_by' =>array('id' => 'desc'),
                                              'rows_limit'=>$pagination->per_page,
                                              'rows_offset'=>$pagination->offset,]
                                             );
        $this->template->title = "用户消费明细";
        $this->template->layout->content = View::forge('member/moneylog/index_buy', $data);
    }
}
