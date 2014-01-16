<?php

class View_Home_Wins extends Viewmodel {


    public function view(){
    $this->getItemInfo = function($itemid) {
           $item = Model_Item::find($itemid);
           return $item;
       };
   $this->getPhaseInfo = function($phaseid) {
           $info = Model_Phase::find($phaseid);
           return $info;
       };
   }
   public function set_view(){
        $this->_view = View::forge('index/home_wins');
   }

}

