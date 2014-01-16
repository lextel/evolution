<?php

class View_Index extends Viewmodel {

    public function view() {
       //获得幻灯片播放
       $this->ads = function() {
           $time = time();
           $where = ['zone' => 1, 'status' => 1, 'is_delete' => 0, ['start_at', '<=', $time], ['end_at', '>=', $time]];
           $ads = Model_Ad::find('all', ['where' => $where, 'order_by' => ['sort' => 'desc']]);
           return $ads;
       };
       //获得最新公告
       $this->notices = function() {
           $notices = Model_Notice::find('all',[
                       'order_by'=>['id'=>'desc'],
                       'rows_limit'=>6,
                       ]);
           return $notices;
       };

       //获得人气推荐1
       $this->topHotItems = function() {
           $select = ['id', 'title', 'image', 'joined', 'remain', 'amount', 'cost'];
           $items = Model_Phase::find('all', ['select' => $select, 'where'=>['status'=>1, 'opentime' => 0],
                     'order_by'=>['hots'=>'desc'],
                     'rows_limit'=>3
                     ]);
           return $items;
       };

       //获得人气推荐2
       $this->hotItems = function() {
           $select = ['id', 'title', 'image', 'joined', 'remain', 'amount', 'cost'];
           $items = Model_Phase::find('all', ['select' => $select, 'where'=>['status'=>1, 'opentime' => 0],
                     'order_by'=>['hots'=>'desc'],
                     'rows_limit'=>4,
                     'rows_offset'=>3,
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
           $phase = Model_Phase::find($phase_id);

           return $phase;
       };

       //获得用户信息
       $this->getMemberInfo = function($member_id) {
           $member = Model_Member::find_by_id($member_id);
           return $member;
       };
   }

   public function set_view(){
       $this->_view = View::forge('index/index');
   }
}

