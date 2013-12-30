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
        $config = $page->setConfig($url, $total, $paramCount);
        $pagination = Pagination::forge('mypagination', $config);

        $items = $itemModel->index($options);

        $view = ViewModel::forge('items/index');
        $view->set('items', $items);
        $view->set('pagination', $pagination);
        $this->template->title = "所有商品";
        $this->template->layout = $view;
    }

    // 商品详情
    public function action_view($id = null) {

        $itemModel = new Model_Item();
        $item = $itemModel->view($id);

        //$prevWinner = $itemModel->prevWinner($item->id);
        $prevWinner = [];

        $orderModel = new Model_Order();
        $orderCount = $orderModel->countByPhaseId($id);
        $newOrders  = $orderModel->newOrders($id);
        $myOrders   = $orderModel->myOrder($this->current_user->id, $id);
        $postModel  = new Model_Post();
        $postCount  = $postModel->countByItemId($item->id);



        $view = ViewModel::forge('items/view');
        $view->set('item', $item, false);
        $view->set('newOrders', $newOrders);
        $view->set('myOrders', $myOrders);
        $view->set('orderCount', $orderCount);
        $view->set('postCount', $postCount);
        $view->set('prevWinner', $prevWinner);
        $this->template->title = '(第'.$item->phase->phase_id.'期)' . $item->phase->title;
        $this->template->layout = $view;
    }

}
