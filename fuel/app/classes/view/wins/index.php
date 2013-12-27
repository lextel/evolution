<?php

class View_Wins_Index extends Viewmodel {

    public function view() {
       //获得用户信息（用户名和标题）
       $this->getUser = function($mid) {
           $user = Model_Member::find($mid);
           return $user;
       };
       
       //获得最新乐拍记录
       $this->orders = function() {
           $posts = Model_Order::find('all', [
                     'order_by'=>['id'=>'desc'],
                     'rows_limit'=>4
                     ]);
           return $posts;
       };
       
       //获得人气推荐
       $this->hotItems = function() {
           $items = Model_Phase::find('all', ['where'=>['status'=>1],
                     'order_by'=>['hots'=>'desc'],
                     'rows_limit'=>4
                     ]);
           return $items;
       };
       
       //获得商品信息
       $this->getItemInfo = function($item_id) {
           $item = Model_Item::find_by_id($item_id);
           return $item;
       };
       //获得期数信息
       $this->getPhaseInfo = function($phase_id) {
           $phase = Model_Phase::find_by_id($phase_id);
           return $phase;
       };
       //获得用户信息
       $this->getMemberInfo = function($member_id) {
           $member = Model_Member::find_by_id($member_id);
           return $member;
       }; 
   }

   public function set_view(){
       $this->_view = View::forge('wins/index');
   }
}

