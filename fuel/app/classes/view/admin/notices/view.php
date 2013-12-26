<?php

class View_Admin_Notices_View extends ViewModel
{
    public function view() {

        $this->getUsername = function($userId) {
            $user = Model_User::find($userId);

            return $user->username;
        };
    }
}
