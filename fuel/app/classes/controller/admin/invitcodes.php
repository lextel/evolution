<?php
class Controller_Admin_Invitcodes extends Controller_Admin{

    // 管理员列表
    public function action_index() {

        $breads = [
                ['name' => '用户管理'], 
                ['name' => '邀请码'],
            ];

        $codeModel = new Model_Invitcode();
        $total = $codeModel->countCode();
        $page = new \Helper\Page();
        $url = Uri::create('admin/invitcodes'); 

        $config = $page->setConfig($url, $total, 'page');
        $pagination = Pagination::forge('mypagination', $config);

        $view = View::forge('admin/invitcodes/index');
        $breadcrumb = new Helper\Breadcrumb();

        $offset = $pagination->offset;
        $limit = $pagination->per_page;

        $codes = $codeModel->lists($offset, $limit);
        $view->set('codes', $codes);
        $view->set('pagination', $pagination);
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "用户管理 > 邀请码";
        $this->template->content = $view;
    }

    // 生成邀请码
    public function action_create($num = 0) {

        if(empty($num) || !preg_match('/^\d+$/', $num)) {
            Session::set_flash('error', e('删除失败 #'.$id));

            Response::redirect('admin/invitcodes');
        }


        $ids = [];
        for($i=0; $i<$num; $i++) {
            $code = Str::random('alnum', 8);
            $data = [
                'code' => $code,
                'member_id' => 0,
                'status' => 0,
                'is_delete' => 0,
                ];

            $code = new Model_Invitcode($data);
            $code->save();
            $ids[] = $code->id;
        }

        Model_Log::add('生成邀请码 #ID:' . implode(',', $ids));
        Session::set_flash('success', e('生成成功'));
        Response::redirect('admin/invitcodes');

    }

    // 删除邀请码
    public function action_delete($id = null) {

        $invitcodeModel = new Model_Invitcode();
        if ($invitcodeModel->remove($id)) {
            Session::set_flash('success', e('删除成功 #'.$id));
        } else {
            Session::set_flash('error', e('删除失败 #'.$id));
        }

        Response::redirect('admin/invitcodes');
    }


}
