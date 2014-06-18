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
                       'where' => ['is_delete' => 0],
                       'order_by'=>['is_top' => 'desc', 'id'=>'desc'],
                       'limit'=>9,
                       ]);
           return $notices;
       };

       //获得人气推荐1
       $this->topHotItems = function() {
           $select = ['id', 'title', 'image', 'price', 'status'];
           $items = Model_Item::find('all', ['select' => $select, 'where'=>['is_delete' => 0],
                     //'order_by'=>['hots'=>'desc'],
                     'limit'=>3
                     ]);

           return $items;
       };

       //获得人气推荐2
       $this->hotItems = function() {
           $select = ['id', 'title', 'image', 'price', 'status'];
           $items = Model_Item::find('all', ['select' => $select, 'where'=>['is_delete' => 0],
                     //'order_by'=>['hots'=>'desc'],
                     'limit'=>4,
                     'offset'=>3,
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

        // 编辑推荐
        $this->getRecommends = function() {

            $select = ['title', 'image', 'price', 'status'];
            $where = [
                'is_delete' => \Helper\Item::NOT_DELETE,
                'is_recommend' => 1
                ];

            $phases = Model_Item::find('all', ['select' => $select, 'where' => $where, 'order_by' => ['sort' => 'desc'], 'limit' => 8]);

            return $phases;
        };

   }

   public function set_view(){
       $this->_view = View::forge('index/index');
   }
}
