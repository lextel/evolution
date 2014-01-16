<?php

class Controller_Admin_Shipping extends Controller_Admin
{

    public function action_index()
    {
        $breads = [
            ['name' => '物流管理'], 
        ];

        $shipModel = new Model_Shipping();
        $total = $shipModel->countShipping(Input::get());

        $page = new \Helper\Page();
        $url = Uri::create('admin/shipping', 
                ['status' => Input::get('status'), 'start_at' => Input::get('start_at'), 'end_at' => Input::get('end_at')], 
                ['status' => ':status', 'start_at' => ':start_at', 'end_at' => ':end_at']);
        $config = $page->setCofigPage($url, $total, 10, 'page');
        $pagination = Pagination::forge('mypagination', $config);

        $get = Input::get();
        $get['offset'] = $pagination->offset;
        $get['limit'] = $pagination->per_page;

        $ships = $shipModel->index($get);
        $view = ViewModel::forge('admin/shipping/index');

        $view->set('ships', $ships);
        $breadcrumb = new Helper\Breadcrumb();
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = '物流管理';
        $this->template->content = $view;
    }

    public function action_view($id = null) {

        $breads = [
            ['name' => '物流管理', 'href' => Uri::create('admin/shipping')], 
            ['name' => '物流详情'], 
        ];

        $ship = Model_Shipping::find($id);
        $view = View::forge('admin/shipping/view');
        $member = Model_Member::find($ship->member_id);
        $item = Model_Phase::find($ship->phase_id);

        $view->set('ship', $ship);
        $view->set('member', $member);
        $view->set('item', $item);
        $breadcrumb = new Helper\Breadcrumb();
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = '物流详情';
        $this->template->content = $view;
    }

    public function action_ship($id = null) {

        $breads = [
            ['name' => '物流管理', 'href' => Uri::create('admin/shipping')], 
            ['name' => '物流发货'], 
        ];
        $ship = Model_Shipping::find($id);
        $view = View::forge('admin/shipping/ship');
        $member = Model_Member::find($ship->member_id);
        $item = Model_Phase::find($ship->phase_id);
        $address = Model_Member_Address::find('first', ['where' => ['member_id' => $ship->member_id], 'order_by' => ['rate' => 'desc']]);

        $view->set('ship', $ship);
        $view->set('member', $member);
        $view->set('item', $item);
        $view->set('address', $address, false);
        $breadcrumb = new Helper\Breadcrumb();
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = '物流发货';
        $this->template->content = $view;
    }

    public function action_save($id = null) {

        $ship = Model_Shipping::find($id);
        $ship->name = Input::post('name');
        $ship->address = Input::post('address');
        $ship->mobile = Input::post('mobile');
        $ship->postcode = Input::post('postcode');
        $ship->exname = Input::post('exname');
        $ship->excode = Input::post('excode');
        $ship->status = 99;
        $ship->admin_id = $this->current_user->id;
        if($ship->save()) {
            Model_Log::add('发货操作 #' . $id);
            Session::set_flash('success', e('发货成功 #' . $id));
        } else {
            Session::set_flash('error', e('发货失败 #' . $id));
        }

        Response::redirect('admin/shipping');
    }

}
