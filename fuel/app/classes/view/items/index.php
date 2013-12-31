<?php

class View_Items_index extends Viewmodel {

    public function view() {

        // 分类类别
        $this->getCates = function($limit = 6) {

            return Model_Cate::query()->where('parent_id', 0)
                                      ->where('is_delete', 0)
                                      ->limit($limit)->get();
        };

        // 品牌列表
        $this->getBrands = function($cates) {
            $brands = [];
            foreach($cates as $cate) {
                $brands[$cate->id] = Model_Cate::query()->where('parent_id', $cate->id)
                                                        ->where('is_delete', 0)
                                                        ->get();
            }

            return $brands;
        };

        // 即将揭晓
        $this->getTopItem = function() {

            $where = [
                'opentime'  => \Helper\Item::NOT_OPEN, 
                'is_delete' => \Helper\Item::NOT_DELETE, 
                'status'    => \Helper\Item::IS_CHECK
                ];
            $orderBy = ['remain' => 'desc'];

            $phase = Model_Phase::find('first', ['where' => $where, 'order_by' => $orderBy]);
            $itemModel = new Model_Item();

            return $itemModel->itemInfo($phase);
        };


        // 排序处理
        $this->sort = function() {
            $active = Request::active();
            $sort = explode('_', $active->param('sort'));
            $options = [
                    'cateId'  => $active->param('cate_id'),
                    'brandId' => $active->param('brand_id'),
                ];
            
            Config::load('sort');
            $sorts = Config::get('item');

            $list = '';
            $itemModel = new Model_Item();
            foreach($sorts as $val) {
                $url = $itemModel->handleUrl($options);
                $param = isset($val['alias']) ? $val['alias'] : $val['field'];
                if($sort[0] == $param && isset($sort[1])) {
                    $order = $sort[1] == 'desc' ? 'asc' : 'desc';
                    $orderBy = $param . '_' . $order;
                } else {
                    $orderBy = $param . '_desc';
                }
                $list .= '<a href="'.$url . '/s/'. $orderBy .'#list" class="btn btn-default btn-sx">'.$val['name'].'</a>';
            }

            return $list;
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
