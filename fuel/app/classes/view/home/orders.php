<?php

class View_Home_Orders extends Viewmodel {


    public function view(){
        $this->getItemInfo = function($itemid) {
           $item = Model_Item::find($itemid);
           return $item;
       };
        $this->getPhaseInfos = function($orders) {
           list($phaseIds, ) = Model_Order::getIds($orders, ['phase_id']);
           $phases = Model_Phase::byIds($phaseIds);
           return $phases;
       };
       $this->getProgress = function($phase){
          $info =  $phase;
          $res = $info->joined/$info->amount * 100;
          return $res;
    };
   }
   public function set_view(){
        $this->_view = View::forge('index/home_orders');
   }

}

