<?php

class Controller_Admin_Shipping extends Controller_Admin
{

    public function action_index()
    {
        $this->template->title = '物流管理';
        $this->template->content = View::forge('admin/shipping/index');
    }

}
