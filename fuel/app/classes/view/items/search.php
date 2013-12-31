<?php

class View_Items_Search extends Viewmodel {

    public function view() {

        // 分类类别
        $this->getCates = function($limit = 6) {

            return Model_Cate::query()->where('parent_id', 0)
                                      ->where('is_delete', 0)
                                      ->limit($limit)->get();
        };

        // 今日热门
        $this->getHots = function() {

            $where = [
                'opentime'  => \Helper\Item::NOT_OPEN, 
                'is_delete' => \Helper\Item::NOT_DELETE, 
                'status'    => \Helper\Item::IS_CHECK
                ];

            $phases = Model_Phase::find('all', ['where' => $where, 'order_by' => ['hots' => 'desc'], 'limit' => 5]);
            $itemModel = new Model_Item();
            $items = [];
            foreach($phases as $phase) {
                $items[] = $itemModel->itemInfo($phase);
            }

            return $items;
        };
    }
}
