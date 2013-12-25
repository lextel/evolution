<?php

class Controller_Member_Posts extends Controller_Center
{
    public $template = 'memberlayout';


    public function action_index($pagenum=1)
    {
        $postscount = Model_Post::count(['where'=>['member_id'=>$this->current_user->id]]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('u/posts/p', $postscount, 4, 4);
        $pagination = Pagination::forge('postspage', $config);
        $data['list'] = Model_Post::find('all', [
                                                  'where'=>['member_id'=>$this->current_user->id,
                                                                     'is_delete'=>0],
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,]
                                         );
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
         if ($post = Model_Post::find($id, ['where'=>['is_delete'=>0]]))
        {
            $post->is_delete = 1;
            var_dump($post->save());
            Session::set_flash('info', e('删除晒单成功'));
        }
        else
        {
            Session::set_flash('info', e('删除晒单失败'));
        }
        //exit();
        Response::redirect('u/posts');
    }





}
