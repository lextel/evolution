<?php
class Controller_Admin_Users extends Controller_Admin{

    // 管理员列表
    public function action_index() {

        $breads = [
                ['name' => '用户管理'], 
                ['name' => '管理员列表'],
            ];

        $view = View::forge('admin/users/index');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $users = Model_User::find('all');
        $view->set('users', $users);
        $this->template->title = "管理员列表 > 用户管理";
        $this->template->content = $view;
    }

    // 添加管理员
    public function action_create() {

        $breads = [
                ['name' => '用户管理'], 
                ['name' => '管理员列表', 'href' => Uri::create('admin/users')],
                ['name' => '添加管理员'],
            ];

        $view = View::forge('admin/users/create');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $view->set_global('url', Uri::create('admin/users/add'));
        $this->template->title = "添加管理员";
        $this->template->content = $view;
    }

    // 保存管理员
    public function action_add() {

        $val = Model_User::validate('create');
        if ($val->run()) {
            $username = Input::post('username');
            $password = Input::post('password');
            $email = Input::post('email');
            $group = Input::post('group');
            try {
                $user_id = Auth::create_user($username, $password, $email, $group);
                Session::set_flash('success', e('添加成功 #'.$user_id.'.'));

                Response::redirect('admin/users');
            } catch (Exception $e) {
                Log::error($e);
                Session::set_flash('error', e('添加失败'));
            }
        } else {
            Session::set_flash('error', $val->error());
        }

        Response::redirect('admin/users/create');
    }

    // 编辑管理员
    public function action_edit($id = null) {

        $breads = [
                ['name' => '用户管理'], 
                ['name' => '管理员列表', 'href' => Uri::create('admin/users')],
                ['name' => '编辑管理员'],
            ];

        $user = Model_User::find($id);

        $view = View::forge('admin/users/edit');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $view->set_global('url', Uri::create('admin/users/update/'.$id));
        $view->set_global('user', $user);
        $this->template->title = "编辑管理员 > 管理员管理";
        $this->template->content = $view;
    }

    // 更新管理员
    public function action_update($id = null) {

        $user = Model_User::find($id);
        $val = Model_User::validate('edit');

        if ($val->run()) {
            $user->group = Input::post('group');
            if (Auth::update_user(array('group'=>$user->group), $user->username)) {
                Session::set_flash('success', e('更新成功 #' . $id));
                Response::redirect('admin/users');
            } else {
                Session::set_flash('error', e('更新失败 #' . $id));
            }
        } else {
            Session::set_flash('error', $val->error());
        }

        Response::redirect('admin/user/edit/' .$id);

    }

    // 删除管理员
    public function action_delete($id = null) {

        if ($user = Model_User::find($id)) {
            Auth::delete_user($user->username);
            Session::set_flash('success', e('删除成功 #'.$id));
        } else {
            Session::set_flash('error', e('删除失败 #'.$id));
        }

        Response::redirect('admin/users');

    }


}
