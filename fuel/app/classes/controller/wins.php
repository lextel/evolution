<?php
class Controller_Wins extends Controller_Frontend{

    // 揭晓列表
    public function action_index($pagenum=1) {

        $phaseModel = new Model_Phase();
        $count = $phaseModel->countWins();
        $page = new \Helper\Page();
        $config = $page->setCofigPage('/w/p', $count, 10, 3);

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

        $orderModel = new Model_Order();
        $orderCount = $orderModel->countByPhaseId($id);
        $postModel  = new Model_Post();
        $postCount  = $postModel->countByItemId($win->item_id);
        $itemModel = new Model_Item();
        $phaseCount = $itemModel->phaseCountByid($win->item_id);

        $view = ViewModel::forge('wins/view');

        $view->set('orderCount', $orderCount);
        $view->set('postCount', $postCount);
        $view->set('phaseCount', $phaseCount);
        $view->set('win', $win , false);
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
            $member = Model_Member::find($win->member_id);
                $data['data'] = [
                        'member_id' => $member->id,
                        'avatar'    => Uri::create($member->avatar),
                        'nickname'  => $member->nickname,
                        'image'     => $item->image,
                        'title'     => '(第'.$win->phase_id.'期)'.$win->title,
                        'link'      => Uri::create('w/'.$win->phase_id),
                        'userlink'  => Uri::create('u/'.$member->id),
                        'code'      => $win->code,
                        'price'     => sprintf('%.2f', $item->price),
                        'area'      => '未知',
                        'count'     => $win->code_count,
                        'opentime'  => date('Y-m-d H:i:s', $win->opentime),
                    ];
        }

        return json_encode($data);
    }
}
