<?php
/*
*用户后台admin 晒单详情的ViewModel
*/
class View_Admin_Moneylog_Buyindex extends Viewmodel {   
    public function view() {
       //获得用户信息（用户名和标题）
       $this->getUser = function($mid) {
           $user = Model_Member::find($mid);
           return $user;
       };
       //获得商品的标题
       $this->title = function($item) {
           $phase_id = $item->phase_id;
           $phase = Model_Phase::find($phase_id);
           $title = '';
           if ($phase){
              $title = $phase->title;
           }
           return $title;
       };
       //获得商品的状态
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
       $this->_view = View::forge('admin/moneylog/buyindex');
   }
}

