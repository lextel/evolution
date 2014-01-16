<?php

class View_Cart_Pay extends Viewmodel {

    public function view() {

        // 获取商品信息
        $this->getInfo = function($phaseId){
            $phase = Model_Phase::find($phaseId);

            $itemModel = new Model_Item();

            return $itemModel->itemInfo($phase);
        };

        // 获取用户信息
        $this->userInfo = function() {

            return Model_Member::find($this->current_user->id);
        };

    }
}
