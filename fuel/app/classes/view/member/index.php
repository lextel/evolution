<?php

class View_Member_Index extends Viewmodel {


    public function view(){
        $this->getNotices = function() {
           $notices = Model_Notice::find('all',[
                       'order_by'=>['id'=>'desc'],
                       'rows_limit'=>6,
                       ]);
           return $notices;
       };
      $this->getPhaseInfos = function($orders) {
           list($phaseIds, ) = Model_Order::getIds($orders, ['phase_id']);
           $phases = Model_Phase::byIds($phaseIds);
           return $phases;
       };
      $this->getItemInfo = function($itemid) {
           $item = Model_Item::find($itemid);
           return $item;
       };
       $this->getPhaseInfo = function($phaseid) {
           $info = Model_Phase::find($phaseid);
           return $info;
       };
       $this->getProgress = function($phase){
          $info = $phase;
          $res = $info->joined/$info->amount * 100;
          return $res;
        };
   }
   public function set_view(){
        $this->_view = View::forge('member/index');
   }

}
