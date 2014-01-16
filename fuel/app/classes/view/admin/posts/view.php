<?php
/*
*用户后台admin 晒单详情的ViewModel
*/
class View_Admin_Posts_View extends Viewmodel {
    public $status = [
        0=>'未审核',
        1=>'审核通过',
        2=>'审核通不过',
        3=>'已经删除',
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
               $text = '已经删除';
           }else{
               
              $text = $this->status[$item->status];
           }
           return $text;
       };       
    }

   public function set_view(){
       $this->_view = View::forge('admin/posts/view');
   }
}

