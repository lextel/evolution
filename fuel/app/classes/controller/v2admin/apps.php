<?php
class Controller_V2admin_Apps extends Controller_V2admin{
    //APP列表
    public function action_index()
    {     
        $active = Input::param('active', '0');
        $type = [
                //未发布
                '0'=>['status'=>0, 'is_delete'=>0],
                //已发布
                '1'=>['status'=>1, 'is_delete'=>0],
                //已删除
                '2'=>['is_delete'=>1]];
        $etype = $type[$active];
        is_null($etype) and $etype = $type['0'];
        $count = Model_App::count(['where' => $etype]);
        $page = new \Helper\Page();
        $url = Uri::create('v2admin/apps', ['active'=>$active], ['active' => ':active']);
        $config = $page->setConfig($url, $count, 'page');
        $pagination = Pagination::forge('appspage', $config);
        $apps = Model_App::find('all', [
                          'where' => $etype,
                          'order_by' =>['id' => 'desc'],
                          'rows_limit'=>$pagination->per_page,
                          'rows_offset'=>$pagination->offset,
                          ]);

        $breads = [
                    ['name' => 'APP管理'],
                    ['name' => 'APP列表']];
        $breadcrumb = new Helper\Breadcrumb();
        $view = View::forge('v2admin/apps/index');
        $view->set('apps', $apps);
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "APP列表";
        $this->template->content = $view;
    }
    //添加新APP
    public function action_create()
    {
        //判断GET
        if (Input::method() != "POST"){
            $breads = [['name' => 'APP管理'],
                        ['name' => 'APP列表', 'href'=>'/v2admin/apps'],
                        ['name' => '添加APP']];
            $breadcrumb = new Helper\Breadcrumb();
            $appfile = new Classes\Appfile();
            //读取APK列表
            $files = $appfile->getApks();
            $sizes = $appfile->getFiles($files);
            $view = View::forge('v2admin/apps/create');
            $this->template->set_global('appfile', $files, false);
            $this->template->set_global('sizes', $sizes, false);
            $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
            $this->template->title = "添加APP";
            $this->template->content = $view;
            return;
        }
        
        $app = new Model_App();
        $app = Model_APP::appSave($app);
        //检测保存
        if (! $app->save()) {
            Session::set_flash('error', e('添加失败'));
            Response::redirect('v2admin/apps/create');
        }
        Model_Log::add('添加新APP #ID:' . $app->id);
        Session::set_flash('success', e('添加成功'));
        Response::redirect('v2admin/apps');    
    }
    //修改编辑APP
    public function action_edit($id)
    {
        //检测空
        if (is_null($id)){
            Session::set_flash('error', e('#id不能为空'));
            Response::redirect('v2admin/apps');
        }
        //检测数据是否存在
        $app = Model_App::find('first', ['where'=>['id'=>$id, 'is_delete'=>0]]);
        if (empty($app)){
            Session::set_flash('error', e('#id' . $id . '数据为空'));
            Response::redirect('v2admin/apps');
        }
        //GET模式
        if (Input::method() != "POST"){
            $breads = [['name' => 'APP管理'],
                        ['name' => 'APP列表', 'href'=>'/v2admin/apps'],
                        ['name' => '修改APP']];
            $breadcrumb = new Helper\Breadcrumb();
            //------------------------------
            $appfile = new Classes\Appfile();
            $files = $appfile->getApks($app->link);
            $sizes = $appfile->getFiles($files);
            //--------------------------------
            $sizes = $appfile->getFiles($files);
            $view = View::forge('v2admin/apps/create');
            $this->template->set_global('appfile', $files, false);
            $this->template->set_global('sizes', $sizes, false);
            $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
            $this->template->set_global('app', $app, false);
            $this->template->title = "修改APP";
            $this->template->content = $view;
            return;
        }
        //保存
        $app = Model_APP::appSave($app);
        if (!$app->save()) {
            Session::set_flash('error', e('修改失败 #' . $id));
            Response::redirect('v2admin/apps/edit/'.$id);
        }
        Model_Log::add('修改APP #ID:' . $app->id);
        Session::set_flash('success', e('修改成功 #' . $id));
        Response::redirect('v2admin/apps');
    }
    /*
    *删除APP在列表里
    */
    public function action_delete($id=null)
    {
        //检测空
        if (is_null($id)){
            Session::set_flash('error', e('#id不能为空'));
            Response::redirect('v2admin/apps');
        }
        //检测是否存在
        $app = Model_App::find('first', ['where'=>['id'=>$id, 'is_delete'=>0]]);
        if (empty($app)){
            Session::set_flash('error', e('#id' . $id . '数据为空'));
            Response::redirect('v2admin/apps');
        }
        $app->is_delete = 1;
        
        //检测保存
        if ($app->save()) {
            Session::set_flash('success', e('删除成功 #' . $id));
        } else {
            Session::set_flash('error', e('删除失败 #' . $id));
        }
        Model_Log::add('删除APP #ID:' . $id);
        Response::redirect('v2admin/apps');
    }
    
    /*
    *列表发布APP
    */
    public function action_publish($id=null)
    {
        //检测空
        if (is_null($id)){
            Session::set_flash('error', e('#id不能为空'));
            Response::redirect('v2admin/apps');
        }
        //检测是否存在
        $app = Model_App::find('first', ['where'=>['id'=>$id, 'is_delete'=>0]]);
        if (empty($app)){
            Session::set_flash('error', e('#id' . $id . '数据为空'));
            Response::redirect('v2admin/apps');
        }
        $app->status = 1;        
        //检测保存
        if ($app->save()) {
            Session::set_flash('success', e('发布成功 #' . $id));
        } else {
            Session::set_flash('error', e('发布失败 #' . $id));
        }
        Model_Log::add('发布APP #ID:' . $id);
        Response::redirect('v2admin/apps');
    }
        
    //上传图片
    public function action_uploadimg()
    {
        $upload  = new Classes\Upload('appimg');
        $success = $upload->upload();
        $rs = [];
        if($success) {
            $rs =  $upload->getFiles();
        }
        return json_encode(['files' => $rs]);
    }
    
}
