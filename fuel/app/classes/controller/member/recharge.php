<?php
class Controller_Member_Recharge extends Controller_Frontend{
    /*
    *增加余额功能
    */
    public function action_recharge()
    {
        $auth = Auth::instance('Memberauth');
        $current_user = $auth->check() ? Model_Member::find_by_username($auth->get_screen_name()) : null;
        if (is_null($current_user)) return Response::redirect('/signin');
        $money = intval(Input::get('money', 0));
        //跳转
        /*if (! is_numeric($money)){
            echo '充值的数目格式不正确';
            return Response::redirect('/u/money');
        }*/
        $userId = $current_user->id;
        Config::load('common');
        $props = ['member_id'=>$userId, 'total'=>$money,
                  'source'=>'支付宝', 'type'=> -1,
                  'phase_id'=>'0', 'sum'=>$money * Config::get('point', 100)];
        $new = new Model_Member_Moneylog($props);
        $new->save();
        return \Classes\Payment::Instance('alipay')->pay($userId, $money, 'recharge');
    }
}
