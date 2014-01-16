<?php

class View_Posts_Index extends Viewmodel {

    public function view() {
       //获得用户信息（用户名和标题）
       $this->getMembersByPosts = function($posts) {
           list($memberIds, ) = Model_Post::getIds($posts, ['member_id']);
           $members = Model_Member::byIds($memberIds);
           return $members;
       };
        //获得商品标题
       $this->getItem = function($itemid) {
           $item = Model_Item::find($itemid);
           return $item;
       };
   }

   public function set_view(){
       $this->_view = View::forge('posts/index');
   }
}

