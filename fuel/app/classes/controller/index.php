<?php

class Controller_Index extends Controller_Frontend {

    /**
     * 首页
     */
    public function action_index() {

        $phaseModel = new Model_Phase();

        $memberIds = [];
        $phaseIds = [];

        // 最新揭晓
        $data['wins'] = $phaseModel->getWins(0, 4);
        list($mids) = Model_Phase::getIds($data['wins'], ['member_id']);
        $memberIds = array_merge($memberIds, $mids);

        // 正在乐拍
        $orderModel = new Model_Order();
        $data['orders'] = $orderModel->newOrders(0, 8);
        list($mids, $pids) = Model_Order::getIds($data['orders'], ['member_id', 'phase_id']);
        $memberIds = array_merge($memberIds, $mids);
        $phaseIds = array_merge($phaseIds, $pids);

        // 晒单分享
        $postModel = new Model_Post();
        $data['posts'] =$postModel->newPosts(4); 
        list($mids, $pids) = Model_Post::getIds($data['posts'], ['member_id', 'phase_id']);
        $memberIds = array_merge($memberIds, $mids);
        $phaseIds = array_merge($phaseIds, $pids);

        // 订单的期数信息
        $data['phases'] = Model_Phase::byIds($phaseIds);
        $data['members'] = Model_Member::byIds($memberIds);

        $view = ViewModel::forge('index', 'view');
        $view->set('data', $data);
        $this->template->title = '乐乐淘';
        $this->template->layout = $view;
    }

    /*
    *购买人次总统计,每2秒调用一次，不做缓存
    */
    public function action_totalCount(){
        $response = new Response();
        $response->set_header('Content-Type', 'application/json');
        $count = Model_Order::totalCountBuy();
        $data['code'] =  0;
        $data['num'] = $count;
        return $response->body(json_encode($data));
    }
}
