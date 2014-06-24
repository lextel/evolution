<?php
/*
* 购物车选择支付
*/
class Controller_Pay_Cartment extends Controller_Frontend
{

    /*
    * 选择
    */
    public function action_cartpay()
    {
        $auth = Auth::instance('Memberauth');
        $current_user = $auth->check() ? Model_Member::find_by_username($auth->get_screen_name()) : null;
        if (is_null($current_user)) return Response::redirect('/signin');
        $source = trim(Input::get('source', ''));
        //
        if ($source == 'alipay') {
            return Response::redirect('alipay/pay');
        }
        //
        if ($source == '99bill') {
            return Response::redirect('99bill/pay');
        }
        //
        if ($source == 'bfb') {
            return Response::redirect('bfb/pay');
        }
        return Response::redirect('cart/pay');
    }
    
}
