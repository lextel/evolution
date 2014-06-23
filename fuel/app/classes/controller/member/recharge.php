<?php
class Controller_Member_Recharge extends Controller_Frontend{
    /*
    * 选择
    */
    public function action_recharge()
    {
        $auth = Auth::instance('Memberauth');
        $current_user = $auth->check() ? Model_Member::find_by_username($auth->get_screen_name()) : null;
        if (is_null($current_user)) return Response::redirect('/signin');
        $money = intval(Input::get('money', 0));
        $source = trim(Input::get('source', ''));
        //
        if ($source == 'alipay') {
            return Response::redirect('/u/alipay?money='.$money);
        }
        //
        if ($source == '99bill') {
            return Response::redirect('/u/kq?money='.$money);
        }
        if ($source == 'bfb') {
            return Response::redirect('/u/bfb?money='.$money);
        }
        return Response::redirect('/u/getrecharge');
    }
    /*
    * 支付宝接口
    */
    public function action_alipay()
    {
        $auth = Auth::instance('Memberauth');
        $current_user = $auth->check() ? Model_Member::find_by_username($auth->get_screen_name()) : null;
        if (is_null($current_user)) return Response::redirect('/signin');
        $money = intval(Input::get('money', 0));
        $userId = $current_user->id;
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
    public function action_kq()
    {
        $auth = Auth::instance('Memberauth');
        $current_user = $auth->check() ? Model_Member::find_by_username($auth->get_screen_name()) : null;
        if (is_null($current_user)) return Response::redirect('/signin');
        $money = intval(Input::get('money', 0));
        $userId = $current_user->id;
        Config::load('common');
        $props = ['member_id'=>$userId, 'total'=>$money,
                  'source'=>'快钱', 'type'=> -1,
                  'phase_id'=>'0', 'sum'=>$money * Config::get('point1', 1)];
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
        $view = View::forge('kqbill');
        $view->set('BillRequest', $request);
        $this->template->title = '快钱跳转POST页面';
        $this->template = $view;
    }
    /*
    * 百度钱包接口
    */
    public function action_bfb()
    {
        $auth = Auth::instance('Memberauth');
        $current_user = $auth->check() ? Model_Member::find_by_username($auth->get_screen_name()) : null;
        if (is_null($current_user)) return Response::redirect('/signin');
        $money = intval(Input::get('money', 0));
        $userId = $current_user->id;
        Config::load('common');
        $props = ['member_id'=>$userId, 'total'=>$money,
                  'source'=>'百度钱包', 'type'=> -1,
                  'phase_id'=>'0', 'sum'=>$money * Config::get('point1', 1)];
        $new = new Model_Member_Moneylog($props);
        $new->save();
        // 用于测试的商户请求支付接口的表单参数，具体的表单参数各项的定义和取值参见接口文档
        $order_create_time = date("YmdHis");
        $expire_time = date('YmdHis', strtotime('+2 day'));
        $order_no = $order_create_time . sprintf ( '%06d', rand(0, 999999));
        $params = [
		        'goods_name' => '充值_' . $new->id,
		        'order_create_time' => $order_create_time,
		        'order_no' => $order_no,
		        'page_url' => '';//$page_url,
		        'return_url' => '';//$return_url,
		        'total_amount' => $money * 100,
        ];
                
    }
}
