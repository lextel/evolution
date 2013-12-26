<?php

class View_Cart_Result extends Viewmodel {

    public function view() {

        // 单品详情
        $this->getInfo = function($phaseId) {

            $phase = Model_Phase::find($phaseId);
            $itemModel = new Model_Item();

            return $itemModel->itemInfo($phase);
        };

        // 即将揭晓
        $this->getRemains = function() {

            $where = ['status' => \Helper\Item::IS_CHECK, 'opentime' => \Helper\Item::NOT_OPEN];
            $phases = Model_Phase::find('all', ['where' => $where, 'order_by' => ['remain' => 'asc'], 'limit' => 4]);
            $itemModel = new Model_Item();
            $items = [];
            foreach($phases as $phase) {
                $items[] = $itemModel->itemInfo($phase);
            }

            return $items;
        };

    }
}
