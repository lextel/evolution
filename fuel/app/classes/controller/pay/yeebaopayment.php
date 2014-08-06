<?php
/*
* 易宝支付
*/
class Controller_Pay_Yeebaopayment extends Controller_Frontend
{

    // 购物车支付页面
    public function action_pay() {
        $auth = Auth::instance('Memberauth');
        $current_user = $auth->check() ? Model_Member::find_by_username($auth->get_screen_name()) : null;
        if (is_null($current_user)) return Response::redirect('/signin');

        $payCart = Cart::instance('pay');
        $items = $payCart->items();

        $quantity = 0;
        $money = 0;
        foreach($items as $item) {
            //$money += $item->get_price() * intval($item->get_qty());
            $money += intval($item->get_qty());
            $quantity += $item->get_qty();
        }
        $userId = $current_user->id;
        Config::load('common');
        $props = ['member_id'=>$userId, 'total'=>$quantity,
                  'source'=>'易宝支付', 'type'=> -2,
                  'phase_id'=>'0', 'sum'=>$money * Config::get('point', 100)];
        $new = new Model_Member_Moneylog($props);
        $new->save();
        
        $param = [
                'p2_Order' => date('YmdHis').$new->id,
                'p5_Pid' => 'pay_' . $new->id,
                'pa_MP' => 'pay_' . $new->id,
                'p3_Amt' => $money,
                'p8_Url' => Uri::base() . Config::get('yeebao.bgurl'),
        ];
        $yeebao = new \Classes\Yeebaopay();
        $params = $yeebao->pay($param);
        
        $view = View::forge('payment/yeebao');
        $view->set('params', $params);
        $this->template->title = '易宝支付跳转POST页面';
        $this->template = $view;
    }
    
    
    // 支付回调
    public function action_callback() {
        $yeebao = new \Classes\Yeebaopay();
        $cb = $yeebao->callback();
        if ($cb == 0){
            return '错误页面，签名错误';
        }
        if ($cb == 2){
            $attach = Input::get('r8_MP');
            list($action, $logId) = explode('_', $attach);
            if ($action == 'pay'){
                $msg = $this->pay($logId);
            }
            if ($action == 'recharge'){
                $msg = $this->recharge($logId);
            }
            if (!empty($msg)){
                return "支付成功";
            }       
        }
        if ($cb == 1){
            $this->yeebaoreturn();
        }
        return '支付失败';
    }
    // 购物车支付核对
    private function pay($logId, $source = '易宝支付'){
        $log = Model_Member_Moneylog::find('last', ['where'=>['id'=>$logId, 'type'=>'-2']]);
        if (empty($log)){
            Log::error("易宝支付空记录");
            return;
        }
        $userId = $log->member_id;
        $config['impersonate'] = $userId;
        $payCart = Cart::instance('pay', $config);
        $items = $payCart->items();

        $quantity = 0;
        foreach($items as $item) {
            $quantity += $item->get_qty() * 1; //$item->get_price();
        }

        if($quantity == intval(Input::get('r3_Amt'))) {
            $orderModel = new Model_Order();
            $orderIds = $orderModel->add($userId, $items, true);
            Log::error("易宝支付成功");
            return "success";
        }
        //记录需要退帐
        //流水号
        $tradeNo = trim(Input::get('r2_TrxId'));
        //订单号
        $outTradeNo = trim(Input::get('r6_Order'));
        Log::error('支付失败! 需要记录:易宝支付流水号 ' . $tradeNo . ' 订单号 ' . $outTradeNo);
        
    }
    // 充值支付核对
    private function recharge($logId, $source = '易宝支付'){
        Config::load('common');
        $log = Model_Member_Moneylog::find('last', ['where'=>['id'=>$logId, 'type'=>'-1']]);
        if (empty($log)){
            Log::error("易宝支付空记录");
            echo '支付失败';
            die;
        }
        $userId = $log->member_id;
        $money = $log->total;
        $point = $money;
        if ($point != intval(Input::get('r3_Amt', 0))){
            Log::error("易宝支付金额对不上".$point);
            echo '支付失败';
            die;
        }
        $res = Model_Member::addMoney($userId, $point);
        if ($res){
            //增加充值记录
            $log->type=0;
            $log->save();
            DB::delete('member_moneylogs')->where('member_id', '=', $userId)
                                       ->where('type', '=', '-1')->execute();
            echo '交易成功';
            die;
        }
    }
    
    // 支付结构返回
    private function yeebaoreturn() {
        $status = true;
        $attach = Input::get('r8_MP');
        list($action, $logid) = explode('_', $attach);
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
   
