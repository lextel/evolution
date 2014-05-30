<?php

class View_Cart_List extends Viewmodel {

    public function view() {

        // 购物车列表
        $this->getList = function($items) {
            $ids = [0];
            $carts=[];
            foreach($items as $item) {
                $ids[] = $item->get_id();
                $carts[$item->get_id()]['qty'] = $item->get_qty();
                $carts[$item->get_id()]['rowid'] = $item->get_rowid();
            }

            $select = ['id','title', 'price', 'image', 'is_delete'];
            $phases = Model_Item::find('all', ['select' => $select, 'where' => [['id', 'in', $ids]]]);

            $normalList  = [];
            $overdueList = [];
            foreach($phases as $phase) {
                $phase = $phase->to_array();
                $phase['qty'] = $carts[$phase['id']]['qty'];
                $phase['rowid'] = $carts[$phase['id']]['rowid'];

                $normalList[] = $phase;
            }

            return [$normalList, $overdueList];
        };

        // 单品详情
        $this->getInfo = function($phaseId) {

            $phase = Model_Phase::find($phaseId);
            $itemModel = new Model_Item();

            return $itemModel->itemInfo($phase);
        };

        // 即将揭晓
        $this->getRemains = function() {

            $where = ['status' => \Helper\Item::IS_CHECK, 'opentime' => \Helper\Item::NOT_OPEN, 'is_delete' => \Helper\Item::NOT_DELETE];
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
