<?php

class View_Orders_my extends Viewmodel
{
    public function view(){
        $this->countOrder = function($orders){
          $data=['winstart'=>0, 'buy'=>0, 'winok'=>0];
          foreach ($orders as $order) {
            $info = Model_Phase::find($order->phase_id);
            if ($info->remain > 0){
               $data['buy'] += 1;
            }else{
               if ($info->member_id > 0){
                   $data['winok'] += 1;
               }else{
                     $data['winstart'] += 1;
               }
            }
          }
          return $data;
        };
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