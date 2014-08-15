<?php

class View_V2admin_Sms_index extends ViewModel
{
    public function view()
    {
        $this->getUsername = function($userId) {
            $user = Model_Member::find($userId);
            return isset($user->nickname) ? $user->nickname: '';
        };
    }
}
