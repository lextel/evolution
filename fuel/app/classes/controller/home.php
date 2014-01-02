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
        $config = $page->setCofigPage('u/order/p', $count, 4, 4);
        $pagination = Pagination::forge('horders', $config);
        $wins = Model_Order::find('all',
                        ['where'=>['member_id'=>$member_id]],
                        'rows_limit'=>$pagination->per_page,
                        'rows_offset'=>$pagination->offset,]
                        );
        $view = View::forge('index/home_orders');
        $view->set('wins', $wins);
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
        $wins = Model_Lottery::find_by_member_id($member_id);
        $view = View::forge('index/home_wins');
        $view->set('wins', $wins);
        $view->set('member', $member);
        $this->template->title = 'TA的个人主页';
        $this->template->layout->member = $member;
        $this->template->layout->content= $view;
    }

    /*
    *TA的主页的晒单记录
    */
    public function action_posts($member_id){
        $member = Model_Member::find($member_id);
        $wins = Model_Lottery::find_by_member_id($member_id);
        $view = View::forge('index/home_posts');
        $view->set('wins', $wins);
        $view->set('member', $member);
        $this->template->title = 'TA的个人主页';
        $this->template->layout->member = $member;
        $this->template->layout->content= $view;
    }
}
