<?php

class View_Posts_View extends Viewmodel {

    public function view() {
       //获得商品标题
       $this->getItem = function($itemid) {
           $item = Model_Item::find($itemid);
           return $item;
       };
       //获得商品
       $this->getPhase = function($phaseid) {
           $phase = Model_Phase::find($phaseid);
           return $phase;
       };
       //
       $this->getUser = function($mid) {
           $user = Model_Member::find($mid);
           return $user;
        };
       //
       $this->getNewPosts = function(){
            $posts = Model_Post::find('all',[
                                                  'where' => ['is_delete'=>0, 'status'=>1],
                                                  'order_by' =>['id'=>'desc'],
                                                  'rows_limit'=>5,
                                                  ]);
           return $posts;
       };
       //

       $this->getLastPhase = function($item_id){
            $phase = Model_Phase::find('first',[
                                                  'where' => ['item_id'=>$item_id, 'and'=>['member_id', '=', 0]],
                                                  'order_by' =>['id'=>'desc'],
                                                  'rows_limit'=>1,
                                                  ]);
            if (!$phase){
              return$phase = [];
            }
           return $phase;
       };

       $this->getLastWins = function($item_id){
            $wins = Model_Phase::find('all',[
                                                  'where' => ['item_id'=>$item_id, 'and'=>['member_id', '!=', 0]],
                                                  'order_by' =>['id'=>'desc'],
                                                  'rows_limit'=>5,
                                                  ]);
            if (!$wins){
              return$wins = [];
            }
           return $wins;
       };
    }
    public function set_view(){
        $this->_view = View::forge('posts/view');
   }

}

