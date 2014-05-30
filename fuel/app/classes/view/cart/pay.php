<?php

class View_Cart_Pay extends Viewmodel {

    public function view() {

        // 获取商品信息
        $this->getInfo = function($phaseId){
            $phase = Model_Item::find($phaseId);

            return $phase;
        };

        // 获取用户信息
        $this->userInfo = function() {

            return Model_Member::find($this->current_user->id);
        };

    }
}
