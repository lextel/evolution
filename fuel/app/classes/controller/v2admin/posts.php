<?php
class Controller_V2admin_Posts extends Controller_V2admin{
    //晒单管理页面访问
    public function action_index()
    {
        $active = Input::param('active', '0');
        $type = [
                //审核列表
                '0'=>['status'=>0, 'is_delete'=>0],
                //审核OK列表
                '1'=>['status'=>1, 'is_delete'=>0],
                //审核不通过列表
                '2'=>['status'=>2, 'is_delete'=>0],
                //已经删除列表
                '3'=>['is_delete'=>1]];
        /*if (is_null($active)){
            $etype = $type['0'];
        }else{
            $etype = $type[$active];
            is_null($etype) and $etype = $type['0'];
        }*/
        $etype = $type[$active];
        is_null($etype) and $etype = $type['0'];
        $count = Model_Post::count(['where'=>$etype]);
        $page = new \Helper\Page();
        $url = Uri::create('v2admin/posts', ['active'=>$active], ['active' => ':active']);
        $config = $page->setConfig($url, $count, 'page');
        $pagination = Pagination::forge('postspage', $config);
        $posts = Model_Post::find('all', [
                                                  'where' =>$etype,
                                                  'order_by' =>array('id' => 'desc'),
                                                  'rows_limit'=>$pagination->per_page,
                                                  'rows_offset'=>$pagination->offset,]
                                         );

        $breads = [['name' => '晒单管理']];

        $breadcrumb = new Helper\Breadcrumb();
        $view = ViewModel::forge('v2admin/posts/index', 'view');
        $view->set('posts', $posts);
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "晒单管理列表";
        $this->template->content = $view;

    }

    /*
    * 查看晒单的内容详情
    */
    public function action_view($id = null)
    {
        $breads = [['name' => '晒单管理', 'href' => Uri::create('v2admin/posts')], ['name' => '晒单详情']];
        $post = Model_Post::find($id);
        $view = ViewModel::forge('v2admin/posts/view', 'view');
        $view->set('post', $post, false);
        $view->set('url', 'v2admin/posts/edit/'.$id);
        $breadcrumb = new Helper\Breadcrumb();
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "晒单详情";
        $this->template->content = $view;
    }
    
    /*
    * 审核晒单以及爆照
    */
    public function action_edit($id = null)
    {
        $post = Model_Post::find($id);
        if (is_null($post)) return Response::redirect('v2admin/posts');
        $val = Validation::forge();        
        $val->add_field('status', '', 'required');
        if (!$val->run()){
            return Response::redirect('v2admin/posts/view/'.$id);
        }
        //审核不通过            
        if (Input::post('status') != 1){
            $post->status = 2;
            $post->reason = Input::post('reason');      
            $post->save();
            Session::set_flash('success', e('审核不通过' . $id));
            Model_Log::add('审核晒单不通过 #' . $id);
            return Response::redirect('v2admin/posts');
        }

        Config::load('common');
        Config::load('post');
        $point = Config::get('point');
        $addPoint = 0;
        //当已经爆照了就不再修改了
        if ($post->award == 0){
            $post->award = !empty(Input::post('award')) ? 1 : 0;
            if($post->award) {
                $phase = Model_Phase::find($post->phase_id);
                $award = $phase->cost * Config::get('percent') / 100;
                $data = [
                    'phase_id'  => $post->phase_id,
                    'total'     => $award / $point,
                    'sum'       => $award,
                    'type'      => 4,
                    'source'    => '爆照',
                    'member_id' => $post->member_id,
                    ];
                $model = new Model_Member_Moneylog($data);
                $model->save();               
                $addPoint += $award;
                // 保存爆照奖励
                $post->award_point = $award;
            }
        }
        //已经有晒单了的也不给晒单奖励
        if ($post->post_point == 0){
            // 晒单奖励日志           
            $data = [
                'phase_id'  => $post->phase_id,
                'total'     => Config::get('always') / $point,
                'sum'       => Config::get('always'),
                'type'      => 3,
                'source'    => '晒单',
                'member_id' => $post->member_id,
                ];           
            $model = new Model_Member_Moneylog($data);
            $model->save();
            $post->post_point = Config::get('always');
            $addPoint += Config::get('always');
        }        
        // 总奖励金额
        if ($addPoint > 0){ 
            $member = Model_Member::find($post->member_id);
            $member->points = $member->points + $addPoint;
            $member->save();
        }
        // 保存
        $post->status = 1;   
        $post->save();
        Session::set_flash('success', e('审核通过' . $id));
        Model_Log::add('审核晒单通过 #' . $id);
        Response::redirect('v2admin/posts');
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

        Response::redirect('v2admin/posts');

    }


}
