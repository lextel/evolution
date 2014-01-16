<?php

class View_Posts_Noposts extends Viewmodel {
    

    public function view() {
       //获得商品标题
       $this->getItem = function($itemid) {
           $item = Model_Item::find($itemid);
           return $item;
       };
       //
       $this->getUser = function($mid) {
           $user = Model_Member::find($mid);
           return $user;
        };
       
    }
    public function set_view(){
        $this->_view = View::forge('member/mynoposts');
   }

}

