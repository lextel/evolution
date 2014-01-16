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
       //获得单个用户
       $this->getUser = function($mid) {
           $user = Model_Member::find($mid);
           return $user;
        };
        
       // 获得往期中奖的用户列表
       $this->getMembersByPosts = function($posts) {
           $memberIds = [];
           foreach($posts as $post){
              $memberIds[] = $post->member_id;
           }
           $members = Model_Member::byIds($memberIds);
           return $members;
        };
       // 获得最新晒单的用户列表
       $this->getMembersByPhases = function($phases) {
           foreach($phases as $phase){
              $memberIds[] = $phase->member_id;
           }
           $members = Model_Member::byIds($memberIds);
           return $members;
        };
        
        
       //获得最新的晒单列表5个
       $this->getNewPosts = function(){
            $posts = Model_Post::find('all',[
                                                  'where' => ['is_delete'=>0, 'status'=>1],
                                                  'order_by' =>['id'=>'desc'],
                                                  'rows_limit'=>5,
                                                  ]);
           return $posts;
       };
       //
       // 获得最新同商品的期数
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
       // 获得最近的获奖名单
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
