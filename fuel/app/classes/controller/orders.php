<?php

class Controller_Orders extends Controller_Center
{
    //public $template = 'memberlayout';

    public function action_index()
    {
        $data["subnav"] = array('index'=> 'active' );
        $this->template->title = 'Orders &raquo; Index';
        $this->template->layout = View::forge('orders/index', $data);
    }

    public function action_my()
    {

        $data['orders'] = Model_Order::myOrders($this->current_user->id);
        $this->template->title = '购买记录';
        $this->template->content = View::forge('orders/my', $data);
    }

    public function action_search()
    {
        $data["subnav"] = array('search'=> 'active' );
        $this->template->title = 'Orders &raquo; Search';
        $this->template->content = View::forge('orders/search', $data);
    }

}
