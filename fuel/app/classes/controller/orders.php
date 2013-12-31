<?php

class Controller_Orders extends Controller_Frontend {
    //public $template = 'memberlayout';

    public function action_index()
    {
        $data["subnav"] = array('index'=> 'active' );
        $this->template->title = 'Orders &raquo; Index';
        $this->template->layout = View::forge('orders/index', $data);
    }

    public function action_my($page=1)
    {
        $count = Model_Order::count(['where'=>['member_id'=>$this->current_user->id]]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('u/orders/p', $count, 4, 4);
        $pagination = Pagination::forge('uorderpage', $config);
        $data['orders'] = Model_Order::find('all', [
                                              'where'=>['member_id'=>$this->current_user->id],
                                              'order_by' =>array('id' => 'desc'),
                                              'rows_limit'=>$pagination->per_page,
                                              'rows_offset'=>$pagination->offset,]
                                             );
        $this->template->title = '购买记录';
        $this->template->layout->content = View::forge('member/myorders', $data);
    }

    public function action_search()
    {
        $data["subnav"] = array('search'=> 'active' );
        $this->template->title = 'Orders &raquo; Search';
        $this->template->layout = View::forge('orders/search', $data);
    }

    // 产品详情拉取参与者
    public function action_joined() {

        $orderModel = new Model_Order();
        $total = $orderModel->countByPhaseId(Input::get('phaseId'));

        $page = new \Helper\Page();
        $config = $page->setAjaxConfig('joined', $total);
        Pagination::forge('mypagination', $config);

        $orders = $orderModel->joined(Input::get());

        return json_encode(['orders' => $orders, 'page' => Pagination::instance('mypagination')->render()]);
    }

}
