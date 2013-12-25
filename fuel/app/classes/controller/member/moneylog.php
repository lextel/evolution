<?php
class Controller_Member_Moneylog extends Controller_Center{

    public $template = 'memberlayout';

    /*
    *用户充值明细
    */
    public function action_rechargeIndex()
    {
        $count = Model_Member_Moneylog::count(['where'=>['member_id'=>$this->current_user->id,
                                                         'type'=>0]]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('u/moneylog/p', $count, 4, 4);
        $pagination = Pagination::forge('ulogpage', $config);
        $data['list'] = Model_Member_Moneylog::find('all', [
                                              'where'=>['member_id'=>$this->current_user->id,
                                                        'type'=>0],
                                              'order_by' =>array('id' => 'desc'),
                                              'rows_limit'=>$pagination->per_page,
                                              'rows_offset'=>$pagination->offset,]
                                             );
        $this->template->title = "用户充值明细";
        $this->template->content = View::forge('member/moneylog/index_recharge', $data);
    }
    /*
    *用户消费明细
    */
    public function action_buyIndex()
    {
        $count = Model_Member_Moneylog::count(['where'=>['member_id'=>$this->current_user->id,
                                                         'type'=>1]]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('u/moneylog/b', $count, 4, 4);
        $pagination = Pagination::forge('ulogpage', $config);
        $data['list'] = Model_Member_Moneylog::find('all', [
                                              'where'=>['member_id'=>$this->current_user->id,
                                                        'type'=>1],
                                              'order_by' =>array('id' => 'desc'),
                                              'rows_limit'=>$pagination->per_page,
                                              'rows_offset'=>$pagination->offset,]
                                             );
        $this->template->title = "用户消费明细";
        $this->template->content = View::forge('member/moneylog/index_buy', $data);
    }
}
