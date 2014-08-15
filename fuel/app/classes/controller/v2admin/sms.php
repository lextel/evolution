<?php
class Controller_V2admin_Sms extends Controller_V2admin{

    public function action_index()
    {

        $breads = [
            ['name' => '站内消息'], 
        ];

        $SmsModel = new Model_Member_Sm();
        $total = $SmsModel->countLog(Input::get());

        $page = new \Helper\Page();
        $url = Uri::create('v2admin/logs', 
                ['user_id' => Input::get('user_id'), 'start_at' => Input::get('start_at'), 'end_at' => Input::get('end_at')], 
                ['user_id' => ':user_id', 'start_at' => ':start_at', 'end_at' => ':end_at']);
        $config = $page->setConfig($url, $total, 'page');
        $pagination = Pagination::forge('mypagination', $config);

        $view = ViewModel::forge('v2admin/sms/index');

        $get = Input::get();
        $get['offset'] = $pagination->offset;
        $get['limit'] = $pagination->per_page;

        $logs = $SmsModel->index($get);
        $view->set('logs', $logs);

        $users = Model_User::find('all');
        $view->set('users', $users);

        $breadcrumb = new Helper\Breadcrumb();
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);

        $this->template->title = "站内消息";
        $this->template->content = $view;
    }

}
