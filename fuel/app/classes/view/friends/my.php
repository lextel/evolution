<?php

class View_Friends_my extends Viewmodel {

    public function view() {

       $this->getUserName = function($mid) {
           $user = Model_Member::find($mid);

           if(empty($user->nickname)) {
               $nickname = $user->username;
           } else {
               $nickname = $user->nickname;
           }

           return $nickname;
       };

       $this->getAvatar = function($mid) {
           $user = Model_Member::find($mid);

           return $user->avatar;
       };
    }
}
