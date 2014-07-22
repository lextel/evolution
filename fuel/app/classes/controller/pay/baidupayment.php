<?php
/*
* 百度钱包支付
*/
class Controller_Pay_Baidupayment extends Controller_Frontend
{

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
                  'source'=>'百度钱包', 'type'=> -2,
                  'phase_id'=>'0', 'sum'=>$money * Config::get('point1', 1)];
        $new = new Model_Member_Moneylog($props);
        $new->save();
        
        $order_create_time = date("YmdHis");
        $expire_time = date('YmdHis', strtotime('+2 day'));
        $order_no = $order_create_time . sprintf ( '%06d', rand(0, 999999));
        $params = [
		        'goods_name' => iconv('utf-8', 'gb2312', '支付_' . $new->id),
		        'order_create_time' => $order_create_time,
		        'order_no' => $order_no,
		        'page_url' => Config::get('bfb.paypage'),
		        'return_url' => Config::get('bfb.payreturn'),
		        'total_amount' => $money * 100,
		        'extra' => $new->id,
        ];
        $baidu = new \Classes\Baidupay();
        return $baidu->pay($params);
    }
    
    // 购物车支付返回
    public function action_payreturn()
    {
        $baidu = new \Classes\Baidupay();
        $return = $baidu->baidureturn();
        $req = Input::param();
        $log = '';
        foreach($req as $key => $val){
            $log .= ":".$key.'_'.$val;
        }
        Log::error('百度钱包支付日志记录：'.$log);
        if (empty($return)){
            return $baidu->error();
        }
        
        $logId = isset($req['extra']) ? $req['extra'] : 0;
        $log = Model_Member_Moneylog::find('last', ['where'=>['id'=>$logId, 'type'=>'-2']]);
        if (empty($log)) return $baidu->error();
        $money = $log->total;
        $userId = $log->member_id;
        $config['impersonate'] = $userId;
        $payCart = Cart::instance('pay', $config);
        $items = $payCart->items();

        $quantity = 0;
        foreach($items as $item) {
            $quantity += $item->get_price() * $item->get_qty();
        }
        $total_amount = isset($req['total_amount']) ? $req['total_amount'] : 0;
        if($money != 0 && $quantity == (intval($req['total_amount']) / 100 && $total_amount != 0)) {
            $orderModel = new Model_Order();
            $orderIds = $orderModel->add($userId, $items, true);
            return $baidu->notify();
        }
        return $baidu->error();
    }
    
    //充值接收返回结果
    public function action_rechargereturn()
    {
        $baidu = new \Classes\Baidupay();
        $return = $baidu->baidureturn();
        $req = Input::param();
        $log = '';
        foreach($req as $key => $val){
            $log .= ":".$key.'_'.$val;
        }
        Log::error('百度钱包交易日志记录：'.$log);
        if (empty($return)){
            return $baidu->error();
        }
        
        $logId = isset($req['extra']) ? $req['extra'] : 0;
        $log = Model_Member_Moneylog::find('last', ['where'=>['id'=>$logId, 'type'=>'-1']]);
        $money = 0;
        if (!empty($log)){
            $money = $log->total;
            $userId = $log->member_id;
        }
        $total_amount = isset($req['total_amount']) ? $req['total_amount'] : 0;
        if ($money == 0 || $money != intval($total_amount) / 100 || $total_amount == 0){
            return $baidu->error();
        }
        $res = Model_Member::addMoney($userId, $money);
        if ($res){
            //增加充值记录
            $log->type=0;
            $log->save();
            DB::delete('member_moneylogs')->where('member_id', '=', $userId)
                                        ->where('type', '=', '-1')->execute();
            return $baidu->notify();
        }
        return $baidu->error();
    }
    
    //购物返回页面
    public function action_paypage()
    {
        $status = true;
        $req = Input::param();
        $result = isset($req['pay_result']) ? $req['pay_result']: '';
        if (empty($result)){
            $status = false;
        }
        if ($result != '1'){
            $status = false;
        }
        $view = View::forge('payment/return');
        $this->template->title = "结果页面";
        $view->set('status', $status);
        $view->set('reason', '');
        $this->template->layout = $view;
    }
    
    //充值返回页面
    public function action_rechargepage()
    {
        $status = true;
        $req = Input::param();
        $result = isset($req['pay_result']) ? $req['pay_result']: '';
        if (empty($result)){
            $status = false;
        }
        if ($result != '1'){
            $status = false;
        }
        $view = View::forge('payment/rechargereturn');
        $this->template->title = "结果页面";
        $view->set('status', $status);
        $view->set('reason', '');
        $this->template->layout = $view;
    }
    
}

?>
