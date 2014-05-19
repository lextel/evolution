<?php
class Controller_Payment extends Controller_Frontend {

    // 发起请求
    public function action_pay() {
        $payCart = Cart::instance('pay');
        $items = $payCart->items();

        $quantity = 0;
        foreach($items as $item) {
            $quantity += $item->get_qty();
        }

        $userId = $this->current_user->id;
        return \Classes\Payment::Instance('alipay')->pay($userId, $quantity);
    }

    // 支付完成后台接收
    public function action_notify() {
        $status = Input::post('trade_status');
        if($status == 'TRADE_FINISHED' || $status == 'TRADE_SUCCESS') {
            $userId = Input::post('extra_common_param');


            $config['impersonate'] = $userId;
            $payCart = Cart::instance('pay', $config);
            $items = $payCart->items();

            $quantity = 0;
            foreach($items as $item) {
                $quantity += $item->get_qty();
            }

            if($quantity == intval(Input::post('total_fee'))) {
                $orderModel = new Model_Order();
                $orderIds = $orderModel->add($userId, $items);

                return "success";
            }
        }

        $post = '';
        foreach(Input::post() as $k => $v) {
            $post .= '|' . $k . '=' . $v; 
        }
        Log::error('会员: ID#' . $userId . '支付失败! 返回内容:' . $post);

        return "fail";

    }

    // 支付完成用户页面
    public function action_return() {
        $status = Input::get('trade_status');

        $success = false;
        if($status == 'TRADE_FINISHED' || $status == 'TRADE_SUCCESS') {
            $success = true;
        }
        $view = View::forge('payment/return');
        $view->set('status', $success);
        $this->template->title = "支付结果";
        $this->template->layout = $view;
    }
}
