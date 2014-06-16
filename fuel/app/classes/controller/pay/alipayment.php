<?php
class Controller_Pay_AliPayment extends Controller_Frontend {
    //支付返回
    private function payReturn($userId){
        $config['impersonate'] = $userId;
        $payCart = Cart::instance('pay', $config);
        $items = $payCart->items();

        $quantity = 0;
        foreach($items as $item) {
            $quantity += $item->get_qty();
        }
        if($quantity == intval(Input::post('total_fee'))) {
            $orderModel = new Model_Order();
            $orderIds = $orderModel->add($userId, $items, true);
            return "success";
        }
        //记录需要退帐
        //流水号
        $tradeNo = trim(Input::post('trade_no'));
        //订单号
        $outTradeNo = trim(Input::post('out_trade_no'));
        Log::error('支付失败! 需要手工退帐记录:支付宝流水号 ' . $tradeNo . ' 订单号 ' . $outTradeNo);    
    }
    //充值返回
    private function rechargeReturn($user, $source = '支付宝'){
        Config::load('common');
        $log = Model_Member_Moneylog::find('last', ['where'=>['member_id'=>$user->id, 'type'=>'-1']]);
        $money = 0;
        if (!empty($log)){
            $money = $log->total;
        }
        $point = $money * Config::get('point');
        if ($money != intval(Input::post('total_fee', 0))){
            return;
        }
        $res = Model_Member::addMoney($user->id, $point);
        if ($res){
            //增加充值记录
            $log->type=0;
            $log->save();
            DB::delete('member_moneylogs')->where('member_id', '=', $user->id)
                                        ->where('type', '=', '-1')->execute();
            return "success";
        }
    }
    // 发起支付请求
    public function action_pay() {
        //登录验证
        $auth = Auth::instance('Memberauth');
        $current_user = $auth->check() ? Model_Member::find_by_username($auth->get_screen_name()) : null;
        if (is_null($current_user)) return Response::redirect('/signin');

        $payCart = Cart::instance('pay');
        $items = $payCart->items();

        $quantity = 0;
        foreach($items as $item) {
            $quantity += $item->get_qty();
        }

        return \Classes\Payment::Instance('alipay')->pay($current_user->id, $quantity);
    }

    // 支付完成后台接收
    public function action_notify() {
        set_time_limit(0);
        $status = Input::post('trade_status');
        if($status == 'TRADE_FINISHED' || $status == 'TRADE_SUCCESS') {
            $extra_param = explode('_', trim(Input::post('extra_common_param')));
            if (count($extra_param) != 3){
                return "fail";
            }
            list($userId, $action, $soucre) = $extra_param;

            $actions = ['pay', 'recharge'];
            if (! in_array($action, $actions)){
                return "fail";
            }
            $user = Model_Member::find($userId);
            if ($action == 'pay'){
                $msg = $this->payReturn($userId);
            }
            if ($action == 'recharge'){
                $msg = $this->rechargeReturn($user);
            }
            if (!empty($msg)){
                return "success";
            }
        }
        $post = '';
        foreach(Input::post() as $k => $v) {
            $post .= '|' . $k . '=' . $v;
        }
        Log::error('支付失败! 返回内容:' . $post);
        return "fail";

    }

    // 支付完成用户页面
    public function action_return() {
        $status = Input::get('trade_status');
        $success = false;
        $reason = Input::get('error_code', '');
        $view = View::forge('payment/fail');
        $extra_param = explode('_', trim(Input::get('extra_common_param')));

        if (count($extra_param) != 3){
            $reason = "错误的参数";
            $view->set('reason', $reason);
            $this->template->title = "错误的结果";
            $this->template->layout = $view;
            return;
        }
        list($userId, $action, $soucre) = $extra_param;

        $actions = ['pay', 'recharge'];
        if (! in_array($action, $actions)){
            $reason = "错误的操作";
            $view->set('reason', $reason);
            $this->template->title = "错误的结果";
            $this->template->layout = $view;
            return;
        }

        if ($action == 'pay'){
            if($status == 'TRADE_FINISHED' || $status == 'TRADE_SUCCESS') {
                $success = true;
            }
            $view = View::forge('payment/return');
            $this->template->title = "支付结果";
        }
        if ($action == 'recharge'){
            if($status == 'TRADE_FINISHED' || $status == 'TRADE_SUCCESS') {
                $success = true;
            }
            $view = View::forge('payment/rechargereturn');
            $this->template->title = "充值结果";
        }
        $view->set('status', $success);
        $view->set('reason', $reason);
        $this->template->layout = $view;
    }
}
