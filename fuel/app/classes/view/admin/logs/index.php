<?php

class View_Admin_Logs_index extends ViewModel
{
    public function view()
    {
        $this->getUsername = function($userId) {
            $user = Model_User::find($userId);

            return $user->username;
        };
    }
}
