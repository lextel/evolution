<?php
class Controller_Posts extends Controller_Template{

    public function action_index($pagenum=1)
    {
        $postscount = Model_Post::count();
        $page = new \Helper\Page();
        $config = $page->setCofigPage('/p/p', $postscount, 4, 3);
        $pagination = Pagination::forge('postspage', $config);
        $data['posts'] = Model_Post::find('all', array(
                                                  'where' => array('is_delete'=>0),
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,)
                                         );
        $data['postscount'] = $postscount;
        $view = View::forge('posts/index', $data);
        $this->template->title = "晒单列表";
        $this->template->content = $view;
    }

    public function action_sort($sort='id', $pagenum=1)
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
        $page = new \Helper\Page();
        $config = $page->setCofigPage('/p/s/'.$sort.'/p', $postscount, 4, 5);
        $pagination = Pagination::forge('postspage', $config);
        $data['posts'] = Model_Post::find('all', array(
                                                  'where' => array('is_delete'=>0),
                                                  'order_by' =>array($sortType=>'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,)
                                         );
        $data['postscount'] = $postscount;
        $view = View::forge('posts/index', $data);
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
        $response = new Response();
        $data = ['code'=>'', 'msg'=>''];
        is_null($pid) and $response->body(json_encode($data));
        $post = Model_Post::find($pid);
        if ($post)
        {
            $post->up = $post->up + 1;
            $post->save();
            $data['code'] = 0;
            $data['msg'] = 'suss';
            return $response->body(json_encode($data));
        }
        $data['code'] = -1;
        $data['msg'] = 'postid is valid';
        return $response->body(json_encode($data));
    }
}
