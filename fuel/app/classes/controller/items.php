<?php

class Controller_Items extends Controller_Frontend {

    // 商品列表
    public function action_index() {

        $itemModel = new Model_Item();
        $itemModel->index();

        $view = ViewModel::forge('items/index');
        $this->template->title = "商品列表";
        $this->template->content = $view;
    }

    // 商品详情
    public function action_view() {

        $view = ViewModel::forge('items/index');
        $this->template->content = $view;
    }

}
