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

       // 获取期数信息
       $this->getPhase = function($phaseId) {
           return Model_Phase::find($phaseId);
       };

       // 友好时间
       $this->friendlyDate = function($timestamp) {

           $timer = new \Helper\Timer();

           return $timer->friendlyDate($timestamp);
       };


       // 已开奖期数数量
       $this->openCount = function($itemId) {
           
           return Model_Phase::count(['where' => ['item_id' => $itemId, ['code_count', '!=', 0 ]]]);
       };

       // 获取进行中的期数
       $this->activePhase = function($itemId) {

           $where = ['item_id' => $itemId, 'opentime' => 0, 'status' => 1, 'is_delete' => 0];
           $phase = Model_Phase::find('first', ['where' => $where, 'order_by' => ['phase_id' => 'desc']]);

           return $phase;
       };

    }

    public function set_view(){
        $this->_view = View::forge('wins/view');
   }

}

