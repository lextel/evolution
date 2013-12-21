<?php

class View_Items_index extends Viewmodel {

    public function view() {

        $this->getCates = function($limit = 6) {

            return Model_Cate::query()->where('parent_id', 0)
                                      ->where('is_delete', 0)
                                      ->limit($limit)->get();
        };

        $this->getBrands = function($cates) {
            $brands = [];
            foreach($cates as $cate) {
                $brands[$cate->id] = Model_Cate::query()->where('parent_id', $cate->id)
                                                        ->where('is_delete', 0)
                                                        ->get();
            }

            return $brands;
        };

        $this->getTopItem = function() {

            $where = ['opentime' => 0];
            $orderBy = ['remain' => 'desc'];
            $phase = Model_Phase::find('first', ['where' => $where, 'order_by' => $orderBy]);

            $itemModel = new Model_Item();
            return $itemModel->itemInfo($phase);
        };
    }
}
