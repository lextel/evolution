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
       //获得最新揭晓
       $this->newWins = function() {
           $phaseModel = new Model_Phase();
           $wins = $phaseModel->getWins(0, 4);

           return $wins;
       };
       //获得人气推荐1
       $this->topHotItems = function() {
           $items = Model_Phase::find('all', ['where'=>['status'=>1, 'opentime' => 0],
                     'order_by'=>['hots'=>'desc'],
                     'rows_limit'=>3
                     ]);
           return $items;
       };
       //获得人气推荐2
       $this->hotItems = function() {
           $items = Model_Phase::find('all', ['where'=>['status'=>1, 'opentime' => 0],
                     'order_by'=>['hots'=>'desc'],
                     'rows_limit'=>4,
                     'rows_offset'=>3,
                     ]);
           return $items;
       };
       //获得最新晒单TOP1
       $this->topPost = Model_Post::find('first', ['where'=>['status'=>1],
                      'order_by'=>['id'=>'desc']
                      ]);

       //获得最新晒单TOP2
       $this->posts = function() {
           $posts = Model_Post::find('all', ['where'=>['status'=>1],
                     'order_by'=>['id'=>'desc'],
                     'rows_limit'=>2,
                     'rows_offset'=>1
                     ]);
           return $posts;
       };
       //获得最新乐拍记录
       $this->orders = function() {
           $posts = Model_Order::find('all', [
                     'order_by'=>['id'=>'desc'],
                     'rows_limit'=>8
                     ]);
           return $posts;
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

