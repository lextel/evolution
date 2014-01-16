<?php
class Controller_Admin_Notices extends Controller_Admin{

    public function action_index() {

        $breads = [
            ['name' => '公告管理'], 
            ['name' => '公告列表', 'href' => Uri::create('admin/notices')]
        ];

        $noticeModel = new Model_Notice();
        $total = $noticeModel->countNotice(Input::get());
        $page = new \Helper\Page();
        $url = Uri::create('admin/notices', 
                ['user_id' => Input::get('user_id'), 'title' => Input::get('title')], 
                ['user_id' => ':user_id', 'title' => ':title']);

        $config = $page->setConfig($url, $total, 'page');
        $pagination = Pagination::forge('mypagination', $config);

        $get = Input::get();
        $get['offset'] = $pagination->offset;
        $get['limit'] = $pagination->per_page;

        $users = Model_User::find('all');

        $view = ViewModel::forge('admin/notices/index');
        $view->set('notices', $noticeModel->index($get));
        $breadcrumb = new Helper\Breadcrumb();
        $view->set('pagination', $pagination);
        $view->set('users', $users);
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "公告列表";
        $this->template->content = $view;

    }

    public function action_view($id = null) {

        $breads = [
            ['name' => '公告管理'], 
            ['name' => '公告列表', 'href'=> Uri::create('admin/notices')],
            ['name' => '公告详情']
        ];

        $notice = Model_Notice::find($id);

        $view = ViewModel::forge('admin/notices/view');

        $breadcrumb = new Helper\Breadcrumb();
        $view->set('notice', $notice, false);
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "公告详情";
        $this->template->content = $view;

    }

    // 添加公告
    public function action_create() {

        $breads = [
            ['name' => '公告管理', 'href' => 'javascript:void(0);'],
            ['name' => '公告列表', 'href' => Uri::create('admin/notices')],
            ['name' => '发布公告', 'href'=> 'javascript:void(0);']
           ];

        $url = Uri::create('admin/notices/add');
        $view = View::forge('admin/notices/create');
        $view->set_global('url', $url);
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "添加公告";
        $this->template->content = $view;
    }

    // 保存公告
    public function action_add() {

        $val = Model_Notice::validate('create');

        if ($val->run()) {

            $noticeModel = new Model_Notice();
            if($noticeModel->add($this->current_user->id, Input::post())) {
                Session::set_flash('success', e('公告添加成功'));
                Response::redirect('admin/notices');
            } else {
                Session::set_flash('error', e('操作失败'));
            }
        } else {
            $val->set_message('required', ':label 为必填项.');
            $val->set_message('max_length', ':label 不能超过:param:1个字.');
            Session::set_flash('error', $val->show_errors());
        }

        Response::redirect('admin/notices/create');
    }

    public function action_edit($id = null) {

        $breads = [
            ['name' => '公告管理'],
            ['name' => '公告列表', 'href' => Uri::create('admin/notices')],
            ['name' => '编辑公告']
           ];

        $notice = Model_Notice::find($id);

        $view = View::forge('admin/notices/edit');
        $url = Uri::create('admin/notices/update/'.$id);
        $view->set_global('url', $url);
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $view->set_global('notice', $notice, false);
        $this->template->title = "编辑公告";
        $this->template->content = $view;
    }

    // 更新公告
    public function action_update($id = null) {

        $val = Model_Notice::validate('edit');
        if ($val->run()) {
            $noticeModel = new Model_Notice();
            if ($noticeModel->edit($id, Input::post())) {
                Session::set_flash('success', e('编辑成功 #' . $id));
                Response::redirect('admin/notices');
            } else {
                Session::set_flash('error', e('编辑失败 #' . $id));
            }
        } else  {
            $val->set_message('required', ':label 为必填项.');
            $val->set_message('max_length', ':label 不能超过:param:1个字.');
            Session::set_flash('error', $val->error());
        }

        Response::redirect('admin/edit/'.$id);
    }

    // 删除公告
    public function action_delete($id = null) {

        $noticeModel = Model_Notice();
        if ($noticeModel->remove($id)) {
            Session::set_flash('success', e('删除成功 #'.$id));
        } else {
            Session::set_flash('error', e('删除失败 #'.$id));
        }

        Response::redirect('admin/notices');
    }
}
