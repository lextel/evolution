<?php

class Controller_Member_Brokerage extends Controller_Center
{
    /**
     * 佣金明细
     */
    public function action_index($pagenum=1)
    {
        $count = Model_Member_Brokerage::count(['where'=>['member_id'=>$this->current_user->id]]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('u/brokerage/p', $count, 4, 4);
        $pagination = Pagination::forge('page', $config);
        $brokerages = Model_Member_Brokerage::find('all', [
                                                  'where'=>['member_id'=>$this->current_user->id],
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,]
                                         );

        list($memberIds) = Model_Member_Brokerage::getIds($brokerages, ['target_id']);

        $members = Model_Member::byIds($memberIds);

        $view = View::forge('member/brokerage/index');
        $view->set('members', $members);
        $view->set('brokerages', $brokerages);
        $this->template->title = '佣金明细';
        $this->template->layout->content = $view;
    }

}
