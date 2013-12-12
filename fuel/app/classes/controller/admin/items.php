<?php
class Controller_Admin_Items extends Controller_Admin{


    public function action_index() {

        $data['items'] = Model_Item::find('all');

        $cates = new Helper\Cate();
        $data['cates'] = $cates->cates();

        $this->template->title = "商品管理";
        $this->template->content = View::forge('admin/items/index', $data);
    }

    public function action_view($id = null) {

        $data['item'] = Model_Item::find($id);
        $this->template->title = "Item";
        $this->template->content = View::forge('admin/items/view', $data);
    }

    public function action_create() {

        if (Input::method() == 'POST') {
            $itemModel = new Model_Item();
            $rs = $itemModel->add();
            if($rs) {
              Response::redirect('admin/items');
            }
        }

        $cates = new Helper\Cate();
        $this->template->set_global('cates', $cates->cates(), false);
        $this->template->title = "商品管理";
        $this->template->content = View::forge('admin/items/create');
    }

    public function action_edit($id = null) {

        $item = Model_Item::find($id);

        $itemModel = new Model_Item();
        $rs = $itemModel->edit($id);

        if($rs) {
            Response::redirect('admin/items');
        }

        $cates = new Helper\Cate();
        $this->template->set_global('cates', $cates->cates(), false);
        $this->template->set_global('item', $item, false);
        $this->template->title = "商品管理";
        $this->template->content = View::forge('admin/items/edit');
    }

    public function action_delete($id = null) {

        if ($item = Model_Item::find($id)) {
            $item->delete();
            Session::set_flash('success', e('删除成功 #'.$id));
        } else {
            Session::set_flash('error', e('删除失败 #'.$id));
        }

        Response::redirect('admin/items');
    }

    public function action_upload() {

        $itemModel = new Model_Item();
        $files = $itemModel->upload();

        return json_encode(['files' => $files]);
    }


}
