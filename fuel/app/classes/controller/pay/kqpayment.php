<?php
/*
* 快钱
*/
class Controller_Pay_Kqpayment extends Controller_Frontend
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
                  'source'=>'快钱', 'type'=> -2,
                  'phase_id'=>'0', 'sum'=>$money * Config::get('point', 100)];
        $new = new Model_Member_Moneylog($props);
        $new->save();
        //跳转到
        $order = [];
        $order['orderId'] = $new->id;
        // 总额度需要 × 100，快钱按份来算
        $order['orderAmount'] = $money * 100;
        $order['orderTime'] = time();
        $order['ets_license'] = '';
        $order['userId'] = $userId;
        $order['action'] = 'pay';
        $order['pName'] = '支付_'.$new->id;
        $kq = new \Classes\Kqpay();
        $request = $kq->request($order);
        $view = View::forge('payment/kqbill');
        $view->set('BillRequest', $request);
        $this->template->title = '快钱跳转POST页面';
        $this->template = $view;
    }


    //支付返回
    private function payReturn($req, $userId){
        $config['impersonate'] = $userId;
        $payCart = Cart::instance('pay', $config);
        $items = $payCart->items();

        $quantity = 0;
        foreach($items as $item) {
            //$quantity += $item->get_qty() * $item->get_price();
            $quantity += $item->get_qty() * 1;
        }
        Config::load('common');

        if($quantity == (intval($req['payAmount']) / 100)) {
            $orderModel = new Model_Order();
            $orderIds = $orderModel->add($userId, $items, true);
            return true;
        }
        return false;
    }

    //充值返回
    private function rechargeReturn($req, $userId, $source = '快钱'){
        Config::load('common');
        $log = Model_Member_Moneylog::find('last', ['where'=>['member_id'=>$userId, 'type'=>'-1']]);
        $money = 0;
        if (!empty($log)){
            $money = $log->total;
        }
        //echo intval(Input::post('payAmount', 0)) /100;
        $testFlag = Config::get('99bill.testflag') ? 0 : 1;
        if ($money != (intval($req['payAmount']) / 100)){
            return false;
        }
        //总额是按分计算
        $res = Model_Member::addMoney($userId, $log->sum);
        if ($res){
            //增加充值记录
            $log->type=0;
            $log->save();
            DB::delete('member_moneylogs')->where('member_id', '=', $userId)
                                        ->where('type', '=', '-1')->execute();
            return true;
        }

    }

    //bgUrl地址指向这里
    public function action_receive()
    {
        //receive数据库设计
        /*用$MockReceive数组模拟
         * $MockReceive = array();
         * $MockReceive['id']主键;
         * $MockReceive['orderId']商户订单号;
         * $MockReceive['receiveTime']接受时间;
         * $MockReceive['queryString']http_build_encode($_REQUEST);
         * $MockReceive['dealId']快钱交易号;
         * $MockReceive['bankDealId']银行交易号;
         * $MockReceive['payResult']处理结果10：支付成功；11：支付失败;
         * $MockReceive['dealTime']快钱交易时间;
         * $MockReceive['payAmount']订单实际支付金额;
         * $MockReceive['fee']费用;
         * $MockReceive['errCode']错误代码;
         */


        /*$_REQUEST是快钱那边返回来的数据
         * merchantAcctId人民币账号，与提交订单时的块钱账号保持一致。
         * version网关版本，固定值：v2.0，与提交订单时的网关版本号保持一致。
         * language网页显示语言种类，1中文显示，与提交订单时的网页显示语言种类保持一致
         * signType签名类型，4PKI签名，与提交订单时的签名类型保持一致
         * payType支付方式，00全部，与提交订单时的支付方式保持一致
         * bankId银行代码
         * orderId商户订单号，与提交订单时的商户订单号保持一致
         * orderTime商户订单提交时间，与提交订单时的商户订单提交时间保持一致
         * orderAmount商户订单金额，与提交订单时的商户订单金额保持一致。
         * dealId快钱交易号
         * bankDealId银行交易号
         * dealTime快钱交易时间
         * payAmount订单实际支付金额
         * fee费用
         * ext1扩展字段1，与提交订单时的扩展字段1保持一致
         * ext2扩展字段2，与提交订单时的扩展字段2保持一致
         * payResult处理结果 10：支付成功；11：支付失败
         * errCode错误代码，可为空
         * signMsg签名字符串
         */
        //$BillResponse = new BillResponse($_REQUEST);
        $kq = new \Classes\Kqpay();
        $req = Input::param();
        $log = '';
        foreach($req as $key => $val){
            $log .= ":".$key.'_'.$val;
        }
        Log::error('交易日志记录：'.$log);
        $res = $kq->respone($req);
        //验证签名字符串是否正确，防止bug漏洞等
        Config::load('common');
        Log::error('---' . $res->checkSignMsg());
        Log::error('+++' . $res->isSuccess());
        $mess = '签名失败';
        if($res->checkSignMsg() && $res->isSuccess()){
            //判断订单支付是否成功
            //返回给快钱，快钱会按照redirecturl地址跳到新页面，这里是成功页面
            $action = isset($req['ext2']) ? $req['ext2']: '';
            $userId = isset($req['ext1']) ? $req['ext1']: '';
            $user = Model_Member::find($userId);
            $msg = '';
            if ($action == 'pay'){
                $msg = $this->payReturn($req, $userId);
            }
            if ($action == 'recharge'){
                $msg = $this->rechargeReturn($req, $userId);
            }
            if ($msg) {
                Log::error('快钱交易成功');
                return "<result>1</result><redirecturl>" . Config::get('99bill.success') . "</redirecturl>";exit;
            }
            $mess = '签名成功，服务器流程处理失败';
        }
        $tradeNo = trim($req['dealId']);
        Log::error('支付失败! 需要手工退帐记录:快钱流水号 ' . $tradeNo);
        Log::error('快钱交易失败,' . $mess);
        //返回给快钱，快钱会按照redirecturl地址跳到新页面，这个是失败页面
        return "<result>1</result><redirecturl>" . Config::get('99bill.fail') . "</redirecturl>";exit;
    }

    //redirecturl地址
    //成功
    public function action_success()
    {
        $req = Input::param();
        $action = isset($req['ext2']) ? $req['ext2']: '';
        $view = View::forge('payment/rechargereturn');
        if ($action == 'pay'){
            $view = View::forge('payment/return');
        }
        $this->template->title = "结果页面";
        $view->set('status', true);
        $view->set('reason', '');
        $this->template->layout = $view;
    }

    //失败
    public function action_fail()
    {
        $req = Input::param();
        $action = isset($req['ext2']) ? $req['ext2']: '';
        $view = View::forge('payment/rechargereturn');
        if ($action == 'pay'){
            $view = View::forge('payment/return');
        }
        $this->template->title = "结果页面";
        $view->set('status', false);
        $view->set('reason', '');
        $this->template->layout = $view;
    }

}
