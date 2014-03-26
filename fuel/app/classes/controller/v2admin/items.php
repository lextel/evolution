<?php

class Controller_V2admin_Items extends Controller_V2admin {

    // 商品列表
    public function action_index() {

        $itemModel = new Model_Item();
        $items = $itemModel->lists(Input::get());

        $cateModel = new Model_Cate();
        $cates = $cateModel->cates();

        $view = View::forge('v2admin/items/index');
        $view->set('cates', $cates, false);
        $view->set('items', $items, false);
        $this->template->title = "商品管理";
        $this->template->content = $view;
    }

    // 列表
    public function action_list($type = null) {

        $itemModel = new Model_Item();


        list($name, $get) = $itemModel->handleType($type, Input::get());
        $total = $itemModel->countItem($get, false);

        $page = new \Helper\Page();
        $url = Uri::create('v2admin/items/list/' . $type, 
                ['cateId' => Input::get('cateId'), 'brandId' => Input::get('brandId'), 'title' => Input::get('title')], 
                ['cateId' => ':cateId', 'brandId' => ':brandId', 'title' => ':title']);

        $config = $page->setConfig($url, $total, 'page');
        $pagination = Pagination::forge('mypagination', $config);

        $get += [
            'offset'=> $pagination->offset,
            'limit' => $pagination->per_page,
            ];

        $items = $itemModel->lists($get);

        $cateModel = new Model_Cate();
        $cates = $cateModel->cates();

        $breads = [['name' => '商品管理'], ['name' => $name]];

        $view = ViewModel::forge('v2admin/items/list');
        $view->set('cates', $cates);
        $view->set('items', $items);
        $view->set('type', $type);
        $view->set('pagination', $pagination);
        $breadcrumb = new Helper\Breadcrumb();
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "{$name} > 商品管理";
        $this->template->content = $view;
    }

    // 商品详情
    public function action_view($id = null, $phaseId= null) {

        $breads = [['name' => '商品详情', 'href'=> 'javascript::void(0);']];

        $item = Model_Item::find($id);
        $phase = Model_Phase::find($phaseId);

        $view = View::forge('v2admin/items/view');

        $view->set('item', $item, false);
        $view->set('phase', $phase);
        $breadcrumb = new Helper\Breadcrumb();
        $view->set('url', Uri::create('v2admin/items/check/'. $id));
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "商品详情";
        $this->template->content = $view;
    }

    // 添加商品
    public function action_create() {

        $breads = [
                ['name' => '商品列表', 'href' => Uri::create('v2admin/items/list/active')], 
                ['name' => '添加商品', 'href' => Uri::create('v2admin/items/create')],
            ];

        $cateModel = new Model_Cate();
        $cates = $cateModel->cates();
        $cates = ['' => '--请选择分类--'] + $cates;
        $brands = ['' => '--请选择品牌--'];

        $breadcrumb = new Helper\Breadcrumb();
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->set_global('cates', $cates, false);
        $this->template->set_global('brands', $brands, false);
        $this->template->set_global('url', Uri::create('v2admin/items/add'));
        $this->template->title = "添加商品 > 商品管理";
        $this->template->content = View::forge('v2admin/items/create');
    }

    // 保存商品
    public function action_add() {

        $val = Model_Item::validate('create');

        if($val->run()) {

            if(Input::post('price') > 50000) {
               Session::set_flash('error', e('商品价格过大，如果需要添加限制请联系技术'));
               Response::redirect_back();
            }

            $itemModel = new Model_Item();
            $rs = $itemModel->add(Input::post());
            if($rs) {
                Session::set_flash('success', e('添加成功.'));
                Response::redirect('v2admin/items/list/uncheck');
            } else {
              Session::set_flash('error', e('保存失败.'));
            }
        } else {
            $val->set_message('required', ':label 为必填项.');
            $val->set_message('max_length', ':label 不能超过:param:1个字.');
            $val->set_message('valid_string', ':label 必须为:param:1.');
            Session::set_flash('error', $val->show_errors());
        }

        Response::redirect('v2admin/items/create');
    }


    // 编辑商品
    public function action_edit($id = null, $resell = '') {

        $breads = [
                ['name' => '商品列表', 'href'=> Uri::create('v2admin/items/list/active')], 
                ['name' => '编辑商品'],
            ];

        $item = Model_Item::find($id);

        $breadcrumb = new Helper\Breadcrumb();
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        
        $pCount = Model_Phase::count(['where' => ['item_id' => $item->id]]);

        $cateModel = new Model_Cate();
        $this->template->set_global('cates', $cateModel->cates(), false);
        $this->template->set_global('brands', $cateModel->brands($item->cate_id), false);
        $this->template->set_global('item', $item, false);
        $this->template->set_global('resell', $resell);
        $this->template->set_global('pCount', $pCount);
        $this->template->set_global('url', Uri::create('v2admin/items/update/' . $item->id));
        $this->template->title = "编辑商品 > 商品管理";
        $this->template->content = View::forge('v2admin/items/edit');
    }

    // 商品编辑
    public function action_update($id = null, $resell = '') {


        $item = Model_Item::find($id);
        
        $val  = Model_Item::validate('edit');

        if($val->run()) {

            $itemModel = new Model_Item();

            if($resell == 'resell') {
                $pCount = Input::post('pCount');
                $phase = Input::post('phase');

                if($phase == 0 || $phase > $pCount) {

                    $phaseModel =  new Model_Phase();
                    $phaseModel->add($item);
                    $itemModel->resell($item->id);

                } else {
                    Session::set_flash('error', e('期数必须大于进行过的期数'));
                    Response::redirect_back();
                }
            }


            $rs = $itemModel->edit($id, Input::post());
            if($rs) {
                Session::set_flash('success', e('更新成功 #' . $id));
                if($resell == 'resell') {
                    Response::redirect('admin/items/list/uncheck');
                } else {
                    Response::redirect_back();
                }
            } else {
                Session::set_flash('error', e('更新失败 #' . $id));
            }

        } else {
            $val->set_message('required', ':label 为必填项.');
            $val->set_message('max_length', ':label 不能超过:param:1个字.');
            $val->set_message('valid_string', ':label 必须为数字.');
            Session::set_flash('error', $val->show_errors());
        }

        if($resell == 'resell') {
            Response::redirect('v2admin/items/edit/'.$id.'/resell');
        }else {
            Response::redirect('v2admin/items/edit/'.$id);
        }
    }

    // 商品删除
    public function action_delete($id = null) {

        $itemModel = new Model_Item();
        if ($itemModel->remove($id)) {
            Session::set_flash('success', e('删除成功 #'.$id));
        } else {
            Session::set_flash('error', e('删除失败 #'.$id));
        }

        Response::redirect('v2admin/items/list/active');
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

    // 审核详情
    public function action_check($id = null) {

        $itemModel = new Model_Item();
        if($itemModel->check($id, Input::post())) {
            Session::set_flash('success', e('操作成功 #'.$id));
            Response::redirect('v2admin/items/list/show');
        } else {
            Session::set_flash('error', e('操作失败 #'.$id));
            Response::redirect('v2admin/items/list/check/'.$id);
        }
    }

    // 快速审核通过
    public function action_isPass($id) {
        if($this->current_user->group < 50) {
            Session::set_flash('error', e('你没有权限'));
            Response::redirect('v2admin/items/list/uncheck');
        }

        $itemModel = new Model_Item();
        if($itemModel->pass($id)) {
            Session::set_flash('success', e('审核成功 #'.$id));
        } else {
            Session::set_flash('error', e('审核失败 #'.$id));
        }

        Response::redirect('v2admin/items/list/uncheck');
    }

    // 快速审核通过并上架
    public function action_sell($id) {
        if($this->current_user->group < 50) {
            Session::set_flash('error', e('你没有权限'));
            Response::redirect_back();
        }

        $itemModel = new Model_Item();
        if($itemModel->sell($id)) {
            Session::set_flash('success', e('审核&上架成功 #'.$id));
        } else {
            Session::set_flash('error', e('上架失败 #'.$id));
        }

        Response::redirect_back();
    }

    // 快速审核不通过
    public function action_notPass($id) {
        if($this->current_user->group < 50) {
            Session::set_flash('error', e('你没有权限'));
            Response::redirect('v2admin/items/list/uncheck');
        }

        $itemModel = new Model_Item();
        if($itemModel->notPass($id)) {
            Session::set_flash('success', e('操作成功 #'.$id));
        } else {
            Session::set_flash('error', e('操作失败 #'.$id));
        }

        Response::redirect('v2admin/items/list/uncheck');
    }

    // 完成商品重新上架
    public function action_resell($id) {

        if($this->current_user->group < 50) {
            Session::set_flash('error', e('你没有权限'));
            Response::redirect_back();
        }

        Response::redirect('v2admin/items/edit/'.$id.'/resell');
    }

    // 删除恢复
    public function action_restore($id) {

        if($this->current_user->group < 50) {
            Session::set_flash('error', e('你没有权限'));
            Response::redirect_back();
        }

        $itemModel = new Model_Item();
        if($itemModel->restore($id)) {
            Session::set_flash('success', e('操作成功 #'.$id));
        } else {
            Session::set_flash('error', e('操作失败 #'.$id));
        }


        Response::redirect_back();
    }

    // 商品推荐
    public function action_isRecommend($id = 0) {

        if(empty($id)) return json_encode(['code' => 1, 'msg' => '参数错误']);

        $result = ['code' => 1, 'msg' => '操作失败'];

        $itemModel = new Model_Item();
        if($itemModel->recommend($id)) {
            $result = ['code' => 0];
        }

        return json_encode($result);
    }

    // test
    public function action_test() {

        $phaseModel = new Model_Phase();
        return json_encode($phaseModel->add(1));
    }


}
