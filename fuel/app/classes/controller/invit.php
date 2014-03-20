<?php
class Controller_Invit extends Controller_Frontend{

    // 揭晓列表
    public function action_index() {

        $view = View::forge('invit/index');
        $this->template->title = "邀请有礼";
        $this->template->layout = $view;
    }


    // 邀请 
    public function action_invit() {
        $id = $this->param('id');

        is_null($id) and Response::redirect('/');

        Session::set('invit_id', base64_decode($id));

        Response::redirect('/');
    }
}
