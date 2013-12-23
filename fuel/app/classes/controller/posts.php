<?php
class Controller_Posts extends Controller_Template{

    public function action_index($page=1)
    {
        $postscount = Model_Post::count();
        $config = array(
            'pagination_url' => 'http://www.llt.com/p',
            'total_items'    => $postscount,
            'per_page'       => 4,
            'uri_segment'    => $page,
            'previous-marker'=> '上一页<',
        );
        $pagination = Pagination::forge('postspage', $config);

        $data['posts'] = Model_Post::find('all');
        $data['postscount'] = $postscount;
        $view = View::forge('posts/index', $data);
        //$user = ViewModel::forge('posts/user');
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
}
