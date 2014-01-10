<?php

class View_Admin_Shipping_Index extends Viewmodel {

    public function view() {
       //获得用户信息（用户名和标题）
       $this->getUser = function($mid) {
           $user = Model_Member::find($mid);

           return $user;
       };

       // 状态
       $this->getStatus = function($status) {
           Config::load('shipping');
           $shippingStatus = Config::get('status');
           return $shippingStatus[$status];
       };

       // 获取商品
       $this->getItem = function($phaseId) {

           return Model_Phase::find($phaseId);
       };
    }
}

