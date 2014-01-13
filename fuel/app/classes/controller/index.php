<?php

class Controller_Index extends Controller_Frontend {

    /**
     * 首页
     */
    public function action_index() {

        $phaseModel = new Model_Phase();

        // 最新揭晓
        $data['wins'] = $phaseModel->getWins(0, 4);

        $x  = Model_Phase::getIds($data['wins'], ['member_id', 'id']);
        print_r($x);
        die;

        $members = Model_Member::byIds();
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
