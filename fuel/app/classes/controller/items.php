<?php

class Controller_Items extends Controller_Frontend {

    // 商品列表
    public function action_index() {

        $options = [
            'cateId'  => $this->param('cate_id'),
            'brandId' => $this->param('brand_id'),
            'sort'    => $this->param('sort'),
            'page'    => intval($this->param('page')) ? intval($this->param('page')) : 1,
            ];

        $itemModel = new Model_Item();

        $url        = $itemModel->handleUrl($options) . '/p';
        $total      = $itemModel->countItem($options, true);
        $paramCount = $itemModel->countParam($options);

        $page = new \Helper\Page();
        $config = $page->setListConfig($url, $total, $paramCount);
        $pagination = Pagination::forge('mypagination', $config);

        $items = $itemModel->index($options);

        $title = '所有商品';

        $cateId = $this->param('cate_id');
        if(!empty($cateId)) {
            $cateModel = new Model_Cate();
            $title = $cateModel->cateName($cateId);
        }

        $view = ViewModel::forge('items/index');
        $view->set('items', $items);
        $view->set('cateId', $cateId);
        $view->set('brandId', $this->param('brand_id'));
        $view->set('pagination', $pagination);
        $this->template->title = $title;
        $this->template->layout = $view;
    }

    // 商品详情
    public function action_view($id = null) {


        $itemModel = new Model_Item();
        $item = $itemModel->view($id);

        if(empty($item)) return Response::redirect('m');

        // 如果还没揭晓
        if($item->phase->code_count != 0) {
            return Response::redirect('w/'.$id);
        }

        $prevWinner = $itemModel->prevWinner($item);

        $orderModel = new Model_Order();
        $orderCount = $orderModel->countByPhaseId($id);
        $newOrders  = $orderModel->newOrders($id);

        $myOrders   = $this->auth->check() ? $orderModel->myOrder($this->current_user->id, $id) : [];
        $postModel  = new Model_Post();
        $postCount  = $postModel->countByItemId($item->id);
        $phaseCount = $itemModel->phaseCountByid($item->id);

        $view = ViewModel::forge('items/view');
        $view->set('item', $item, false);
        $view->set('newOrders', $newOrders);
        $view->set('myOrders', $myOrders);
        $view->set('orderCount', $orderCount);
        $view->set('postCount', $postCount);
        $view->set('phaseCount', $phaseCount);
        $view->set('prevWinner', $prevWinner);
        $this->template->title = '(第'.$item->phase->phase_id.'期)' . $item->phase->title;
        $this->template->layout = $view;
    }

    // 商品搜索
    public function action_search() {
        $options = [
            'title'  => $this->param('title', ''),
            'sort'    => $this->param('sort'),
            'page'    => intval($this->param('page')) ? intval($this->param('page')) : 1,
            ];

        $itemModel = new Model_Item();

        $url        = $itemModel->handleSearchUrl($options) . '/p';
        $total      = $itemModel->countItem($options, true);
        $paramCount = $itemModel->countParam($options);

        $page = new \Helper\Page();
        $config = $page->setConfig($url, $total, $paramCount);
        $pagination = Pagination::forge('mypagination', $config);

        $items = $itemModel->index($options);

        $view = ViewModel::forge('items/search');
        $view->set('items', $items);
        $view->set('title', $this->param('title'));
        $view->set('total', $total);
        $view->set('pagination', $pagination);
        $this->template->title = "搜索商品";
        $this->template->layout = $view;
    }

    // 商品详情往期回顾
    public function action_phases() {

        $itemModel = new Model_Item();
        $total = $itemModel->phaseCountByid(Input::get('itemId', 0));

        $page = new \Helper\Page();
        $config = $page->setAjaxConfig('phases', $total);
        Pagination::forge('mypagination', $config);

        $phases = $itemModel->phases(Input::get());

        return json_encode(['phases' => $phases, 'page' => Pagination::instance('mypagination')->render()]);
    }

    // 强制生成新一期
    public function action_addnew($id) {
        $item = Model_Item::find($id);

        $res = 'not ok';
        $phase = Model_Phase::find('first', ['where' => ['item_id' => $id],'order_by' => ['id' => 'desc']]);
        if(!empty($item) and $item->is_delete == 0 and $item->status == 1 and ((empty($phase) || $item->phase > $phase->phase_id) || $item->phase == 0)) {
            $phaseModel = new Model_Phase();
            $phaseModel->add($item);
            $res = 'ok';
        }

        return $res;
    }

    // 修复所有有问题期数数据
    public function action_rebuild() {
        set_time_limit(0);

        $items = Model_Item::find('all');
        foreach($items as $item) {
            $delete = false;
            $phases = Model_Phase::find('all', ['select' => ['codes', 'title', 'id', 'remain'], 'where' => ['item_id' => $item->id]]);
            $ids = [0];
            foreach($phases as $phase) {
                if($phase->remain != count(unserialize($phase->codes))) {
                    echo sprintf('期数ID：%d 标题：%s数据有误<br/>', $phase->id, $phase->title);
                    $delete = true;
                }
                $ids[] = $phase->id;
            }

            if($delete) {

                // 删除订单
                $orders = Model_Order::find('all', ['select' => ['id'],'where' => [['phase_id', 'in', $ids]]]);
                foreach($orders as $order) {
                    $id = $order->id;
                    $o = Model_Order::find($id);
                    $o->delete();
                    echo 'order_id: ' . $id;
                    echo '<br/>';
                }

                // 删除期数
                foreach($phases as $phase) {
                    $id = $phase->id;
                    $p = Model_Phase::find($id);
                    $p->delete();
                    echo 'phase_id: ' . $id;
                    echo '<br/>';
                }


                // 加回一期
                $p = new Model_Phase();
                $p->add($item);

                echo '<hr/>';
            }

            if(empty($phases)) {
                $p = new Model_Phase();
                $p->add($item);
                echo '没有期数,#' . $item->id . '商品新增一期';
                echo '<hr/>';
            }

        }

        return 'ok';
    }

    // 最新商品详情跳转
    public function action_new($id = null) {
        // 判定空
        if (is_null($id)) return Response::redirect('m');
        //判断 是否存在该ID的商品
        $item = Model_Phase::find($id);       
        if(empty($item)) return Response::redirect('m/1');
        
        $item_id = $item->item_id;
        //根据item_id获得最新的一期的商品详情
        $newPhase = Model_Phase::find('last', ['select' => ['id'], 
                        'where' => ['item_id'=>$item_id]]);
        Response::redirect('m/'.$newPhase->id);
    }
}
