<?php

class View_Posts_Myposts extends Viewmodel {
    public $type = ['0'=>'审核中',
             '1'=>'晒单中',
             '2'=>'审核不通过'];

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
       $this->getType = function($status){
           return $this->type[$status] ? $this->type[$status] : '其他';
       };
    }
    public function set_view(){
        $this->_view = View::forge('member/myposts');
   }

}

