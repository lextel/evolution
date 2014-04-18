<?php

class View_V2admin_Posts_Index extends Viewmodel {
    public $status = [
        0=>'未审核',
        1=>'通过',
        2=>'驳回',
        3=>'已删除',
        ];

    public function view() {
       //获得用户信息（用户名和标题）
       $this->getUser = function($mid) {
           $user = Model_Member::find($mid);
           return $user;
       };
       //获得商品的标题
       $this->getPhase = function($item) {
           $phase_id = $item->phase_id;
           $phase = Model_Phase::find($phase_id);
           return $phase;
       };
       //获得商品的标题
       $this->getStatus = function($item) {
           if ($item->is_delete == 1){
               $text = '已删除';
           }else{
               
              $text = $this->status[$item->status];
           }
           return $text;
       };       
    }

   public function set_view(){
       $this->_view = View::forge('v2admin/posts/index');
   }
}

