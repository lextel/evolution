<?php

class View_V2admin_Sms_index extends ViewModel
{
    public function view()
    {
        $this->getUsername = function($userId) {
            $user = Model_User::find($userId);

            return isset($user->username) ? $user->username: '';
        };
    }
}
