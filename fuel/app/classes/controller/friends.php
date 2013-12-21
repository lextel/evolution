<?php

class Controller_Friends extends Controller_Center {
    public $template = 'memberlayout';

    public function action_my() {
        $friends = Model_Friend::myFriends($this->current_user->id);
        $view = ViewModel::forge('friends/my');
        $view ->set('friends', $friends);
        $this->template->title = "好友管理 &raquo; 好友列表";
        $this->template->content = $view;
    }

    public function action_follow() {

        $mid = intval(Input::post('mid'));
        if(empty($mid)) {
            return json_encode(['status' => 'fail']);
        }

        $friendModel = new Model_Friend();
        if($friendModel->check($mid)) {
            return json_encode(['status' => 'fail', 'msg' => 'exists']);
        }

        $rs = $friendModel->unfollow($mid);
        if($rs) {
            $result = ['status' => 'success'];
        } else {
            $result = ['status' => 'fail'];
        }

        return json_encode($result);
    }

    public function action_unfollow() {

        $mid = intval(Input::post('mid'));
        if(empty($mid)) return json_encode(['status' => 'fail']);
        $rs = Model_Friend::unfollow($mid, $this->current_user->id);
        if($rs) {
            $result = ['status' => 'success'];
        } else {
            $result = ['status' => 'fail'];
        }

        return json_encode($result);
    }

}
