<?php

class View_V2admin_Applogs_index extends ViewModel
{
    public function view()
    {
        $this->getUsername = function($userId) {
            $user = Model_User::find($userId);
            return $user->username;
        };
    }
    
    public function set_view(){
       $this->_view = View::forge('v2admin/applogs/index');
   }
}
