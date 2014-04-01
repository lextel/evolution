<?php
class Controller_V2admin_Users extends Controller_V2admin{

    // 管理员列表
    public function action_index() {

        $breads = [
                ['name' => '用户管理'], 
                ['name' => '管理员列表'],
            ];

        $view = View::forge('v2admin/users/index');
        
        $breadcrumb = new Helper\Breadcrumb();
        
        $users = Model_User::find('all', ['where'=>[['group', '<=', $this->groupid], ['is_delete', '=', 0]]]);
        $view->set('users', $users);
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "管理员列表 > 用户管理";
        $this->template->content = $view;
    }

    // 添加管理员
    public function action_create() {

        $breads = [
                ['name' => '用户管理'], 
                ['name' => '管理员列表', 'href' => Uri::create('v2admin/users')],
                ['name' => '添加管理员'],
            ];
        $group = Auth::group()->groups();
        $keys = [];
        foreach($group as $k){
             if ($k > $this->groupid){
                 continue;
             }
             $keys[$k] = Auth::group()->get_name($k);
        }
        $view = View::forge('v2admin/users/create');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $view->set_global('url', Uri::create('v2admin/users/add'));
        $view->set_global('keys', $keys);
        $this->template->title = "添加管理员";
        $this->template->content = $view;
    }

    // 保存管理员
    public function action_add() {

        $val = Model_User::validate('create');

        $val->add('password', '密码')->add_rule('required')->add_rule('min_length', 6)->add_rule('max_length', 20);

        if ($val->run()) {
            $username = trim(Input::post('username'));
            $password = trim(Input::post('password'));
            $email = trim(Input::post('email'));
            $group = trim(Input::post('group', 0));
            
            $mobile = trim(Input::post('mobile', 0));
            if ($this->groupid < intval($group)){
                Session::set_flash('error', e('无权限操作'));
                Response::redirect('v2admin');
            }
            try {
                $user_id = $this->auth->create_user($username, $password, $email, $group);
                $user = Model_User::find($user_id);
                $user->mobile = $mobile;
                $user->save();
                Session::set_flash('success', e('添加成功 #'.$user_id.'.'));
                Model_Log::add('添加管理员 #' . $user_id);
                Response::redirect('v2admin/users');
            } catch (Exception $e) {
                Log::error($e);
                Session::set_flash('error', e('添加失败'));
            }
        } else {
            $val->set_message('required', ':label 为必填项.');
            $val->set_message('min_length', ':label 不能少于:param:1个字符.');
            $val->set_message('is_mobile', ':label 必须为手机号码格式.');
            $val->set_message('valid_email', ':label 必须为邮箱格式.');
            $val->set_message('unique', ':label 重复了.');
            Session::set_flash('error', $val->show_errors());
        }

        return $this->action_create();
    }

    // 编辑管理员
    public function action_edit($id = null) {

        $breads = [
                ['name' => '用户管理'], 
                ['name' => '管理员列表', 'href' => Uri::create('v2admin/users')],
                ['name' => '编辑管理员'],
            ];
        $group = Auth::group()->groups();
        $keys = [];
        foreach($group as $k){
             if ($k > $this->groupid){
                 continue;
             }
             $keys[$k] = Auth::group()->get_name($k);
        }
        $user = Model_User::find($id,  ['where'=>[['group', '<=', $this->groupid], ['is_delete', '=', 0]]]);
        if (is_null($user)){
             Response::redirect('_404_'); 
        }
        $view = View::forge('v2admin/users/edit');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $view->set_global('url', Uri::create('v2admin/users/update/'.$id));
        $view->set_global('user', $user);
        $view->set_global('keys', $keys);
        $this->template->title = "编辑管理员 > 管理员管理";
        $this->template->content = $view;
    }

    // 更新管理员
    public function action_update($id = null) {

        $user = Model_User::find($id,  ['where'=>[['group', '<=', $this->groupid], ['is_delete', '=', 0]]]);
        if (is_null($user)){
             Response::redirect('_404_'); 
        }
        $val = Model_User::validate('edit');
        $val->add('password', '密码')->add_rule('min_length', 6)->add_rule('max_length', 20);
        $email = trim(Input::post('email'));
        $mobile = trim(Input::post('mobile'));
        if ($email != $user->email){
            $val->add_field('email', '邮箱', 'required|valid_email|unique[users.email]');
        }
        if ($mobile != $user->mobile){
            $val->add_field('mobile', '手机', 'required|is_mobile|unique[users.mobile]');
        }
        if ($val->run()) {
            $post = Input::post();
            if(!empty($post['password'])) {
                $post['password'] = $this->auth->hash_password($post['password']);
            } else {
                unset($post['password']);
            }

            unset($post['submit']);
            if ($this->groupid < intval($post['group'])){
                Session::set_flash('error', e('无权限操作'));
                Response::redirect('v2admin');
            }
            $userModel = new Model_User();
            
            if ($userModel->edit($id, $post)) {
                Session::set_flash('success', e('更新成功 #' . $id));
                Response::redirect('v2admin/users');
            } else {
                Session::set_flash('error', e('更新失败 #' . $id));
            }
        } else {
            $val->set_message('required', ':label 为必填项.');
            $val->set_message('min_length', ':label 不能少于:param:1个字符.');
            $val->set_message('is_mobile', ':label 必须为手机号码格式.');
            $val->set_message('valid_email', ':label 必须为邮箱格式.');
            $val->set_message('unique', ':label 重复了.');
            Session::set_flash('error', $val->show_errors());
        }


        return $this->action_edit($id);

    }

    // 删除管理员
    public function action_delete($id = null) {

        if ($user = Model_User::find($id, ['where'=>[['group', '<=', $this->groupid], ['is_delete', '=', 0]]])) {
            if ($this->groupid < intval($user->group)){
                Session::set_flash('error', e('无权限操作'));
                Response::redirect('v2admin');
            }
            $user->is_delete=1;
            $user->last_login = time();
            $user->save();
            //$this->auth->delete_user($user->username);
            Model_Log::add('删除管理员 #' . $id);
            Session::set_flash('success', e('删除成功 #'.$id));
        } else {
            Session::set_flash('error', e('删除失败 #'.$id));
        }

        Response::redirect('v2admin/users');

    }


}
