<?php

class View_Cart_Result extends Viewmodel {

    public function view() {

        // 单品详情
        $this->getInfo = function($phaseId) {

            $phase = Model_Item::find($phaseId);
            return $phase;
        };

        // 即将揭晓
        $this->getRemains = function() {

            $where = ['status' => \Helper\Item::IS_CHECK, 'is_delete' => \Helper\Item::NOT_DELETE];
            $items = Model_Item::find('all', ['where' => $where, 'order_by' => ['price' => 'asc'], 'limit' => 4]);
            return $items;
        };

    }
}
