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

}
