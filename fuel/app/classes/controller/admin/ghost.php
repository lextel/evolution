<?php
class Controller_Admin_Ghost extends Controller_Admin{
    /*
    * 特殊用户列表
    */
    public function action_lists() {
        $breads = [
                ['name' => '马甲管理'], 
                ['name' => '马甲列表', 'href'=> Uri::create('admin/ghost')],
            ];

        $get = Input::get();
        $get['type'] = 1;
        $memberModel = new Model_Member();
        $total = $memberModel->countGhost($get);
        $page = new \Helper\Page();
        $url = Uri::create('admin/ghost', 
                ['member_id' => Input::get('member_id'), 'nickname' => Input::get('nickname'), 'email' => Input::get('email')], 
                ['user_id' => ':user_id', 'nickname' => ':nickname', 'email' => ':email']);

        $config = $page->setConfig($url, $total, 'page');
        $pagination = Pagination::forge('mypagination', $config);


        $view = View::forge('admin/ghost/index');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);

        $get['offset'] = $pagination->offset;
        $get['limit'] = $pagination->per_page;
        $view->set('members', $memberModel->index($get));
        $this->template->title = "会员列表 > 用户管理";
        $this->template->content = $view;

    }
    
    /*
    *添加特殊用户
    */
    public function action_create() {
        $breads = [
                ['name' => '马甲管理'], 
                ['name' => '马甲列表', 'href' => Uri::create('admin/ghost')],
                ['name' => '添加马甲'],
            ];

        $view = View::forge('admin/ghost/create');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $view->set_global('url', Uri::create('admin/ghost/add'));
        $this->template->title = "添加马甲";
        $this->template->content = $view;
    }
    
    /*
    *提交添加特殊用户
    */
    public function action_add() {
        $val = Validation::forge('create');
        $val->add_field('username', '用户邮箱', 'required|email|max_length[256]');
        $val->add_field('password', '用户密码', 'required|max_length[255]|min_length[6]');
        $val->add_field('nickname', '用户昵称', 'required|max_length[25]|min_length[3]');
        $val->add_field('avatar', '用户头像', 'required');
        $val->add_field('bio', '用户签名', 'required');
        $val->add_field('created_at', '用户注册日期', 'required');
        $val->add_field('ip', '用户注册IP', 'required');
        if ($val->run()) {
            $username = Input::post('username');
            $password = Input::post('password');
            $email = Input::post('email');
            $nickname = Input::post('nickname');
            $avatar = Input::post('avatar');
            $bio = Input::post('bio');
            $created_at = Input::post('created_at');
            $ip = Input::post('ip');
            try {
                
                Session::set_flash('success', e('添加成功 #'.$user_id.'.'));
                Model_Log::add('添加马甲 #' . $user_id);
                Response::redirect('admin/users');
            } catch (Exception $e) {
                Log::error($e);
                Session::set_flash('error', e('添加失败'));
            }
        } else {
            $val->set_message('required', ':label 为必填项.');
            $val->set_message('email', ':label 必须为邮箱.');
            $val->set_message('min_length', ':label 不能少于:param:1个字符.');
            $val->set_message('max_length', ':label 不能超过:param:1个字符.');
            Session::set_flash('error', $val->show_errors());
        }

        Response::redirect('admin/ghost/create');
    }
    
    /*
    *获得修改特殊用户
    */
    public function action_getedit($id = null) {
        $title = '';
        $url = '';
        return View::forge('admin/ghost/create');
    }
    
    /*
    *提交修改特殊用户
    */
    public function action_edit($id = null) {
        $title = '';
        $url = '';
        Response::redirect('admin/ghost');;
    }
    
    /*
    *特殊用户中奖名单
    */
    public function action_win() {
         $breads = [
                ['name' => '用户管理'], 
                ['name' => '会员列表', 'href'=> Uri::create('admin/members')],
            ];

        $get = Input::get();
        $get['type'] = 1;
        $memberModel = new Model_Member();
        $total = $memberModel->countGhost($get);
        $page = new \Helper\Page();
        $url = Uri::create('admin/ghost', 
                ['member_id' => Input::get('member_id'), 'nickname' => Input::get('nickname'), 'email' => Input::get('email')], 
                ['user_id' => ':user_id', 'nickname' => ':nickname', 'email' => ':email']);

        $config = $page->setConfig($url, $total, 'page');
        $pagination = Pagination::forge('mypagination', $config);


        $view = View::forge('admin/ghost/wins');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);

        $get['offset'] = $pagination->offset;
        $get['limit'] = $pagination->per_page;
        $view->set('members', $memberModel->index($get));
        $this->template->title = "会员列表 > 用户管理";
        $this->template->content = $view;
    }
    
    /*
    *强制登录
    */
    public function action_forcelogin(){
    }
    /*
    *特殊用户假删除
    */
    public function action_del($id=null){
        $memberModel = new Model_Member();
        if ($memberModel->remove($id)) {
            Session::set_flash('success', e('删除成功 #' . $id));
        } else {
            Session::set_flash('error', e('删除失败 #' . $id));
        }

        Response::redirect('admin/ghost');
    }

}
