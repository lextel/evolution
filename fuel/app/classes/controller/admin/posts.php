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
        $post = Model_Post::find($id);
        $view = ViewModel::forge('admin/posts/view', 'view');
        $view->set('post', $post, false);
        $view->set('url', '/admin/posts/edit/'.$id);
        $this->template->title = "晒单管理详情";
        $this->template->content = $view;

    }

    public function action_edit($id = null)
    {
        $post = Model_Post::find($id);
        $val = Validation::forge();
        $val->add_field('status', '', 'required');
        if ($val->run())
        {           
            if (Input::post('status') == 1)
            {
                $post->status = 1;
                if($post->save())           
                {
                    Session::set_flash('success', e('审核通过' . $id));
                    Response::redirect('admin/posts');
                }
            }         
            else
            {
                $post->status = 2;
                $post->reason = Input::post('reason');      
                $post->save();
                Session::set_flash('error', e('审核不通过' . $id));
            }
        }
        Response::redirect('admin/posts/view/'.$id);

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
