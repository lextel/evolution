<?php
class Controller_Wins extends Controller_Frontend{

    // 揭晓列表
    public function action_index($pagenum=1) {

        $phaseModel = new Model_Phase();
        $count = $phaseModel->countWins();
        $page = new \Helper\Page();
        $config = $page->setCofigPage('/w/p', $count, 4, 3);

        $view = ViewModel::forge('wins/index');
        $pagination = Pagination::forge('winspage', $config);

        $offset = $pagination->offset;
        $limit  = $pagination->per_page;

        $wins = $phaseModel->getWins($offset, $limit);

        $view->set('count', $count);
        $view->set('wins', $wins);
        $this->template->title = "最新揭晓";
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

        $orderModel = new Model_Order();
        $orderCount = $orderModel->countByPhaseId($id);
        $postModel  = new Model_Post();
        $postCount  = $postModel->countByItemId($win->item_id);
        $itemModel = new Model_Item();
        $phaseCount = $itemModel->phaseCountByid($win->item_id);

        $view = ViewModel::forge('wins/view');

        $view->set('orderCount', $orderCount);
        $view->set('postCount', $postCount);
        $view->set('phaseCount', $phaseCount);
        $view->set('win', $win );
        $this->template->title = "晒单详情页";
        $this->template->layout = $view;
    }
}
