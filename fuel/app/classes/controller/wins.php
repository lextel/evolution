<?php
class Controller_Wins extends Controller_Frontend{

    // 揭晓列表
    public function action_index($pagenum=1) {

        $phaseModel = new Model_Phase();
        $count = $phaseModel->countWins();
        $page = new \Helper\Page();

        $config = $page->setCofigPage('/w/p', $count, 12, 3);

        $view = ViewModel::forge('wins/index');
        $pagination = Pagination::forge('winspage', $config);

        $offset = $pagination->offset;
        $limit  = $pagination->per_page;

        $wins = $phaseModel->getWins($offset, $limit);

        $view->set('count', $count);
        $view->set('wins', $wins);
        $this->template->title = "最新揭晓";
        $this->template->layout = $view;
    }


    // 揭晓详情
    public function action_view($id = null) {

        is_null($id) and Response::redirect('w');

        $phaseModel = new Model_Phase();
        $win = $phaseModel->win($id);
        if ( empty($win) ) {
            Session::set_flash('error', '没有找到该揭晓详情'.$id);
            Response::redirect('w');
        }

        // 如果还没揭晓
        if($win->code_count == 0) {
            Response::redirect('m/'.$id);
        }

        $orderModel = new Model_Order();
        $orderCount = $orderModel->countByPhaseId($id);
        $orderCodes = $orderModel->userCodesByPhaseId($win->member_id, $id, $win->code);
        $postModel  = new Model_Post();
        $postCount  = $postModel->countByItemId($win->item_id);
        $itemModel = new Model_Item();
        $phaseCount = $itemModel->phaseCountByid($win->item_id);

        $view = ViewModel::forge('wins/view');


        $itemModel = new Model_Item();
        $item = $itemModel->itemInfo($win);

        $view->set('orderCount', $orderCount);
        $view->set('orderCodes', $orderCodes);
        $view->set('postCount', $postCount);
        $view->set('phaseCount', $phaseCount);
        $view->set('win', $win);
        $view->set('item', $item);
        $this->template->title = "晒单详情页";
        $this->template->layout = $view;
    }

    // 获取揭晓结果
    public function action_result() {
        $id = intval(Input::get('id'));
        if(empty($id)) return json_encode(['status' => 'fail']);

        $phaseModel = new Model_Phase();
        $win = $phaseModel->win($id);
        if(empty($win)) return json_encode(['status' => 'fail']);

        $itemModel = new Model_Item();
        $item = $itemModel->itemInfo($win);

        $data['status'] = 'success';
        if($win->code_count) {

           $order = Model_Order::find($win->order_id);
            $member = Model_Member::find($win->member_id);
                $data['data'] = [
                        'member_id' => $member->id,
                        'avatar'    => \Helper\Image::showImage($member->avatar, '60x60'),
                        'nickname'  => $member->nickname,
                        'image'     => \Helper\Image::showImage($item->image, '200x200', 'items'),
                        'title'     => '(第'.$win->phase_id.'期)'.$win->title,
                        'link'      => Uri::create('w/'.$win->id),
                        'userlink'  => Uri::create('u/'.$member->id),
                        'code'      => $win->code,
                        'price'     => sprintf('%.2f', $item->price),
                        'area'      => $order->area,
                        'count'     => $win->code_count,
                        'opentime'  => date('Y-m-d H:i:s', $win->opentime),
                    ];
        }

        return json_encode($data);
    }
}
