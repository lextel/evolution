
<?php

class Controller_Cart extends Controller_Frontend {

    // 我的购物车
    public function action_list() {

        $items = Cart::items();
        $view = ViewModel::forge('cart/list');

        $payCart = Cart::instance('pay');
        $payCart->clear();

        $view->set('items', $items);
        $this->template->title = "我的购物车";
        $this->template->layout = $view;
    }

    // 快捷购物车信息获取
    public function action_info() {

        Config::load('common');
        $carts = Cart::items();
        $ids = [0];
        foreach($carts as $cart) {
            if(!empty($cart->get_id())) { 
                $ids[] = $cart->get_id();
            }
        }

        $phases = Model_Phase::byIds($ids);
        $data = [];
        foreach($carts as $cart) {
            $data[] = [
                    'image' => \Helper\Image::showImage($phases[$cart->get_id()]->image, '80x80'),
                    'title' => $phases[$cart->get_id()]->title,
                    'unit'  => Config::get('unit'),
                    'point'  => Config::get('point'),
                    'qty'   => $cart->get_qty(),
                    'id'    => $cart->get_id(),
                    'rowId' => $cart->get_rowid(),
                ];
        }

        return json_encode($data);
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

        $ids = Input::post('ids');
        if(!empty($ids) && $this->auth->check()) {

            $items = Cart::items();
            $payCart = Cart::instance('pay');
            foreach($items as $item) {
                if(in_array($item->get_rowid(), $ids)) {
                    $payCart->add([
                        'id'  => $item->get_id(),
                        'qty' => $item->get_qty(),
                    ]);
                }
            }

            $items = $payCart->items();

            $view = ViewModel::forge('cart/pay');

            $view->set('items', $items);
            $this->template->title = "订单支付";
            $this->template->layout = $view;
        } else {
            Response::redirect('cart/list');
        }
    }

    // 删除商品
    public function action_remove($id = null) {

        is_null($id) and Response::redirect('cart/list');

        Cart::remove($id);

        Response::redirect('cart/list');
    }

    // 快捷添加购物车效果
    public function action_new() {

        $result = Cart::add([
            'id'    => Input::post('id'),
            'qty'   => Input::post('qty'),
        ]);

        $count = count(Cart::items());

        return json_encode(['status' => $result ? 'success' : 'fail', 'msg' => $count]);
    }

    // 快捷购物车删除商品
    public function action_del() {

        $id = Input::post('id');
        Cart::remove($id);

        return json_encode(['status' => 'success']);
    }

    // 更新数量
    public function action_modify() {

        $id = Input::post('id');
        $qty = Input::post('qty');

        $cart = Cart::item($id);

        $result = false;
        if(!empty($cart)) {
            $result = $cart->update('qty', $qty);
        }

        return json_encode(['status' => $result ? 'success' : 'fail']);
    }

    // 跳转支付
    public function action_dopay() {
        $bank = Input::get('bank');

        echo '跳转银行操作。';
        die;
    }

    // 完成支付处理
    public function action_complete() {

        if(!$this->auth->check()) {
            Response::redirect('cart/list');
        }

        $this->current_user->points;

        $payCart = Cart::instance('pay');
        $items = $payCart->items();
        $quantity = 0;
        foreach($items as $item) {
            $quantity += $item->get_qty();
        }
        
        $config = Config::load('common');
        $total = $quantity * $config['point'];

        if($this->current_user->points < $total) {
            Response::redirect('/');
        }

        $orderModel = new Model_Order();
        $memberId = $this->current_user->id;
        $orderIds = $orderModel->add($memberId, $items);

        // 产生空订单
        if(count($orderIds) == 1) {
            Response::redirect('/');
        }

        Response::redirect('cart/result/?orderIds='. implode(',',$orderIds));
    }

    // 支付结果
    public function action_result() {

        if(!$this->auth->check()) {
            Response::redirect('cart/list');
        }

        $orderIds = Input::get('orderIds', 0);
        $orderIds = explode(',', $orderIds);

        $memberId = $this->current_user->id;

        $orderModel = new Model_Order();
        $orders = $orderModel->orders($memberId, $orderIds);

        $view = ViewModel::forge('cart/result');

        $view->set('orders', $orders);
        $this->template->title = "支付结果";
        $this->template->layout = $view;
    }

    // 测试支付
    public function action_test() {

        return \Classes\Payment::Instance('alipay')->pay(1, 0.1);
    }

}
