<?php
/*
* 财付通支付
*/
class Controller_Pay_Tenpayment extends Controller_Frontend
{
    //支付返回
    private function payReturn($logId){
        $log = Model_Member_Moneylog::find('last', ['where'=>['id'=>$logId, 'type'=>'-2']]);
        if (empty($log)){
            Log::error("财付通支付空记录");
            return;
        }
        $userId = $log->member_id;
        $config['impersonate'] = $userId;
        $payCart = Cart::instance('pay', $config);
        $items = $payCart->items();

        $quantity = 0;
        foreach($items as $item) {
            $quantity += $item->get_qty() * $item->get_price();
        }
        
        if($quantity*100 == intval(Input::get('total_fee'))) {
            $orderModel = new Model_Order();
            $orderIds = $orderModel->add($userId, $items, true);
            Log::error("财付通支付成功");
            return "success";
        }
        //记录需要退帐
        //流水号
        $tradeNo = trim(Input::get('transaction_id'));
        //订单号
        $outTradeNo = trim(Input::get('out_trade_no'));
        Log::error('支付失败! 需要记录:财付通流水号 ' . $tradeNo . ' 订单号 ' . $outTradeNo);
    }
    //充值返回
    private function rechargeReturn($logId, $source = '财付通'){
        Config::load('common');
        $log = Model_Member_Moneylog::find('last', ['where'=>['id'=>$logId, 'type'=>'-1']]);
        if (empty($log)){
            Log::error("财付通支付空记录");
            return;
        }
        $userId = $log->member_id;
        $money = $log->total;
        $point = $money * 100;
        if ($point != intval(Input::get('total_fee', 0))){
            Log::error("财付通支付金额对不上".$point);
            return;
        }
        $res = Model_Member::addMoney($userId, $point);
        if ($res){
            //增加充值记录
            $log->type=0;
            $log->save();
            DB::delete('member_moneylogs')->where('member_id', '=', $userId)
                                        ->where('type', '=', '-1')->execute();
            return "success";
        }
    }

    // 购物车支付
    public function action_pay()
    {
        $auth = Auth::instance('Memberauth');
        $current_user = $auth->check() ? Model_Member::find_by_username($auth->get_screen_name()) : null;
        if (is_null($current_user)) return Response::redirect('/signin');

        $payCart = Cart::instance('pay');
        $items = $payCart->items();

        $quantity = 0;
        $money = 0;
        foreach($items as $item) {
            $money += $item->get_price() * intval($item->get_qty());
            $quantity += $item->get_qty();
            
        }
        $userId = $current_user->id;
        Config::load('common');
        $props = ['member_id'=>$userId, 'total'=>$quantity,
                  'source'=>'财付通', 'type'=> -2,
                  'phase_id'=>'0', 'sum'=>$money * Config::get('point1', 1)];
        $new = new Model_Member_Moneylog($props);
        $new->save();
        //GET方式
        $param = [
                'ip' => Input::ip(),
                'order_no' => date('YmdHis').$new->id,
                'product_name' => '支付',
                'action' => 'pay',
                'order_price' => $money,
                'log_id' => $new->id,
        ];
        $tenpay = new \Classes\Tenpay();
        return Response::redirect($tenpay->pay($param));
    }
    //后台通知
    public function action_notify()
    {
        if (empty(Input::get('sign')))
        {
            Log::error("财付通支付空签名");
            return 'fail';
        }
        $tenpay = new \Classes\Tenpay();
        $resHandler = $tenpay->response();
        Config::load('common');
        //签名密钥
        $key = Config::get('tenpay.key');
        $resHandler->setKey($key);
        $status = false;//默认为失败
        //判断签名
        //打印输入
        $req = Input::param();
        $log = '';
        foreach($req as $key => $val){
            $log .= "&".$key.'='.$val;
        }
        Log::error('财付通交易日志记录：'.$log);
        if($resHandler->isTenpaySign()) {
            //支付结果
            $trade_state = $resHandler->getParameter("trade_state");
            //交易模式,1即时到账
            $trade_mode = $resHandler->getParameter("trade_mode");

            $attach = $resHandler->getParameter("attach");
            list($action, $logId) = explode('_', $attach);
            if("1" == $trade_mode && "0" == $trade_state) {
                $status = true;
            }
            $actions = ['pay', 'recharge'];
            if (! in_array($action, $actions)){
                Log::error("财付通支付方式正确");
                return "fail";
            }
            if ($action == 'pay'){
                $msg = $this->payReturn($logId);
            }
            if ($action == 'recharge'){
                $msg = $this->rechargeReturn($logId);
            }
            if (!empty($msg)){
                return "success";
            }
        }else{
            Log::error("财付通支付签名不正确");
        }
        return 'fail';
    }

    //结果返回页面
    public function action_return()
    {
        if (empty(Input::get('sign'))) $status = false;
        $tenpay = new \Classes\Tenpay();
        $resHandler = $tenpay->response();        
        ////////////////////////////////////
        $req = Input::param();
        $log = '';
        foreach($req as $key => $val){
            $log .= "&".$key.'='.$val;
        }
        Log::error('财付通返回日志记录：'.$log);
        ////////////////////////////////////
        Config::load('common');
        //签名密钥
        $key = Config::get('tenpay.key');
        $resHandler->setKey($key);
        $action = 'recharge';//默认为充值
        $status = false;//默认为失败
        //判断签名
        if($resHandler->isTenpaySign()) {
            //支付结果
            $trade_state = $resHandler->getParameter("trade_state");
            //交易模式,1即时到账
            $trade_mode = $resHandler->getParameter("trade_mode");

            $attach = $resHandler->getParameter("attach");
            list($action, $logid) = explode('_', $attach);
            if("1" == $trade_mode && "0" == $trade_state) {
                $status = true;
            }
        }
        $view = View::forge('payment/rechargereturn');
        if ($action == 'pay'){
            $view = View::forge('payment/return');
        }
        $this->template->title = "结果页面";
        $view->set('status', $status);
        $view->set('reason', '');
        $this->template->layout = $view;
    }
}
