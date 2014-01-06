
<?php

class View_Member_Address extends Viewmodel {

    public function view(){
        $this->getAddress = function($address) {
           // $address = utf8_encode($address);
            $res = '';
            $res = implode(" ",  unserialize($address));
            return $res;
       };
   }
   public function set_view(){
        $this->_view = View::forge('member/myaddress');
   }

}
