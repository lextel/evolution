<?php

class View_Admin_Posts_Index extends Viewmodel {

    public function view() {
       //获得用户信息（用户名和标题）
       $this->getUser = function($mid) {
           $user = Model_Member::find($mid);
           return $user;
       };
   }

   public function set_view(){
       $this->_view = View::forge('admin/posts/index');
   }
}

