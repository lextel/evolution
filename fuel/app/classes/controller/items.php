<?php

class Controller_Items extends Controller_Frontend {

    // 商品列表
    public function action_index() {

        $options = [
            'cateId'  => $this->param('cate_id'),
            'brandId' => $this->param('brand_id'),
            'order'   => $this->param('order'),
            'sort'    => $this->param('sort'),
            'page'    => $this->param('page'),
            ];


        $itemModel = new Model_Item();

        $url         = Uri::create('/admin/cates/cate');
        $total       = $itemModel->countItem($options);

        $page = new \Helper\Page();
        $config = $page->setConfig($url, $total);
        $pagination = Pagination::forge('mypagination', $config);

        $items = $itemModel->index($options);

        $view = ViewModel::forge('items/index');
        $view->set('items', $items);
        $view->set('pagination', $pagination);
        $this->template->title = "所有商品";
        $this->template->content = $view;
    }

    // 商品详情
    public function action_view($id = null) {

        $itemModel = new Model_Item();
        $item = $itemModel->view($id);

        //$prevWinner = $itemModel->prevWinner($item->id);
        $prevWinner = [];

        $view = ViewModel::forge('items/view');
        $view->set('item', $item, false);
        $view->set('prevWinner', $prevWinner);
        $this->template->title = "商品详情";
        $this->template->content = $view;
    }

}
