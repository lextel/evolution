<?php

class View_Orders_my extends Viewmodel
{
    public function view(){
        $this->getItemInfo = function($itemid) {
               $item = Model_Item::find($itemid);
               return $item;
           };
       $this->getUser = function($member_id) {
               $member = Model_Member::find($member_id);
               return $member;
        };
       $this->getPhaseInfo = function($phaseid) {
               $info = Model_Phase::find($phaseid);
               return $info;
           };
        $this->getImage = function($pahse_id){
            return ;
        };
   }
   public function set_view(){
        $this->_view = View::forge('member/myorders');
   }
}