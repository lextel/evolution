<?php

class Controller_Member_Orders extends Controller_Center
{

    public function action_my($page=1)
    {
        $where = ['member_id'=>$this->current_user->id];
        $myorders= Model_Order::find('all', ['where' => $where]);
        $word = Input::get('word', null);
        $date1 = Input::get('date1', null);
        $date2 = Input::get('date2', null);
        $url = 'u/orders/p';
        if (!is_null($word))
        {
           $where += [['title', 'like', '%'.$word.'%']];
           $url = Uri::update_query_string(['word' => $word], $url);
        }
        if (!is_null($date1) and !is_null($date2))
        {
           $where += [['created_at', '>=', strtotime($date1)],
                'and'=>['created_at', '<=', strtotime($date2)+3600*24]];
           $url = Uri::update_query_string(['date1' => $date1, 'date2' => $date2], $url);
        }
        $count = Model_Order::count(['where'=>$where]);
        $page = new \Helper\Page();

        $config = $page->setCofigPage($url, $count, 4, 4);
        $pagination = Pagination::forge('uorderpage', $config);

        $orders = Model_Order::find('all', [
                                              'where'=>$where,
                                              'order_by' =>array('id' => 'desc'),
                                              'rows_limit'=>$pagination->per_page,
                                              'rows_offset'=>$pagination->offset,]
                                             );
        $view = ViewModel::forge('orders/my', 'view');
        $view->set('orders', $orders);
        $view->set('myorders', $myorders);
        $this->template->title = '购买记录';
        $this->template->layout->content =$view;
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
