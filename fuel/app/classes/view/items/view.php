<?php

class View_Items_view extends Viewmodel {

    public function view() {

        // 放大镜
        $this->getZoom = function($link) {

            $rel = [
                'gallery'    => 'zoom',
                'smallimage' => \Helper\Image::showImage($link, '400x400'),
                'largeimage' => \Helper\Image::showImage($link, '600x600'),
            ];

            return json_encode($rel);
        };

        // 会员信息
        $this->getMember = function($memberId) {

            return Model_Member::find($memberId);
        };

        // 友好时间
        $this->friendlyDate = function($timestamp) {

            $timer = new \Helper\Timer();

            return $timer->friendlyDate($timestamp);
        };


        // 晒单数量
        $this->postsCount = function($itemId) {

            return Model_Post::count(['item_id' => $itemId, 'status' => 1, 'is_delete' => 0]);
        };

        // 评论数量
        $this->commentCount = function($itemId) {

            $query = DB::query('SELECT SUM(comment_count) as count FROM `posts` where `item_id` = "'.$itemId.'" and `status` = 1 and `is_delete` = 0');
            $result = $query->execute();
            $count = $result->get('count');

            return $count ? $count : 0;
        };

        // 今日热门
        $this->getHots = function() {

            $select = ['title', 'image', 'cost', 'remain', 'joined', 'amount'];
            $where = [
                'opentime'  => \Helper\Item::NOT_OPEN,
                'is_delete' => \Helper\Item::NOT_DELETE,
                'status'    => \Helper\Item::IS_CHECK
                ];

            $phases = Model_Phase::find('all', ['select' => $select, 'where' => $where, 'order_by' => ['hots' => 'desc'], 'limit' => 10]);

            return $phases;
        };

        // 所有期数
        $this->phases = function($item) {

            $select = ['phase_id', 'opentime', 'id'];
            $phases = Model_Phase::find('all', ['select' => $select, 'where' => ['item_id' => $item->id], 'order_by' => ['id' => 'desc']]);

            $ids = [];
            $i = 0;
            foreach($phases as $phase) {
                $i++;
                $class = '';
                if($phase->opentime == 0) {
                    $class = 'doing';
                }

                if($phase->id == $item->phase->id) {
                    $class .= ' active';
                }

                $ids[] = ['id' => $phase->id, 'phase' => $phase->phase_id, 'class' => $class, 'sp' => $i%8];
            }

            return $ids;
        };

        // 面包屑
        $this->getBread = function($phase) {
            $ids[] = $phase->cate_id;
            $ids[] = $phase->brand_id;

            $select = ['name', 'id'];
            $cates = Model_Cate::find('all', ['select' => $select, 'where' => [['id', 'in', $ids]]]);
            
            $bread = '<li><a href="'.Uri::create('/').'">首页</a></li><li><em>&gt;</em></li><li><a href="'.Uri::create('m').'">所有商品</a></li>';

            $sp = '<li><em>&gt;</em></li>';
            $pre = 'c/';
            foreach($cates as $cate) {
                $bread .= $sp .'<li><a href="'.Uri::create('m/'.$pre.$cate->id).'">' . $cate->name . '</a></li>';
                $pre .= $cate->id . '/b/';
            }

            $bread .= $sp . $phase->title;

            return $bread;
        };
    }
}
