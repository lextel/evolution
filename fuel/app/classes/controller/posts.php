<?php
class Controller_Posts extends Controller_Template{

    public function action_index($page=1)
    {
        $data['posts'] = Model_Post::find('all');
        $view = View::forge('posts/index', $data);
        //$user = ViewModel::forge('posts/user');
        //$view -> set('userinfo', $user);
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
