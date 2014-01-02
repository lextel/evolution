<?php
class Controller_Admin_Posts extends Controller_Admin{
    //晒单管理页面访问
    public function action_index()
    {
        $active = Input::param('active');
        $type = [
                //审核列表
                '0'=>['status'=>0, 'is_delete'=>0],
                //审核OK列表
                '1'=>['status'=>1, 'is_delete'=>0],
                //审核不通过列表
                '2'=>['status'=>2, 'is_delete'=>0],
                //已经删除列表
                '3'=>['is_delete'=>1]];
        if (is_null($active)){
            $etype = $type['0'];
        }else{
            $etype = $type[$active];
            is_null($etype) and $etype = $type['0'];
        }
        $count = Model_Post::count(['where'=>$etype]);
        $page = new \Helper\Page();
        $url = Uri::create('/admin/posts');
        $config = $page->setConfig($url, $count, 'page');
        $pagination = Pagination::forge('postspage', $config);
        $posts = Model_Post::find('all', [
                                                  'where' =>$etype,
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,]
                                         );
        $view = ViewModel::forge('admin/posts/index', 'view');
        $view->set('posts', $posts);
        $this->template->title = "晒单管理列表";
        $this->template->content = $view;

    }

    public function action_view($id = null)
    {
        $data['post'] = Model_Post::find($id);

        $this->template->title = "晒单列表";
        $this->template->content = View::forge('admin/posts/view', $data);

    }
    // wille del
    public function action_create()
    {
        if (Input::method() == 'POST')
        {
            $val = Model_Post::validate('create');

            if ($val->run())
            {
                $post = Model_Post::forge(array(
                    'title' => Input::post('title'),
                    'desc' => Input::post('desc'),
                    'status' => Input::post('status'),
                    'item_id' => Input::post('item_id'),
                    'member_id' => Input::post('member_id'),
                    'type_id' => Input::post('type_id'),
                    'phase_id' => Input::post('phase_id'),
                    'topimage' => Input::post('topimage'),
                    'images' => Input::post('images'),
                ));

                if ($post and $post->save())
                {
                    Session::set_flash('success', e('Added post #'.$post->id.'.'));

                    Response::redirect('admin/posts');
                }

                else
                {
                    Session::set_flash('error', e('Could not save post.'));
                }
            }
            else
            {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->title = "Posts";
        $this->template->content = View::forge('admin/posts/create');

    }

    public function action_edit($id = null)
    {
        $post = Model_Post::find($id);
        $val = Model_Post::validate('edit');

        if ($val->run())
        {
            $post->title = Input::post('title');
            $post->desc = Input::post('desc');
            $post->status = Input::post('status');
            $post->item_id = Input::post('item_id');
            $post->user_id = Input::post('member_id');
            $post->type_id = Input::post('type_id');
            $post->phase_id = Input::post('phase_id');
            $post->topimage = Input::post('topimage');
            $post->images = Input::post('images');
            if ($post->save())
            {
                Session::set_flash('success', e('Updated post #' . $id));

                Response::redirect('admin/posts');
            }

            else
            {
                Session::set_flash('error', e('Could not update post #' . $id));
            }
        }

        else
        {
            if (Input::method() == 'POST')
            {
                $post->title = $val->validated('title');
                $post->desc = $val->validated('desc');
                $post->status = $val->validated('status');
                $post->item_id = $val->validated('item_id');
                $post->user_id = $val->validated('member_id');
                $post->type_id = $val->validated('type_id');
                $post->phase_id = $val->validated('phase_id');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('post', $post, false);
        }

        $this->template->title = "Posts";
        $this->template->content = View::forge('admin/posts/edit');

    }

    public function action_delete($id = null)
    {
        if ($post = Model_Post::find($id))
        {
            $post->delete();

            Session::set_flash('success', e('Deleted post #'.$id));
        }

        else
        {
            Session::set_flash('error', e('Could not delete post #'.$id));
        }

        Response::redirect('admin/posts');

    }


}
