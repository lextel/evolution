<?php
class Controller_V2admin_Cates extends Controller_V2admin{

    // 分类列表
    public function action_cate() {

        $breads = [
                ['name' => '系统管理'], 
                ['name' => '分类列表'],
            ];

        $cateModel = new Model_Cate();

        $url         = Uri::create('v2admin/cates/cate');
        $total       = $cateModel->countCate();
        $uri_segment = 4;

        $page = new \Helper\Page();
        $config = $page->setConfig($url, $total, $uri_segment);
        $pagination = Pagination::forge('mypagination', $config);

        $view = View::forge('v2admin/cates/listcate');


        $options = [
            'offset'=> $pagination->offset,
            'limit' => $pagination->per_page,
            ];
        $view->set('cates', $cateModel->getCates($options));
        $view->set('pagination', $pagination);
        $breadcrumb = new Helper\Breadcrumb();
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = $breadcrumb->title($breads);
        $this->template->content = $view;
    }

    // 品牌列表
    public function action_brand() {

        $breads = [
                ['name' => '系统管理'], 
                ['name' => '品牌列表'],
            ];

        $cateModel = new Model_Cate();

        $url         = Uri::create('v2admin/cates/brand');
        $total       = $cateModel->countBrand();
        $uri_segment = 4;

        $page = new \Helper\Page();
        $config = $page->setConfig($url, $total, $uri_segment);
        $pagination = Pagination::forge('mypagination', $config);

        $view = ViewModel::forge('v2admin/cates/listbrand');

        $breadcrumb = new Helper\Breadcrumb();
        $view->set('breadcrumb', $breadcrumb->breadcrumb($breads), false);

        $options = [
            'offset'=> $pagination->offset,
            'limit' => $pagination->per_page,
            ];

        $view->set('cates', $cateModel->cates());
        $view->set('brands', $cateModel->getBrands($options));
        $view->set('pagination', $pagination);
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = $breadcrumb->title($breads);
        $this->template->content = $view;
    }

    // 分类联动品牌
    public function action_brands() {

        $parentId = Input::post('id');

        $cateModel = new Model_Cate();
        $brands = $cateModel->brands($parentId);

        return json_encode($brands);
    }


    // 添加分类
    public function action_createCate() {

        $modelCate = new Model_Cate();
        $val = Model_Cate::validate('create');
        if($val->run()) {
            if($modelCate->addCate(Input::post())) {
                Session::set_flash('success', e('添加成功.'));
            } else {
                Session::set_flash('error', e('添加失败.'));
            }
        } else {
            Session::set_flash('error', e('添加失败.'));
        }

        Response::redirect('v2admin/cates/cate');
    }

    // 添加品牌
    public function action_createBrand() {

        $modelCate = new Model_Cate();
        $val = Model_Cate::validate('create');
        if($val->run()) {
            if($modelCate->addBrand(Input::post())) {
                Session::set_flash('success', e('添加成功.'));
            } else {
                Session::set_flash('error', e('添加失败.'));
            }
        } else {
            Session::set_flash('error', e('添加失败.'));
        }

        Response::redirect('v2admin/cates/brand');
    }

    // 编辑分类/品牌
    public function action_edit($id = null) {

        $cate = Model_Cate::find($id);
        $val = Model_Cate::validate('edit');

        $result = ['status' => 'fail'];
        if ($val->run()) {
            $cate->name = Input::post('name');

            if ($cate->save()) {
                Model_Log::add('修改分类/品牌 #' . $id);
                $result = ['status' => 'success'];
            }
        }

        return json_encode($result);
    }

    // 删除分类/品牌
    public function action_delete($id = null) {

        if ($cate = Model_Cate::find($id)) {
            $cate->is_delete = 1;
            $cate->save();

            if($cate->parent_id == 0) {
                DB::update('cates')->value('is_delete', 1)
                                    ->where('parent_id', $cate->id)
                                    ->execute();
            }

            Model_Log::add('删除分类/品牌 #' . $id);
            Session::set_flash('success', e('删除成功 #'.$id));
        } else {
            Session::set_flash('error', e('删除失败 #'.$id));
        }

        if($cate->parent_id == 0) {
            Response::redirect('v2admin/cates/cate');
        } else {
            Response::redirect('v2admin/cates/brand');
        }
    }


}
