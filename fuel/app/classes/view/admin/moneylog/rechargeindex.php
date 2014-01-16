<?php
/*
*用户后台admin 账户明细的ViewModel
*/
class View_Admin_Moneylog_Rechargeindex extends Viewmodel {   
    public function view() {
       //获得用户信息（用户名和标题）
       $this->getuser = function($mid) {
           $user = Model_Member::find($mid);
           $name = '';
           if ($user)
           {
               $name = $user->username;
           }
           return $name;
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
           $phase_id = $item->phase_id;
           $phase = Model_Phase::find($phase_id);
           $status = '-';
           if ($phase){
              $t = $phase->opentime;
              if ($t != 0)
              {
                 $status = "已经揭晓";
              }else{
                 $status = "进行中";
                 if ($phase->remain == 0){
                   $status = '即将揭晓';
                 }                 
              }              
           }
           return $status;
       };  
    }

   public function set_view(){
       $this->_view = View::forge('admin/moneylog/rechargeindex');
   }
}

