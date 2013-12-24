<?php

class Controller_Cart extends Controller_Template {

    // 我的购物车
    public function action_list() {

        $items = Cart::items();
        $view = ViewModel::forge('cart/list');
        
        $view->set('items', $items);
        $this->template->title = "我的购物车";
        $this->template->content = $view;
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
        $this->template->title = "我的购物车";
        $this->template->content = $view;
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

}
