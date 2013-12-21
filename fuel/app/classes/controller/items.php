<?php

class Controller_Items extends Controller_Frontend {

    // 商品列表
    public function action_index() {

        $itemModel = new Model_Item();
        $itemModel->index();

        $view = ViewModel::forge('items/index');
        $this->template->title = "所有商品";
        $this->template->content = $view;
    }

    // 商品详情
    public function action_view($id = null) {

        $itemModel = new Model_Item();
        $item = $itemModel->view($id);

        $prevWinner = $itemModel->prevWinner($item->id);

        $view = ViewModel::forge('items/view');
        $view->set('item', $item);
        $view->set('prevWinner', $prevWinner);
        $this->template->title = "商品详情";
        $this->template->content = $view;
    }

}
