<?php

class View_Wins_View extends Viewmodel {

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
        //
        $this->getNewPosts = function(){
            $posts = Model_Post::find('all',[
                                                  'where' => ['is_delete'=>0],
                                                  'order_by' =>['id'=>'desc'],
                                                  'rows_limit'=>5,
                                                  ]);
            return $posts;
        };
        //
        $this->getLastWins = function($item_id){
            $wins = Model_Lottery::find('all',[
                                                  'where' => ['item_id'=>$item_id],
                                                  'order_by' =>['id'=>'desc'],
                                                  'rows_limit'=>5,
                                                  ]);
            return $wins;
        };
    }
    public function set_view(){
        $this->_view = View::forge('wins/view');
   }

}

