<?php
class Controller_Admin_Ads extends Controller_Admin{

    public function action_index(){

        $breads = [
                ['name' => '广告管理'], 
                ['name' => '广告列表'],
            ];

        $view = View::forge('admin/ads/index');
        $adModel = new Model_Ad();
        $indexAds = $adModel->indexAds();;
        $itemAds = $adModel->itemAds();

        $view->set('indexAds', $indexAds);
        $view->set('itemAds', $itemAds);
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "广告列表";
        $this->template->content = $view;

    }


    // 添加广告页面
    public function action_create() {

         Session::keep_flash('error');

        $breads = [
                ['name' => '广告列表', 'href'=> Uri::create('admin/ads')], 
                ['name' => '添加广告'],
            ];

        $breadcrumb = new Helper\Breadcrumb();
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $view = View::forge('admin/ads/create');
        $this->template->set_global('url', Uri::create('admin/ads/add'));
        $this->template->title = " 添加广告 > 广告列表";
        $this->template->content = $view;

    }

    // 上传广告图片
    public function action_upload() {

        $adModel = new Model_Ad();
        $files = $adModel->upload();

        return json_encode(['files' => $files]);
    }

    // 保存广告
    public function action_add() {

        $val = Model_Ad::validate('create');
        if($val->run()) {
            $adModel = new Model_Ad();
            $rs = $adModel->add(Input::post());
            if($rs) {
                Session::set_flash('success', e('添加成功.'));
                Response::redirect('admin/ads');
            } else {
              Session::set_flash('error', e('保存失败.'));
            }
        } else {
            $val->set_message('required', ':label 为必填项.');
            $val->set_message('max_length', ':label 不能超过:param:1个字.');
            Session::set_flash('error', $val->show_errors());
        }

        Response::redirect('admin/ads/create');
    }

    // 编辑广告
    public function action_edit($id = null) {

        $breads = [
                ['name' => '广告列表', 'href'=> Uri::create('admin/ads')], 
                ['name' => '编辑广告'],
            ];

        $ad = Model_Ad::find($id);

        $breadcrumb = new Helper\Breadcrumb();
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);

        $this->template->set_global('ad', $ad, false);
        $this->template->set_global('url', Uri::create('admin/ads/update/' . $ad->id));
        $this->template->title = "编辑广告 > 广告列表";
        $this->template->content = View::forge('admin/ads/edit');

    }

    // 更新编辑
    public function action_update($id = null) {

        $ad = Model_Ad::find($id);
        $val  = Model_Ad::validate('edit');

        if($val->run()) {
            $adModel = new Model_Ad();
            $rs = $adModel->edit($id, Input::post());
            if($rs) {
                Session::set_flash('success', e('更新成功 #' . $id));
                Response::redirect('admin/ads');
            } else {
                Session::set_flash('error', e('更新失败 #' . $id));
            }

        } else {
            $val->set_message('required', ':label 为必填项.');
            $val->set_message('max_length', ':label 不能超过:param:1个字.');
            Session::set_flash('error', $val->show_errors());
        }

        Response::redirect('admin/ads/edit/'.$id);
    }

    // 广告删除
    public function action_delete($id = null) {

        $adModel = new Model_Ad();
        if ($adModel->remove($id)) {
            Session::set_flash('success', e('删除成功 #' . $id));
        } else {
            Session::set_flash('error', e('删除失败 #' . $id));
        }

        Response::redirect('admin/ads');
    }

}
