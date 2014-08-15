<?php
class Controller_V2admin_Members extends Controller_V2admin{

    public function action_index() {

        $breads = [
                ['name' => '用户管理'], 
                ['name' => '会员列表', 'href'=> Uri::create('v2admin/members')],
            ];

        $get = Input::get();
        $get['is_disable'] = 0;

        $memberModel = new Model_Member();
        $total = $memberModel->countMember($get);
        $page = new \Helper\Page();
        $url = Uri::create('v2admin/members', 
                ['member_id' => Input::get('member_id'), 'nickname' => Input::get('nickname'), 'email' => Input::get('email')], 
                ['user_id' => ':user_id', 'nickname' => ':nickname', 'email' => ':email']);

        $config = $page->setConfig($url, $total, 'page');
        $pagination = Pagination::forge('mypagination', $config);


        $view = View::forge('v2admin/members/index');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);

        $get['offset'] = $pagination->offset;
        $get['limit'] = $pagination->per_page;
        $view->set('members', $memberModel->index($get));
        $this->template->title = "会员列表 > 用户管理";
        $this->template->content = $view;

    }
    //冻结
    public function action_black() {

        $breads = [
                ['name' => '用户管理'], 
                ['name' => '冻结会员', 'href'=> Uri::create('v2admin/members/black')],
            ];

        $get = Input::get();
        $get['is_disable'] = 1;

        $memberModel = new Model_Member();
        $total = $memberModel->countMember($get);
        $page = new \Helper\Page();
        $url = Uri::create('v2admin/members/black', 
                ['member_id' => Input::get('member_id'), 'nickname' => Input::get('nickname'), 'email' => Input::get('email')], 
                ['user_id' => ':user_id', 'nickname' => ':nickname', 'email' => ':email']);

        $config = $page->setConfig($url, $total, 'page');
        $pagination = Pagination::forge('mypagination', $config);


        $view = View::forge('v2admin/members/black');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);

        $get['offset'] = $pagination->offset;
        $get['limit'] = $pagination->per_page;
        $view->set('members', $memberModel->index($get));
        $this->template->title = "冻结会员 > 用户管理";
        $this->template->content = $view;
    }

    public function action_view($id = null)
    {
        $breads = [
                ['name' => '用户管理'], 
                ['name' => '会员列表' , 'href' => Uri::create('v2admin/members')],
                ['name' => '查看用户'], 
            ];

        $member = Model_Member::find($id);

        $view = View::forge('v2admin/members/view');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set('member', $member);
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "Member";
        $this->template->content = $view;

    }

    // 冻结
    public function action_disable($id = null) {

        $memberModel = new Model_Member();
        if ($memberModel->disable($id)) {
            Session::set_flash('success', e('冻结会员成功 #' . $id));
        } else {
            Session::set_flash('error', e('冻结会员失败 #' . $id));
        }

        Response::redirect('v2admin/members');
    }

    // 解冻
    public function action_enable($id = null) {

        $memberModel = new Model_Member();
        if ($memberModel->enable($id)) {
            Session::set_flash('success', e('解冻会员成功 #' . $id));
        } else {
            Session::set_flash('error', e('解冻会员失败 #' . $id));
        }

        Response::redirect('v2admin/members');
    }
    // 后台发送会员站内信息VIEW页面
    public function action_smsget($id = null){
        $breads = [
                ['name' => '用户管理'], 
                ['name' => '物流管理' , 'href' => Uri::create('v2admin/shipping')],
                ['name' => '虚拟商品发送'], 
            ];

        $member = Model_Member::find('first', ['where' => 
                                     ['is_delete' => '0', 'is_disable' => '0',
                                      'id' => $id]]);

        $view = View::forge('v2admin/members/sms');
        $breadcrumb = new Helper\Breadcrumb();
        $view->set('member', $member);
        $view->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "Member";
        $this->template->content = $view;
    }
    
    // 系统给会员发送信息
    public function action_sms($id = null){
        //检测会员是否存在
        $member = Model_Member::find('first', ['where' => 
                                     ['is_delete' => '0', 'is_disable' => '0',
                                      'id' => $id]]);
        Session::set_flash('error', e('未发现用户 #' . $id));
        if (!$member) return Response::redirect('v2admin/shipping');
        $title = Input::post('sms');
        if (empty(trim($title))) return Response::redirect('v2admin/members/smsget/' . $id);
        $data = [
            'owner_id'  => $id,
            'title'     => $title,
            'type'      => 'note',
            'user_id'   => 0,
            'user_name' => '系统',
            ];
        $sms = new Model_Member_Sm($data);
        $sms->save();
        Session::set_flash('success', e('发送信息成功 #' . $id));
        return Response::redirect('v2admin/sms');
    }
    
    // 会员删除
    public function action_delete($id = null) {

        $memberModel = new Model_Member();
        if ($memberModel->remove($id)) {
            Session::set_flash('success', e('删除成功 #' . $id));
        } else {
            Session::set_flash('error', e('删除失败 #' . $id));
        }

        Response::redirect('v2admin/members');
    }
}
