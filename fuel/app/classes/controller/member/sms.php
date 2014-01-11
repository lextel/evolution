<?php
class Controller_Member_Sms extends Controller_Center{

    public function action_index()
    {
        $count = Model_Member_Sm::count(['where'=>['owner_id'=>$this->current_user->id]]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('u/message/p', $count, 4, 4);
        $pagination = Pagination::forge('message', $config);
        $data['member_sms'] = Model_Member_Sm::find('all', [
                                                  'where'=>['owner_id'=>$this->current_user->id],
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,]
                                         );
        $this->template->title = "Member_sm";
        $this->template->layout->content = View::forge('member/sms/index', $data);
    }

    public function action_view($id = null)
    {
        is_null($id) and Response::redirect('member/sms');

        if ( ! $data['member_sm'] = Model_Member_Sm::find($id))
        {
            Session::set_flash('error', 'Could not find member_sm #'.$id);
            Response::redirect('member/sms');
        }

        $this->template->title = "Member_sm";
        $this->template->content = View::forge('member/sms/view', $data);

    }

}
