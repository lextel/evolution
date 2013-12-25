<?php

class Controller_Admin_Items extends Controller_Admin {

    // 商品列表
    public function action_index() {

        $itemModel = new Model_Item();
        $items = $itemModel->lists(Input::get());

        $cateModel = new Model_Cate();
        $cates = $cateModel->cates();

        $view = View::forge('admin/items/index');
        $view->set('cates', $cates, false);
        $view->set('items', $items, false);
        $this->template->title = "商品管理";
        $this->template->content = $view;
    }

    // 商品详情
    public function action_view($id = null) {

        $data['item'] = Model_Item::find($id);
        $this->template->title = "Item";
        $this->template->content = View::forge('admin/items/view', $data);
    }

    // 添加商品
    public function action_create() {

        $breads = [
                ['name' => '商品列表', 'href'=> Uri::create('admin/item/index')], 
                ['name' => '添加商品'],
            ];

        $cateModel = new Model_Cate();
        $cates = $cateModel->cates();
        $cates = ['0' => '--请选择分类--'] + $cates;
        $brands = ['0' => '--请选择品牌--'];

        $breadcrumb = new Helper\Breadcrumb();
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->set_global('cates', $cates, false);
        $this->template->set_global('brands', $brands, false);
        $this->template->set_global('url', Uri::create('admin/items/add'));
        $this->template->title = "商品管理";
        $this->template->content = View::forge('admin/items/create');
    }

    // 保存商品
    public function action_add() {

        $val = Model_Item::validate('create');
        if($val->run()) {
            $itemModel = new Model_Item();
            $rs = $itemModel->add(Input::post());
            if($rs) {
                Session::set_flash('success', e('添加成功.'));
                Response::redirect('admin/items');
            } else {
              Session::set_flash('error', e('保存失败.'));
            }
        } else {
            Session::set_flash('error', $val->error());
        }

        Response::redirect('admin/items/create');
    }

    // 编辑商品
    public function action_edit($id = null) {

        $item = Model_Item::find($id);
        $val  = Model_Item::validate('edit');

        if($val->run()) {

            $itemModel = new Model_Item();
            $rs = $itemModel->edit($id, Input::post());
            if($rs) {
                Session::set_flash('success', e('更新成功 #' . $id));
                Response::redirect('admin/items');
            } else {
                Session::set_flash('error', e('更新失败 #' . $id));
            }

        } else {
            if (Input::method() == 'POST') {
                Session::set_flash('error', $val->error());
            }
        }

        $cates = new Classes\Cate();
        $this->template->set_global('cates', $cates->cates(), false);
        $this->template->set_global('item', $item, false);
        $this->template->title = "商品管理";
        $this->template->content = View::forge('admin/items/edit');
    }

    // 商品删除
    public function action_delete($id = null) {

        $itemModel = new Model_Item();
        if ($itemModel->remove($id)) {
            Session::set_flash('success', e('删除成功 #'.$id));
        } else {
            Session::set_flash('error', e('删除失败 #'.$id));
        }

        Response::redirect('admin/items');
    }

    // 上传商品图片
    public function action_upload() {

        $itemModel = new Model_Item();
        $files = $itemModel->upload();

        return json_encode(['files' => $files]);
    }

    // 编辑器上传图片
    public function action_editorUpload() {

        $itemModel = new Model_Item();
        $files = $itemModel->editorUpload();

        $file = array_shift($files);
        $rs = [
            'url'      => $file['link'],
            'original' => $file['name'],
            'state'    => $file['error'] ? 'FAIL' : 'SUCCESS',
            ];

        return json_encode($rs);
    }

    // faker
    public function action_faker() {

    }

    // test
    public function action_test() {

        $phaseModel = new Model_Phase();
        return json_encode($phaseModel->add(1));
    }


}
