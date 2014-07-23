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

    private function checkMember($member_id){
        $member = Model_Member::find('first', ['where' =>[
                                                                    ['is_delete' => '0'],
                                                                    ['id' => $member_id],
                                                                    ]
                                                        ]);
        if (empty($member)) return Response::redirect('/');
        return $member;
    }
    /*
    *TA的主页 购买记录 3条，中奖记录 3条，晒单记录 3条
    */
    public function action_index($member_id) {
        $member = $this->checkMember($member_id);
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
        $wins = Model_Phase::find('all', [
                            'where'=>['member_id'=>$member_id],
                            'order_by'=>['id'=>'desc'],
                            'rows_limit'=>3,
                            ]);
        $view = ViewModel::forge('home/index');
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
    public function action_orders($member_id, $pagenum=1){
        $member = $this->checkMember($member_id);
        $count = Model_Order::count(['where'=>['member_id'=>$member_id]]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('/u/'.$member_id.'/orders/p', $count, 12, 5);
        $pagination = Pagination::forge('horders', $config);
        $orders = Model_Order::find('all',
                        ['where'=>['member_id'=>$member_id],
                        'rows_limit'=>$pagination->per_page,
                        'order_by'=>['id'=>'desc'],
                        'rows_offset'=>$pagination->offset,]
                        );
        $view = ViewModel::forge('home/orders');
        $view->set('orders', $orders);
        $view->set('member', $member);
        $this->template->title = 'TA的乐购记录';
        $this->template->layout->member = $member;
        $this->template->layout->content= $view;
    }

    /*
    *TA的主页的获奖记录
    */
    public function action_wins($member_id, $pagenum = 1){
        $member = $this->checkMember($member_id);
        $count = Model_Phase::count(['where'=>['member_id'=>$member_id]]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('/u/'.$member_id.'/wins/p', $count, 12, 5);
        $pagination = Pagination::forge('hwins', $config);
        $wins = Model_Phase::find('all', [
                                                  'where'=>['member_id'=>$member_id],
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,]
                                         );
        $this->template->title = "TA的获奖记录";
        $view = ViewModel::forge('home/wins');
        $view->set('wins', $wins);
        $view->set('member', $member);
        $this->template->layout->member = $member;
        $this->template->layout->content= $view;
    }

    /*
    *TA的主页的晒单记录
    */
    public function action_posts($member_id, $pagenum=1){
        $member = $this->checkMember($member_id);
        $postscount = Model_Post::count(['where'=>['member_id'=>$member_id]]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('/u/'.$member_id.'/posts/p', $postscount, 6, 5);
        $pagination = Pagination::forge('hposts', $config);
        $posts = Model_Post::find('all', [
                                                  'where'=>['member_id'=>$member_id,
                                                                     'is_delete'=>0],
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,]
                                         );
        $this->template->title = "TA的晒单记录";
        $view = View::forge('index/home_posts');
        $view->set('posts', $posts);
        $view->set('member', $member);
        $this->template->layout->member = $member;
        $this->template->layout->content= $view;
    }
}
