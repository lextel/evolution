<?php

class View_Wins_My extends Viewmodel {

        public function view() {
             //获得商品
             $this->getItem = function($win) {
                     $item = Model_Item::find($win->item_id);
                     return $item;
             };

             // 获取用户信息
             $this->getUser = function($mid) {
                     $user = Model_Member::find($mid);
                     return $user;
             };

             // 获得订单信息
             $this->getOrder = function($order_id) {
                     $order = Model_Order::find($order_id);
                     return $order;
             };

             //
             $this->getShipping = function($phase_id){
                     $shipping = Model_Shipping::find_by_phase_id($phase_id);
                     if (!$shipping){
                        return '100';
                     }
                     return $shipping->status;
             };
             $this->getShippingData = function($phase_id){
                     $shipping = Model_Shipping::find_by_phase_id($phase_id);
                     if (!$shipping){
                        return [];
                     }
                     return json_decode($shipping->exdesc);
             };
            $this->getShippingStatus = function($input){
                     Config::load('shipping');
                     $status = Config::get('status');
                     return $status[$input];
             };


        }

        public function set_view(){
                $this->_view = View::forge('member/mywins');
     }

}

