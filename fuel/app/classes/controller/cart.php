<?php

class Controller_Cart extends Controller_Frontend{

    // 我的购物车
    public function action_list() {

        $items = Cart::items();
        $view = ViewModel::forge('cart/list');

        $view->set('items', $items);
        $this->template->title = "我的购物车";
        $this->template->layout = $view;
    }

    // 添加到购物车
    public function action_add() {

        Cart::add([
            'id'    => Input::post('id'),
            'qty'   => Input::post('qty'),
        ]);

        Response::redirect('cart/list');
    }

    // 支付页面
    public function action_pay() {

        $items = Cart::items();
        $view = ViewModel::forge('cart/pay');

        $view->set('items', $items);
        $this->template->title = "订单支付";
        $this->template->layout = $view;
    }

    // 删除商品
    public function action_remove() {

        $ids = Input::post('ids');

        $items = Cart::items();
        foreach($items as $item) {
            if(in_array($item->get_id(), $ids)) {
                $item->delete();
            }
        }

        Response::redirect('cart/list');
    }

    // 跳转支付
    public function action_dopay() {
        $bank = Input::get('bank');

        echo '跳转银行操作。';
        die;
    }

    // 完成支付处理
    public function action_complete() {

        // TODO 检查银行结果支付失败跳转首页
        if(false) {
            Response::redirect('/');
        }

        $items = Cart::items();
        $orderModel = new Model_Order();
        $memberId = $this->current_user->id;
        $orderIds = $orderModel->add($memberId, $items);

        Response::redirect('cart/result/?orderIds='. implode(',',$orderIds));
    }

    // 支付结果
    public function action_result() {

        $orderIds = Input::get('orderIds', 0);
        $orderIds = explode(',', $orderIds);

        $orderModel = new Model_Order();
        $orders = $orderModel->orders($orderIds);

        $view = ViewModel::forge('cart/result');

        $view->set('orders', $orders);
        $this->template->title = "支付结果";
        $this->template->layout = $view;
    }

}
