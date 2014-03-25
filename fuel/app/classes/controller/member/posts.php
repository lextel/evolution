<?php

class Controller_Member_Posts extends Controller_Center
{
    //public $template = 'memberlayout';

    /*
    *已经晒单的列表
    */
    public function action_index($pagenum=1)
    {
        $postscount = Model_Post::count(['where'=>['member_id'=>$this->current_user->id]]);
        $nopostscount = Model_Phase::count(['where'=>['member_id'=>$this->current_user->id, 'post_id'=>0]]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('u/posts/p', $postscount, 4, 4);
        $pagination = Pagination::forge('postspage', $config);
        $posts = Model_Post::find('all', [
                                                  'where'=>['member_id'=>$this->current_user->id,
                                                                     'is_delete'=>0],
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,]
                                         );
        $view = ViewModel::forge('posts/myposts');
        $view->set('posts', $posts);
        $view->set('postscount', $postscount);
        $view->set('nopostscount', $nopostscount);
        $this->template->title = '用户晒单列表';
        $this->template->layout->content = $view;
    }

    /*
    *未晒单的列表
    */
    public function action_noposts($pagenum=1)
    {
        $postscount = Model_Post::count(['where'=>['member_id'=>$this->current_user->id]]);
        $nopostscount = Model_Phase::count(['where'=>['member_id'=>$this->current_user->id, 'post_id'=>0]]);
        $page = new \Helper\Page();
        $config = $page->setCofigPage('u/noposts/p', $nopostscount, 4, 4);
        $pagination = Pagination::forge('postspage', $config);
        $noposts = Model_Phase::find('all', [
                                                  'where'=>['member_id'=>$this->current_user->id,
                                                                     'post_id'=>0],
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,]
                                         );
        $view = ViewModel::forge('posts/noposts');
        $view->set('noposts', $noposts);
        $view->set('postscount', $postscount);
        $view->set('nopostscount', $nopostscount);
        $this->template->title = '用户未晒单列表';
        $this->template->layout->content = $view;
    }

    /*
    *晒单上传图片
    */
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
    /*
    *晒单添加页面
    */
    public function action_getadd($phaseid)
    {
        is_null($phaseid) and Response::redirect('/u/noposts');
        $phase = Model_Phase::find($phaseid);
        is_null($phase) and Response::redirect('/u/noposts');
        $view = View::forge('member/posts/add');
        $view->set('phase', $phase);
        $this->template->title = '用户添加晒单';
        $this->template->layout->content = $view;
    }

    /*
    *晒单添加
    */
    public function action_add()
    {
        $phase_id = Input::post('phase_id');
        is_null($phase_id) and Response::redirect('/u/noposts');
        if(Input::method() == 'POST'){
            
            $val = Model_Post::validate('edit');
            if ($val->run())
            {
                $images = Input::post('images');
                if (count($images) < 1)
                {
                    Session::set_flash('error', '添加图片');
                    return Response::redirect('/u/posts/getadd/'.$phaseid);
                }
                $topimage = $images[0];                
                $phase = Model_Phase::find($phase_id);
                is_null($phase) and Response::redirect('/u/noposts');                
                $post = Model_Post::forge([
                    'title' => Input::post('title'),
                    'phase_id' =>$phase_id,
                    'desc' => Input::post('desc'),
                    'images'=>serialize($images),
                    'lottery_id' => '',
                    'item_id' => $phase->item_id,
                    'member_id' => $this->current_user->id,
                    'topimage' => $topimage,
                    'type_id' => 0,
                    'is_delete'=>0,
                    'status'=>0,
                    'up'=>0,
                    'comment_count'=>0,
                    'comment_top'=>'',
                ]);
                if ($post->save())
                {
                    $phase->post_id = $post->id;
                    $phase->save();
                    Session::set_flash('success', '添加晒单成功');
                    return Response::redirect('/u/posts');
                }
            }
            
        }
        Session::set_flash('error', '添加晒单失败');
        return Response::redirect('/u/posts/getadd/'.$phaseid);
    }

    //晒单获得单个
    public function action_getedit($id=null)
    {
        is_null($id) and Response::redirect('/u/posts');
        $post = Model_Post::find($id , ['where'=>['member_id'=>$this->current_user->id]]);
        $phase = Model_Phase::find($post->phase_id);
        !$post and Response::redirect('/u/posts');
        $view = View::forge('member/posts/edit');
        $view->set('phase', $phase, false);
        $view->set('post', $post, false);
        $this->template->title = '用户晒单编辑';
        $this->template->layout->content = $view;
    }

    public function action_edit($id=null)
    {
        (!Input::method() == 'POST' or is_null($id) ) and Response::redirect('/u/posts');
        $val = Model_Post::editValidate('edit');
        if ($val->run())
        {
            $post = Model_Post::find($id , ['where'=>['member_id'=>$this->current_user->id]]);
            !$post and Response::redirect('/u/posts');
            $images = Input::post('images');
            if (count($images) < 1)
            {
                Response::redirect('/u/posts');
            }
            $topimage = $images[0];
            $post->title = Input::post('title');
            $post->desc = Input::post('desc');
            $post->status = 0;
            $post->topimage = $topimage;
            $post->images = serialize($images);
            if ($post->save())
            {
                Session::set_flash('success', '添加晒单成功');
                Response::redirect('/u/posts');
            }
            Response::redirect('/u/posts5');
        }
        Session::set_flash('error', '添加晒单失败');
        Response::redirect('/u/posts');
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
