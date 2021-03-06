<?php
class Controller_Member_Recharge extends Controller_Frontend{
    public $current_user;
    /*
    * 选择
    */
    public function action_recharge()
    {
        $auth = Auth::instance('Memberauth');
        $this->current_user = $auth->check() ? Model_Member::find_by_username($auth->get_screen_name()) : null;
        if (is_null($this->current_user)) return Response::redirect('/signin');
        $source = trim(Input::get('source', ''));
        //IF太多，是否能改成LIST呢
        if ($source == 'alipay') {
            return $this->alipay();
        }
        //
        if ($source == '99bill') {
            return $this->kq();
        }
        if ($source == 'bfb') {
            return $this->bfb();
        }
        if ($source == 'yeebao') {
            return $this->yeebao();
        }
        if ($source == 'tenpay') {
            return $this->tenpay();
        }
        $arrs = ['alipay', '99bill', 'bfb', 'tenpay', 'yeebao'];
        if (!(in_array($source, $arrs)) && is_numeric($source)){
            return $this->tenpay();
        }
        return Response::redirect('/u/getrecharge');
    }
    /*
    * 支付宝接口
    */
    private function alipay()
    {
        $money = intval(Input::get('money', 0));
        $userId = $this->current_user->id;
        Config::load('common');
        $props = ['member_id'=>$userId, 'total'=>$money,
                  'source'=>'支付宝', 'type'=> -1,
                  'phase_id'=>'0', 'sum'=>$money * Config::get('point', 100)];
        $new = new Model_Member_Moneylog($props);
        $new->save();
        return \Classes\Payment::Instance('alipay')->pay($userId, $money, 'recharge');
    }

    /*
    * 快钱接口
    */
    private function kq()
    {

        $money = intval(Input::get('money', 0));
        $userId = $this->current_user->id;
        Config::load('common');
        $props = ['member_id'=>$userId, 'total'=>$money,
                  'source'=>'快钱', 'type'=> -1,
                  'phase_id'=>'0', 'sum'=>$money * Config::get('point', 100)];
        $new = new Model_Member_Moneylog($props);
        $new->save();
        //跳转到
        $order = [];
        $order['orderId'] = $new->id;
        // 总额度需要 × 100，快钱按份来算
        $order['orderAmount'] = $money * 100;
        $order['orderTime'] = $new->created_at;
        $order['ets_license'] = '';
        $order['userId'] = $userId;
        $order['action'] = 'recharge';
        $order['pName'] = '充值_' . $new->id;
        $kq = new \Classes\Kqpay();
        $request = $kq->request($order);
        $view = View::forge('payment/kqbill');
        $view->set('BillRequest', $request);
        $this->template->title = '快钱跳转POST页面';
        $this->template = $view;
    }
    /*
    * 百度钱包接口
    */
    private function bfb()
    {
        $money = intval(Input::get('money', 0));
        $userId = $this->current_user->id;
        Config::load('common');
        $props = ['member_id'=>$userId, 'total'=>$money,
                  'source'=>'百度钱包', 'type'=> -1,
                  'phase_id'=>'0', 'sum'=>$money * Config::get('point', 100)];
        $new = new Model_Member_Moneylog($props);
        $new->save();
        $order_create_time = date("YmdHis");
        $expire_time = date('YmdHis', strtotime('+2 day'));
        $order_no = $order_create_time . sprintf ( '%06d', rand(0, 999999));
        $params = [
                'goods_name' => iconv('utf-8', 'gb2312', '充值_' . $new->id),
                'order_create_time' => $order_create_time,
                'order_no' => $order_no,
                'page_url' => Config::get('bfb.rechargepage'),
                'return_url' => Config::get('bfb.rechargereturn'),
                'total_amount' => $money * 100,
                'extra' => $new->id,
        ];
        $baidu = new \Classes\Baidupay();
        return $baidu->pay($params);
    }

    /*
    * 财付通充值接口
    */
    private function tenpay()
    {
        $money = intval(Input::get('money', 0));
        $userId = $this->current_user->id;
        Config::load('common');
        $props = ['member_id'=>$userId, 'total'=>$money,
                  'source'=>'财付通', 'type'=> -1,
                  'phase_id'=>'0', 'sum'=>$money * Config::get('point', 100)];
        $new = new Model_Member_Moneylog($props);
        $new->save();
        //order_no, product_name, order_price,log_id,ip,action, bankID
        $bankID = Input::get('source') == 'tenpay' ? 'DEFAULT': Input::get('source', 'DEFAULT');
        $param = [
                'ip' => Input::ip(),
                'order_no' => date('YmdHis').$new->id,
                'product_name' => '充值',
                'action' => 'recharge',
                'order_price' => $money,
                'log_id' => $new->id,
                'bankID' => $bankID,
        ];
        $tenpay = new \Classes\Tenpay();
        return Response::redirect($tenpay->pay($param));
    }
    /*
    * 易宝支付充值接口
    */
    private function yeebao()
    {
        $money = intval(Input::get('money', 0));
        $userId = $this->current_user->id;
        Config::load('common');
        $props = ['member_id'=>$userId, 'total'=>$money,
                  'source'=>'易宝支付', 'type'=> -1,
                  'phase_id'=>'0', 'sum'=>$money * Config::get('point', 100)];
        $new = new Model_Member_Moneylog($props);
        $new->save();
        $p_name = 'pay_' . $new->id;
        Log::error($p_name);
        $param = [
                'p2_Order' => date('YmdHis').$new->id,
                'p5_Pid' => $p_name,
                'pa_MP' => 'recharge_' . $new->id,
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
}
