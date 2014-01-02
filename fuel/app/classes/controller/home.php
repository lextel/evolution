<?php
/*
*用户TA的页面的操作类
*/
class Controller_Home extends Controller_Frontend {

   // public $member;
    public function before() {
        parent::before();
        $this->template->layout = View::forge('index/homelayout');
    }
    /*
    *TA的主页 购买记录 3条，中奖记录 3条，晒单记录 3条
    */
    public function action_index($member_id) {
        $member = Model_Member::find($member_id);
        $orders = Model_Order::find('all', [
                            'where'=>['member_id'=>$member_id],
                            'order_by'=>['id'=>'desc'],
                            'rows_limit'=>3,
                            ]);
        $posts = Model_Post::find('all', [
                            'where'=>['member_id'=>$member_id],
                            'order_by'=>['id'=>'desc'],
                            'rows_limit'=>3,
                            ]);
        $wins = Model_Lottery::find('all', [
                            'where'=>['member_id'=>$member_id],
                            'order_by'=>['id'=>'desc'],
                            'rows_limit'=>3,
                            ]);
        $view = View::forge('index/home');
        $view->set(['member'=>$member,
                'orders'=>$orders,
                'posts'=>$posts,
                'wins'=>$wins,
                ]);
        $this->template->title = 'TA的个人主页';
        $this->template->layout->member = $member;
        $this->template->layout->content = $view;
    }

    /*
    *TA的主页的乐购记录
    */
    public function action_orders($member_id){
        $member = Model_Member::find($member_id);
        $count = Model_Order::count(['where'=>['member_id'=>$member_id]]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('u/order/p', $count, 2, 4);
        $pagination = Pagination::forge('horders', $config);
        $orders = Model_Order::find('all',
                        ['where'=>['member_id'=>$member_id],
                        'rows_limit'=>$pagination->per_page,
                        'rows_offset'=>$pagination->offset,]
                        );
        $view = ViewModel::forge('home/orders');
        $view->set('orders', $orders);
        $view->set('member', $member);
        $this->template->title = 'TA的个人主页';
        $this->template->layout->member = $member;
        $this->template->layout->content= $view;
    }

    /*
    *TA的主页的获奖记录
    */
    public function action_wins($member_id){
       $member = Model_Member::find($member_id);
       $count = Model_Lottery::count(['where'=>['member_id'=>$member_id]]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('/u/'.$member_id.'/win/p', $count, 2, 5);
        $pagination = Pagination::forge('hwins', $config);
        $wins = Model_Lottery::find('all', [
                                                  'where'=>['member_id'=>$member_id],
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,]
                                         );
        $this->template->title = "用户获得商品";
        $view = ViewModel::forge('home/wins');
        $view->set('wins', $wins);
        $view->set('member', $member);
        $this->template->layout->member = $member;
        $this->template->layout->content= $view;
    }

    /*
    *TA的主页的晒单记录
    */
    public function action_posts($member_id, $page=1){
        $member = Model_Member::find($member_id);
        $postscount = Model_Post::count(['where'=>['member_id'=>$member_id]]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('/u/'.$member_id.'/posts/p', $postscount, 2, 5);
        $pagination = Pagination::forge('hposts', $config);
        $posts = Model_Post::find('all', [
                                                  'where'=>['member_id'=>$member_id,
                                                                     'is_delete'=>0],
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,]
                                         );
        $this->template->title = "用户获得商品";
        $view = View::forge('index/home_posts');
        $view->set('posts', $posts);
        $view->set('member', $member);
        $this->template->layout->member = $member;
        $this->template->layout->content= $view;
    }
}
