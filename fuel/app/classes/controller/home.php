<?php
/*
*用户TA的页面的操作类
*/
class Controller_Home extends Controller_Frontend {

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
        $this->template->layout = $view;
    }

    /*
    *TA的主页的乐购记录
    */
    public function action_orders(){
        $member = Model_Member::find($member_id);
        $view = View::forge('index/orders');
        $view->set('member', $member);
        $this->template->title = 'TA的个人主页';
        $this->template->layout = $view;
    }

    /*
    *TA的主页的获奖记录
    */
    public function action_wins(){
        $member = Model_Member::find($member_id);
        $view = View::forge('index/wins');
        $view->set('member', $member);
        $this->template->title = 'TA的个人主页';
        $this->template->layout = $view;
    }

    /*
    *TA的主页的晒单记录
    */
    public function action_posts(){
        $member = Model_Member::find($member_id);
        $view = View::forge('index/posts');
        $view->set('member', $member);
        $this->template->title = 'TA的个人主页';
        $this->template->layout = $view;
    }
}
