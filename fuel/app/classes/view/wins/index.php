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
           $orders = Model_Order::find('all', [
                     'order_by'=>['id'=>'desc'],
                     'rows_limit'=>8
                     ]);
           return $orders;
       };
       // 通过中奖列表获得中奖者,以及订单的列表信息，用户揭晓列表
       $this->getMembersByWin=function($wins){
           list($memberIds, $orderIds) = Model_Phase::getIds($wins, ['member_id', 'order_id']);
           $members = Model_Member::byIds($memberIds);
           $orders = Model_Order::byIds($orderIds);
           return [$members, $orders];
       };
       // 通过订单列表获得下单者的列表信息，用户最新订单列表
       $this->getMembersByOrder=function($orders){
           list($memberIds, $phaseIds) = Model_Order::getIds($orders, ['member_id', 'phase_id']);
           $members = Model_Member::byIds($memberIds);
           $phases = Model_Phase::byIds($phaseIds);
           return [$members, $phases];
       };
       

       //获得人气推荐
       $this->hotItems = function() {

           $phases = Model_Phase::find('all', ['where'=>['status'=>1, 'is_delete' => 0, 'opentime' => 0],
                     'order_by'=>['hots'=>'desc'],
                     'rows_limit'=>4
                     ]);
           return $phases;
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

       // 来自
       $this->getFrom = function($orderId){

           $order = Model_Order::find($orderId);

           return $order->area;
       };


       // 友好时间
       $this->friendlyDate = function($timestamp) {

           $timer = new \Helper\Timer();

           return $timer->friendlyDate($timestamp);
       };

   }

   public function set_view(){
       $this->_view = View::forge('wins/index');
   }
}

