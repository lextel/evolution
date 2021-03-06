<?php

class Controller_Index extends Controller_Frontend {

    /**
     * 首页
     */
    public function action_index() {

        $phaseModel = new Model_Phase();

        $memberIds = [0];
        $phaseIds = [0];

        // 最新揭晓
        $data['wins'] = $phaseModel->getWins(0, 4);
        if($data['wins']) {
            list($mids) = Model_Phase::getIds($data['wins'], ['member_id']);
            $memberIds = array_merge($memberIds, $mids);
        }

        // 正在乐淘
        $orderModel = new Model_Order();
        $data['orders'] = $orderModel->newOrders(0, 8);
        if($data['orders']) {
            list($mids, $pids) = Model_Order::getIds($data['orders'], ['member_id', 'phase_id']);
            $memberIds = array_merge($memberIds, $mids);
            $phaseIds = array_merge($phaseIds, $pids);
        }

        // 晒单分享
        $postModel = new Model_Post();
        $data['posts'] =$postModel->newPosts(4);
        if($data['posts']) {
            list($mids, $pids) = Model_Post::getIds($data['posts'], ['member_id', 'phase_id']);
            $memberIds = array_merge($memberIds, $mids);
            $phaseIds = array_merge($phaseIds, $pids);
        }

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

    /**
     * 验证礼品码
     */
    public function action_checkInvitcode() {

        $config = Config::load('common');

        $result = ['status' => 'n', 'info' => '礼品码不正确或已经使用'];
        if($config['openInvitCode']) {
            $code =  Input::post('param');
            $codeModel = new Model_Invitcode();
            if($codeModel->check($code)) {
                $result = ['status' => 'y'];
            }
        }

        $response = new Response();
        return $response->body(json_encode($result));
    }

    public function action_captcha() {
        return  Captcha::forge()->image();
    }

    /*
    * method POST
    * 输入 param
    * return json
    */
    public function action_ajaxcaptcha() {
        $result = false;
        $code =  Input::post('param');
        if(Captcha::forge()->check($code)){
            $result = true;
        }
        $response = new Response();
        return $response->body(json_encode($result));
    }


    /**
     * 获取七牛token
     *
     */
    public function action_token() {

        $bucket = Input::get('bucket');

        $buckets = ['items', 'intros', 'shares'];

        $result = ['status' => 'fail'];
        if(in_array($bucket, $buckets)) {

            $qiniu = new Classes\Qiniu();

            $token = $qiniu->getToken($bucket);
            $result = ['status' => 'success', 'token' => $token];
        }

        $response = new Response();
        return $response->body(json_encode($result));
    }
    
    /**
    *  友情链接列表
    *
    */
    public function action_links() {
        $view = View::forge('index/links');
        $this->template->title = '乐乐淘-友情链接';
        $this->template->layout = $view;
    }
}

