<?php
class Controller_Posts extends Controller_Template{

    public function action_index($page=1)
    {
        $postscount = Model_Post::count();
        $config = array(
            'pagination_url' => '/p/p',
            'total_items'    => $postscount,
            'per_page'       => 4,
            'uri_segment'    => 3,
            'current_page'   => $page,                       
            'wrapper'        => "<div class=\"pagination fr\">\n\t{pagination}\n</div>\n", 
            'previous'       => "<span>\n\t{link}\n</span>\n",
            'previous-marker'=> "上一页<",            
            'next-marker'    => "下一页>",            
        );
        $pagination = Pagination::forge('postspage', $config);
        $data['posts'] = Model_Post::find('all', array('order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,)
                                         );
        $data['postscount'] = $postscount;
        $view = View::forge('posts/index', $data);
        //$user = ViewModel::forge('posts/user');
        $view -> set('page', $pagination);
        $this->template->title = "晒单列表";
        $this->template->content = $view;
    }
    
    public function action_sort($sort='id', $page=1)
    {
        //默认为按最新，up为按人气，comment_count为按评论总量
        $type = array('sortup'=>'up',
                 'sortcomment'=>'comment_count',
                );
        $postscount = Model_Post::count();
        if (!in_array($sort, array_keys($type)))
        {  
            $sortType = 'id';
        }else{
            $sortType = $type[$sort];
        }
        $config = array(
            'pagination_url' => '/p/s/'.$sort.'/p',
            'total_items'    => $postscount,
            'per_page'       => 4,
            'uri_segment'    => 5,
            'current_page'   => $page,                       
            'wrapper'        => "<div class=\"pagination fr\">\n\t{pagination}\n</div>\n", 
            'previous'       => "<span>\n\t{link}\n</span>\n",
            'previous-marker'=> "上一页<",            
            'next-marker'    => "下一页>",            
        );
        $pagination = Pagination::forge('postspage', $config);
        $data['posts'] = Model_Post::find('all', array('order_by' =>array($sortType=>'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,)
                                         );
        $data['postscount'] = $postscount;
        $view = View::forge('posts/index', $data);       
        $view -> set('page', $pagination);
        $this->template->title = "晒单列表";
        $this->template->content = $view;
    }

    public function action_view($id = null)
    {
        is_null($id) and Response::redirect('p');
        if ( ! $data['post'] = Model_Post::find($id))
        {
            Session::set_flash('error', '未发现该晒单'.$id);
            Response::redirect('p');
        }
        $this->template->title = "晒单详情页";
        $this->template->content = View::forge('posts/view', $data);
    }
    
    /*
    *增加喜欢人气值，本地COOKIE记录一个值喜欢过了,
    *param $pid 晒单id
    *respone code = 0
    */
    public function action_up($pid)
    {
        is_null($pid) and Response::redirect('p');
        if (Model_Post::find($pid))
        {
            Session::set_flash('error', '未发现该晒单'.$id);
            Response::redirect('p');
        }
        $this->template->title = "晒单详情页";
        $this->template->content = View::forge('posts/view', $data);
    }
}
