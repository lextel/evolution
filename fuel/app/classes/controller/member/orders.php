<?php

class Controller_Member_Orders extends Controller_Center
{

    public function action_my($page=1)
    {
        $where = ['member_id'=>$this->current_user->id];
        $myorders= Model_Order::find('all', ['where' => $where]);
        $word = Input::get('word', null);
        $date1 = Input::get('date1', null);
        $date2 = Input::get('date2', null);
        $url = 'u/orders/p';
        if (!is_null($word))
        {
           $where += [['title', 'like', '%'.$word.'%']];
           $url = Uri::update_query_string(['word' => $word], $url);
        }
        if (!is_null($date1) and !is_null($date2))
        {
           $where += [['created_at', '>=', strtotime($date1)],
                'and'=>['created_at', '<=', strtotime($date2)+3600*24]];
           $url = Uri::update_query_string(['date1' => $date1, 'date2' => $date2], $url);
        }
        $count = Model_Order::count(['where'=>$where]);
        $page = new \Helper\Page();

        $config = $page->setCofigPage($url, $count, 4, 4);
        $pagination = Pagination::forge('uorderpage', $config);

        $orders = Model_Order::find('all', [
                                              'where'=>$where,
                                              'order_by' =>array('id' => 'desc'),
                                              'rows_limit'=>$pagination->per_page,
                                              'rows_offset'=>$pagination->offset,]
                                             );
        $view = ViewModel::forge('orders/my', 'view');
        $view->set('orders', $orders);
        $view->set('myorders', $myorders);
        $this->template->title = '购买记录';
        $this->template->layout->content =$view;
    }

    public function action_search()
    {
        $data["subnav"] = array('search'=> 'active' );
        $this->template->title = 'Orders &raquo; Search';
        $this->template->layout = View::forge('orders/search', $data);
    }

    // 产品详情拉取参与者
    public function action_joined() {

        $orderModel = new Model_Order();

        $total = $orderModel->countByPhaseId(Input::get('phaseId'));

        $page = new \Helper\Page();
        $config = $page->setAjaxConfig('joined', $total);
        Pagination::forge('mypagination', $config);

        $orders = $orderModel->joined(Input::get());

        return json_encode(['orders' => $orders, 'page' => Pagination::instance('mypagination')->render()]);

    }
    
    
    private function getRandGame(){
        //获得目前有剩余码的游戏的
        $games = Model_Gift::find('all', [
                                 'where' => ['status' => 0, 'is_delete' => 0],
                                 'group_by' => ['game_id']]);
        $gamesTmp = [];
        foreach($games as $game){
            $gamesTmp[] = $game->game_id;
        }

        if (!$gamesTmp) return 0;
        $randGame = array_rand($gamesTmp, 1);
        
        return $gamesTmp[$randGame];
    }
    //游戏码换抽奖
    public function action_gamecode($orderId, $code){
        //获得传入的订单和码,检测是否是中奖的码，是中奖的则返回
        if (empty($orderId) || empty($code)) return Response::redirect('/u/orders');
        
        //获得随机的游戏，需要检测游戏是否有空余的码
        $order = Model_Order::find($orderId);
        if (empty($order)) {
            Log::error('#' .$order .'为空');
            return Response::redirect('/u/orders');
        }
        $phase = Model_Phase::find($order->phase_id);
        if ((empty($phase->code)) || ($phase->code == $code)){
            Log::error('#' . $code . '没开或者是中奖号码 #' .$orderId);
            return Response::redirect('/u/orders');
        }
        $codes = unserialize($order->codes);
        if (!in_array($code, $codes)) {
            Log::error('#' . $code . '不存在 #' .$orderId);
            return Response::redirect('/u/orders');
        }
        //检查是否入库了
        $gift = Model_GiftCode::find('first', ['where' => ['order_id' => $orderId, 'code' => $code]]);
        if (!$gift){
            $data = [
                'order_id' => $orderId,
                'code' => $code,
                'status' => 0,
                'is_delete' => 0,
                'game_id' => $this->getRandGame(),
                'member_id' => $this->current_user->id,
                'gift_id' => '',
                'phase_id' => $phase->id,
            ];
            $gift = new Model_GiftCode($data);
            $gift->save();
        }
        Session::delete('giftid');
        Session::set('giftid', e($gift->id));
        $view = ViewModel::forge('member/gamecode', 'view');
        $view->set('phase', $phase);
        $view->set('gift', $gift);
        $this->template->title = '虚拟游戏兑奖页面';
        $this->template->layout->content =$view;
    }
    
    //填写游戏名称
    public function action_addGameId(){    
        $project = Input::post('project', '');
        $gameid = Input::post('gameid');
        $giftid = Session::get('giftid');
        Session::delete('giftid');
        if (empty($gameid) || empty($project)) return json_encode(['code' => 1, 'msg' => '为空gameid#' . $gameid]);
        //
        $giftcode = Model_GiftCode::find($giftid);
        //获得游戏ID，然后发放游戏码
        
        $gift = Model_Gift::find('first', ['where' => ['game_id' => $gameid, 'status' => 0, 'is_delete' => 0]]);
        if (!$giftcode) return json_encode(['code' => 1, 'msg' => '没发现该兑换的数据']);
        if (!$gift) return json_encode(['code' => 1, 'msg' => '没发现该游戏的数据']);
        $giftcode->status = 1;
        $giftcode->gift_id = $gift->id;
        $giftcode->save();
        $gift->status = 1;
        $gift->project = $project;
        $gift->member_id = $this->current_user->id;
        $gift->mark = $giftid;       
        $gift->save();
        return json_encode(['code' => 0, 'msg' => '兑换的码为' . $gift->code]);
    }

}
