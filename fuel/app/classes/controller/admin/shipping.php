<?php

class Controller_Admin_Shipping extends Controller_Admin
{

    public function action_index()
    {
        $view = View::forge('admin/shipping/index');
        $view->set('shipping', []);
        $this->template->title = '物流管理';
        $this->template->content = $view;
    }

}
