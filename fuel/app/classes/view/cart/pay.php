<?php

class View_Cart_Pay extends Viewmodel {

    public function view() {

        $this->getInfo = function($phaseId){
            $phase = Model_Phase::find($phaseId);

            $itemModel = new Model_Item();

            return $itemModel->itemInfo($phase);
        };

    }
}
