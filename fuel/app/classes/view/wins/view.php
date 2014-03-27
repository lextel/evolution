<?php

class View_Wins_View extends Viewmodel {

    public function view() {
       //获得商品标题
       $this->getItem = function($itemid) {
           $item = Model_Item::find($itemid);
           return $item;
       };

       // 获取用户信息
       $this->getUser = function($mid) {
           $user = Model_Member::find($mid);
           return $user;
       };

       // 批量获取用户信息
       $this->getMembers = function($ids) {
           return Model_Member::byIds($ids);
       };

       // 获取期数信息
       $this->getPhase = function($phaseId) {
           return Model_Phase::find($phaseId);
       };

       // 批量获取期数信息
       $this->getPhases = function($ids){
           return Model_Phase::byIds($ids);
       };

       // 友好时间
       $this->friendlyDate = function($timestamp) {

           $timer = new \Helper\Timer();

           return $timer->friendlyDate($timestamp);
       };


       // 已开奖期数数量
       $this->openCount = function($itemId) {
           
           return Model_Phase::count(['where' => ['item_id' => $itemId, ['code_count', '!=', 0 ]]]);
       };

       // 获取进行中的期数
       $this->activePhase = function($itemId) {

           $where = ['item_id' => $itemId, 'opentime' => 0, 'status' => 1, 'is_delete' => 0];
           $phase = Model_Phase::find('first', ['where' => $where, 'order_by' => ['phase_id' => 'desc']]);

           return $phase;
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

    public function set_view(){
        $this->_view = View::forge('wins/view');
   }

}
