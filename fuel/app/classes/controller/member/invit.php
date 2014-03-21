<?php

class Controller_Member_Invit extends Controller_Center
{
    /**
     * 邀请好友
     */
    public function action_index($pagenum=1)
    {
        $count = Model_Member_Invit::count(['where'=>['member_id'=>$this->current_user->id]]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('u/invit/p', $count, 4, 4);
        $pagination = Pagination::forge('page', $config);
        $invits = Model_Member_Invit::find('all', [
                                                  'where'=>['member_id'=>$this->current_user->id],
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,]
                                         );

        list($memberIds) = Model_Member_Invit::getIds($invits, ['invit_id']);

        $members = Model_Member::byIds($memberIds);

        $view = View::forge('member/invit/index');
        $view->set('members', $members);
        $view->set('invits', $invits);
        $this->template->title = '邀请好友';
        $this->template->layout->content = $view;
    }

}
