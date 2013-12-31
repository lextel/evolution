<?php

class Controller_Member_Posts extends Controller_Center
{
    //public $template = 'memberlayout';


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
        $this->template->layout->content = View::forge('member/myposts', $data);
    }

    public function action_noposts($pagenum=1)
    {
        $postscount = Model_Lottery::count(['where'=>['member_id'=>$this->current_user->id, 'post_id'=>0]]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('u/noposts/p', $postscount, 4, 4);
        $pagination = Pagination::forge('postspage', $config);
        $data['noposts'] = Model_Lottery::find('all', [
                                                  'where'=>['member_id'=>$this->current_user->id,
                                                                     'post_id'=>0],
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,]
                                         );
        $this->template->title = '用户晒单列表';
        $this->template->layout->content = View::forge('member/mynoposts', $data);
    }

    public function action_view()
    {
        $data["subnav"] = array('view'=> 'active' );
        $this->template->title = '用户晒单添加';
        $this->template->content = View::forge('member/posts/view', $data);
    }

    public function action_upload()
    {
        $upload  = new Classes\Upload('post');
        $success = $upload->upload();
        $rs = [];
        if($success) {
            $rs =  $upload->getFiles();
        }
        return json_encode(['files' => $rs]);
    }

    public function action_add()
    {
        !Input::method() == 'POST' and Response::redirect('/u/noposts');
        $val = Model_Post::validate('edit');
        if ($val->run())
        {
            $images = Input::post('images');
            $post = Model_Post::forge([
                'title' => Input::post('title'),
                'phase_id' => Input::post('phase_id'),
                'desc' => Input::post('desc'),
                'images'=>serialize($images),
                'lottery_id' => '',
                'item_id' => '',
                'member_id' => $this->current_user->id,
                'topimage' => 0,
                'type_id' => 0,
                'is_delete'=>0,
                'status'=>0,
                'up'=>0,
                'comment_count'=>0,
                'comment_top'=>'',
            ]);

            if ($post and $post->save())
            {
                Session::set_flash('success', '');
                Response::redirect('/u/posts');
            }
            else{
                $res and Response::redirect('/u/noposts');
            }
        }
        Session::set_flash('error', '');
        Response::redirect('/u/noposts');
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
