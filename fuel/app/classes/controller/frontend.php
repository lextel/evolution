<?php

class Controller_Frontend extends Controller_Template {

    /**
     * @var auth 实例对象
     */
    public $auth;

    /**
     * @var 当前用户信息
     */
    public $current_user;

    /**
     * 获取当前登陆信息并赋值到view层
     */
    public function before() {

        parent::before();
        $this->auth = Auth::instance('Memberauth');
        if (Config::get('auth.driver', 'Memberauth') == 'Ormauth') {
            $this->current_user = $this->auth->check() ? Model\Auth_Member::find_by_username($this->auth->get_screen_name()) : null;
        } else {
            $this->current_user = $this->auth->check() ? Model_Member::find_by_username($this->auth->get_screen_name()) : null;
        }
        $count = Model_Order::totalCountBuy();
        View::set_global('count', $count);
        View::set_global('current_user', $this->current_user);


        // 统计购物车数量
        $cartCount = count(Cart::items());
        View::set_global('cartCount', $cartCount);
    }
}
