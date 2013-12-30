<?php

class Controller_Index extends Controller_Frontend {

    /*
    *首页功能
    *幻灯片播放
    *右侧公告
    *最新揭晓
    *人气推荐
    *右侧大家在乐拍
    *最下大家晒单
    */
    public function action_index() {
        $view = ViewModel::forge('index', 'view');
        $this->template->title = '乐乐淘首页';
        $this->template->layout = $view;
    }

    /*
    *购买人次总统计,每2秒调用一次，不做缓存
    */
    public function action_totalCount(){
        $response = new Response();
        $response->set_header('Content-Type', 'application/json');
        $count = Model_Order::count();
        $data['code'] =  0;
        $data['num'] = $count;
        return $response->body(json_encode($data));
    }
}
