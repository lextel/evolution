<?php

class Controller_Member_Posts extends Controller_Center
{
    public $template = 'memberlayout';


    public function action_index()
    {
        $data['list'] = Model_Post::find_by('user_id', $this->current_user->id);
        $this->template->title = '用户晒单列表';
        $this->template->content = View::forge('member/myposts', $data);
    }
    public function action_view()
    {
        $data["subnav"] = array('view'=> 'active' );
        $this->template->title = '用户晒单添加';
        $this->template->content = View::forge('member/posts/view', $data);
    }

    public function action_getadd()
    {
        $data["subnav"] = array('add'=> 'active' );
        $this->template->title = '用户晒单添加';
        $this->template->content = View::forge('member/posts/add', $data);
    }

    public function action_add()
    {
        $data["subnav"] = array('add'=> 'active' );
    }

    public function action_edit()
    {
        $data["subnav"] = array('edit'=> 'active' );
        $this->template->title = '用户晒单编辑';
        $this->template->content = View::forge('member/posts/edit', $data);
    }

    public function action_delete($id=null)
    {
         if ($post = Model_Post::find($id))
        {
            var_dump($post);
            $post->delete();
            Session::set_flash('success', e('删除晒单成功'));
        }
        else
        {
            Session::set_flash('error', e('删除晒单失败'));
        }
        //exit();
        Response::redirect('u/posts');
    }





}
