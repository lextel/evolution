<?php

class View_Cart_List extends Viewmodel {

    public function view() {

        // 单品详情
        $this->getInfo = function($phaseId) {

            $phase = Model_Phase::find($phaseId);
            $itemModel = new Model_Item();

            return $itemModel->itemInfo($phase);
        };

        // 即将揭晓
        $this->getRemains = function() {

            $phases = Model_Phase::find('all', ['order_by' => ['remain' => 'asc'], 'limit' => 4]);
            $itemModel = new Model_Item();
            $items = [];
            foreach($phases as $phase) {
                $items[] = $itemModel->itemInfo($phase);
            }

            return $items;
        };

    }
}
