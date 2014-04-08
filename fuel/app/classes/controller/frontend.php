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
        $this->current_user = $this->auth->check() ? Model_Member::find_by_username($this->auth->get_screen_name()) : null;
        if ($this->auth->check()){
            $smscount = Model_Member_Sm::count(['where'=>['owner_id'=>$this->current_user->id, ['status'=>Null, 'or'=>['status'=>0,]]]]);
            if ($smscount > 0) {
                View::set_global('isnew', $smscount);
            }else{
                View::set_global('isnew', false);
            }
        }

        $count = Model_Order::totalCountBuy();
        View::set_global('count', $count);

        View::set_global('current_user', $this->current_user);
        // 统计购物车数量
        $cartCount = count(Cart::items());
        View::set_global('cartCount', $cartCount);

    }
}
