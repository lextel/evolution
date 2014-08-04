<?php

class View_V2admin_Invitcodes_index extends ViewModel
{
    public function view()
    {
        $this->getUsername = function($userId) {
            $user = Model_Member::find($userId);

            return $user->nickname ? $user->nickname : $user->username;
        };
    }
    public function set_view(){
       $this->_view = View::forge('v2admin/invitcodes/index');
   }
}
