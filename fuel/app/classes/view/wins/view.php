<?php

class View_Wins_View extends Viewmodel {

    public function view() {
       //获得商品标题
       $this->getItem = function($itemid) {
           $item = Model_Item::find($itemid);
           return $item;
       };

       // 获取用户信息
       $this->getUser = function($mid) {
           $user = Model_Member::find($mid);
           return $user;
       };

       // 友好时间
       $this->friendlyDate = function($timestamp) {

           $timer = new \Helper\Timer();

           return $timer->friendlyDate($timestamp);
       };
    }

    public function set_view(){
        $this->_view = View::forge('wins/view');
   }

}

