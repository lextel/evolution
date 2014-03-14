<?php
class Controller_Admin_Ghost extends Controller_Admin {

    // 在拍列表
    public function action_sell() {

        $breads = [
                ['name' => '马甲管理'], 
                ['name' => '在拍列表'],
            ];

        $itemModel = new Model_Item();
        list(, $get) = $itemModel->handleType('active', Input::get());
        $total = $itemModel->countItem($get, false);


        $view = View::forge('admin/ghost/sell');

        $url = Uri::create('admin/ghost/sell');
        $page = new \Helper\Page();
        $config = $page->setConfig($url, $total, 'page');
        $pagination = Pagination::forge('mypagination', $config);

        $get += [
            'offset'=> $pagination->offset,
            'limit' => $pagination->per_page,
            ];

        $items = $itemModel->lists($get);
        $view->set('items', $items);
        $view->set('pagination', $pagination);
        $breadcrumb = new Helper\Breadcrumb();
        $this->template->set_global('breadcrumb', $breadcrumb->breadcrumb($breads), false);
        $this->template->title = "马甲管理 > 在拍列表";
        $this->template->content = $view;
    }

    // 马甲拍下
    public function action_order($id = 0, $num = 0, $mid = 0) {
        Config::load('common');

        if($id == 0 || $num == 0) {
            return json_encode(['code' => 1, 'msg' => '参数错误']);
        }


        $memberModel = new Model_Member();
        if($mid == 0) {

            $member = $memberModel->randGhost();

            if(empty($member)) {
                return json_encode(['code' => 1, 'msg' => '还没有马甲，添加一个吧']);
            } else {
                $mid = $member[0]['id'];
            }
        }

        $member = Model_Member::find($mid);

        if($member->type == 0) {
            return json_encode(['code' => 1, 'msg' => '这个用户不是马甲']);
        }

        $member->points = $num * Config::get('point');
        $member->save();

        $orderModel = new Model_Order();
        $fetchCodes = $orderModel->buy($id, $num);

        $ip2area = new \Classes\Ip2area(APPPATH . 'qqwry.dat');
        $location = $ip2area->getlocation($member->ip);
        $location['area'] = iconv('GB2312','UTF-8//IGNORE', $location['area']);

        $phase = Model_Phase::find($id);
            $data = [
                'title'      => $phase->title,
                'phase_id'   => $id,
                'member_id'  => $mid,
                'codes'      => serialize($fetchCodes),
                'code_count' => count($fetchCodes),
                'ip'         => $member->ip,
                'area'       => $location['area'],
                'ordered_at' => $timer->millitime(),
                ];

            $orderModel = new Model_Order($data);
            if($orderModel->save()) {

                // 写消费日志
                $perPoint = count('fetchCodes') * Config::get('point');
                Model_Member_Moneylog::buy_log($mid, $perPoint, $id, count('fetchCodes'));

                return json_encode(['code' => 0, 'msg' => '乐拍成功', 'data' => ['remain' => $phase->amount - count('fetchCodes')]]);
            }

            return json_encode(['code' => 1, 'msg' => '乐拍失败']);
    }

}
