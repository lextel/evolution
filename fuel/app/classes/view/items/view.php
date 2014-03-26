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
    }
}
