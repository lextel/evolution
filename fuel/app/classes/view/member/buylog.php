
<?php

class View_Member_Buylog extends Viewmodel {

    public function view(){
         $this->getPhaseInfo = function($list) {
           list($OrderIds, ) = Model_Order::getIds($list, ['phase_id']);
           $phases = Model_Phase::byIds($OrderIds);
           return $phases;
       };
   }
   public function set_view(){
        $this->_view = View::forge('member/moneylog/index_buy');
   }

}
