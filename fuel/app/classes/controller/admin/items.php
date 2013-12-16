<?php
class Controller_Admin_Items extends Controller_Admin{


    // 商品列表
    public function action_index() {

        $data['items'] = Model_Item::find('all');

        $cates = new Classes\Cate();
        $data['cates'] = $cates->cates();

        $this->template->title = "商品管理";
        $this->template->content = View::forge('admin/items/index', $data);
    }

    // 商品详情
    public function action_view($id = null) {

        $data['item'] = Model_Item::find($id);
        $this->template->title = "Item";
        $this->template->content = View::forge('admin/items/view', $data);
    }

    // 添加商品
    public function action_create() {

        if (Input::method() == 'POST') {

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
        }

        $cates = new Classes\Cate();
        $this->template->set_global('cates', $cates->cates(), false);
        $this->template->title = "商品管理";
        $this->template->content = View::forge('admin/items/create');
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

    // 上下架
    public function action_operate() {
        $id      = Input::post('id', 0);
        $operate = Input::post('operate', 'down');

        $itemModel = new Model_Item();
        $rs = $itemModel->operate($id, $operate);

        return json_encode($rs);
    }

    // test
    public function action_test() {

        $phaseModel = new Model_Phase();
        return json_encode($phaseModel->add(1));
    }


}
