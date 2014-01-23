<?php

class View_Orders_index extends Viewmodel
{
    public function view()
    {
        $this->getMembersByOrders = function($orders){
            list($memberIds) = Model_Order::getIds($orders, ['member_id',]);
            $members = Model_Member::byIds($memberIds);
            return $members;
        };
         $this->getPhaseByOrders = function($orders){
            list($phaseIds) = Model_Order::getIds($orders, ['phase_id',]);
            $phases = Model_Phase::byIds($phaseIds);
            return $phases;
        };
    }

    public function set_view(){
        $this->_view = View::forge('orders/index');
   }
}