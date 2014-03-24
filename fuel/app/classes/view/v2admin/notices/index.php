<?php

class View_V2admin_Notices_Index extends ViewModel
{
    public function view() {

        $this->getUsername = function($userId) {
            $user = Model_User::find($userId);

            return $user->username;
        };
    }
}
