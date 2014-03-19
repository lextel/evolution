<?php
class Controller_Invit extends Controller_Frontend{

    // 揭晓列表
    public function action_index() {

        $view = View::forge('invit/index');
        $this->template->title = "邀请";
        $this->template->layout = $view;
    }


    // 揭晓详情
    public function action_view($id = null) {

        is_null($id) and Response::redirect('w');

        $phaseModel = new Model_Phase();
        $win = $phaseModel->win($id);
        if ( empty($win) ) {
            Session::set_flash('error', '没有找到该揭晓详情'.$id);
            Response::redirect('w');
        }

        // 如果还没揭晓
        if($win->code_count == 0) {
            Response::redirect('m/'.$id);
        }

        $orderModel = new Model_Order();
        $orderCount = $orderModel->countByPhaseId($id);
        $orderCodes = $orderModel->userCodesByPhaseId($win->member_id, $id, $win->code);
        $postModel  = new Model_Post();
        $postCount  = $postModel->countByItemId($win->item_id);
        $itemModel = new Model_Item();
        $phaseCount = $itemModel->phaseCountByid($win->item_id);

        $view = ViewModel::forge('wins/view');

        $view->set('orderCount', $orderCount);
        $view->set('orderCodes', $orderCodes);
        $view->set('postCount', $postCount);
        $view->set('phaseCount', $phaseCount);
        $view->set('win', $win , false);
        $this->template->title = "晒单详情页";
        $this->template->layout = $view;
    }
}
