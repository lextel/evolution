<?php

class View_Items_index extends Viewmodel {

    /**
     * @def 展示区域所有商品列表展示
     */
    const IS_LIST = 2;

    /**
     * @def 正常状态
     */
    const NORMAL  = 1;

    /**
     * @def 不删除
     */
    const NOT_DELETE = 0;

    public function view() {

        // 分类类别
        $this->getCates = function($limit = 6) {

            return Model_Cate::query()->where('parent_id', 0)
                                      ->where('is_delete', self::NOT_DELETE)
                                      ->limit($limit)->get();
        };

        // 品牌列表
        $this->getBrands = function($cates) {

            $brands = [];
            $brandModel = new Model_Cate();
            foreach($cates as $cate) {
                $brand = DB::select('id','name','thumb')->from('cates')
                                                         ->where('parent_id', $cate->id)
                                                         ->where('is_delete', self::NOT_DELETE)
                                                         ->limit(7)
                                                         ->execute();
                $brands[$cate->id] = $brand->as_array(); 
            }

            return $brands;
        };

        // 分类广告图片
        $this->getAds = function() {

            $time = time();
            $where = [
                'zone'      => self::IS_LIST, 
                'status'    => self::NORMAL, 
                'is_delete' => self::NOT_DELETE,
               ];

            return Model_Ad::find('all', ['where' => $where, 'order_by' => ['sort' => 'asc'], 'limit' => 6]);
        };

        // 推荐
        $this->getTopItem = function() {

            $select = ['title', 'image', 'price'];
            $where = [
                'is_delete' => \Helper\Item::NOT_DELETE, 
                'is_recommend' => 2,
                ];
            $orderBy = ['sort' => 'desc'];

            $item = Model_Item::find('first', ['select' => $select, 'where' => $where, 'order_by' => $orderBy]);

            return $item;
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
            $flag = '';
            foreach($sorts as $val) {
                
                $url = $itemModel->handleUrl($options);
                $field = isset($val['alias']) ? $val['alias'] : $val['field'];

                $active = '';
                if($field == $sort[0]) $active = 'border: 1px solid #AF2812;';

                // 如果url带 order
                if($sort[0] == $field && isset($sort[1])) {
                    $order = $sort[1] == 'asc' ? 'desc' : 'asc';
                    $flag = $sort[1] == 'asc' ? '<i></i>' : '<s></s>';
                    $orderBy = $field . '_' . $order;
                } else {
                    // 如果支持 order
                    if(count($val['order']) > 1) {
                        $orderBy = $field.'_'.$val['order'][0];
                        $flag = $val['order'][0] == 'asc' ? '<i></i>' : '<s></s>';
                    } else {
                        $orderBy = $field;
                    }
                }
                $list .= '<a href="'.$url . '/s/'. $orderBy .'#list" style="'.$active.'">'.$val['name'].$flag.'</a>';
            }

            return $list;
        };

        // 今日热门
        $this->getHots = function() {

            $select = ['title', 'image', 'status', 'price'];
            $where = [
                'is_delete' => \Helper\Item::NOT_DELETE, 
                ];

            $phases = Model_Item::find('all', ['select' => $select, 'where' => $where, 'order_by' => ['hots' => 'desc'], 'limit' => 10]);

            return $phases;
        };

        // 面包屑
        $this->getBread = function($cateId, $brandId) {
            $bread = '<li><a href="'.Uri::create('/').'">首页</a></li><li><em>&gt;</em></li><li><a href="'.Uri::create('m').'">所有商品</a></li>';

            $ids = [0];
            if(!empty($cateId)) {
                $ids[] = $cateId;
                if(!empty($brandId)) {
                    $ids[] = $brandId;
                }
            }

            $select = ['name', 'id'];
            $cates = Model_Cate::find('all', ['select' => $select, 'where' => [['id', 'in', $ids]]]);

            $sp = '<li><em>&gt;</em></li>';
            $pre = 'c/';
            foreach($cates as $cate) {
                $bread .= $sp .'<li><a href="'.Uri::create('m/'.$pre.$cate->id).'">' . $cate->name . '</a></li>';
                $pre .= $cate->id . '/b/';
            }

            return $bread;
        };
    }
}
