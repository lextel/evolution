<?php

class Model_Order extends \Classes\Model
{
    protected static $_properties = array(
        'id',
        'phase_id',
        'member_id',
        'title',
        'codes',
        'code_count',
        'ip',
        'area',
        'ordered_at',
        'created_at',
        'updated_at',
    );

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => false,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_update'),
            'mysql_timestamp' => false,
        ),
    );
    protected static $_table_name = 'orders';

    /**
     * 我的购买记录
     *
     */
    public static function myOrders($uid) {
        return Model_Order::find('all', ['where' => ['member_id' =>$uid ], 'order_by' => ['created_at' => 'desc']]);
    }

    /**
     * 购物车添加订单
     *
     * @param $memberId integer 用户ID
     * @param $carts    array   购物车商品
     *
     * @return array 返回订单ID
     */
    public function add($memberId, $carts) {

        $timer = new \Helper\Timer();

        $quantity   = 0;
        $orderIds = [0];

        Config::load('common');
        //$memberHelper = new \Helper\Member();
        //$ip = $memberHelper->getIp();
        $member = Model_Member::find($memberId);
        $ip = $member->ip;

        $ip2area = new \Classes\Ip2area(APPPATH . 'qqwry.dat');
        $location = $ip2area->getlocation($ip);
        $location['area'] = iconv('GB2312','UTF-8//IGNORE', $location['area']);

        foreach($carts as $cart) {

            $items = Cart::items();
            foreach($items as $item) {
                if($cart->get_id() == $item->get_id()) {
                    $item->delete();
                }
            }

            $phaseId = $cart->get_id();
            $fetchCodes = $this->buy($phaseId, $cart->get_qty());

            if(!empty($fetchCodes)) {
                $phase = Model_Phase::find($phaseId);
                $data = [
                    'title'      => $phase->title,
                    'phase_id'   => $phaseId,
                    'member_id'  => $memberId,
                    'codes'      => serialize($fetchCodes),
                    'code_count' => count($fetchCodes),
                    'ip'         => $ip,
                    'area'       => $location['area'],
                    'ordered_at' => $timer->millitime(),
                    ];

                $orderModel = new Model_Order($data);
                if($orderModel->save()) {
                    $cart->delete();

                    $quantity += count($fetchCodes);
                    $orderIds[] = $orderModel->id;
                }

                // 写消费日志
                $perPoint = count($fetchCodes) * Config::get('point');
                Model_Member_Moneylog::buy_log($memberId, $perPoint, $phaseId, count($fetchCodes));
            }
        }

        // 更新用户积分
        $point = $quantity * Config::get('point');
        $member->points = $member->points - $point;
        $member->save();

        // 写邀请佣金
        $invit = Model_Member_Invit::find('first', ['where' => ['invit_id' => $memberId]]);
        if(!empty($invit)) { // 如果是邀请的

            // 更新邀请者财富
            $invitPoints = $point * Config::get('invitPercent') / 100;
            $inviter = Model_Member::find($invit->member_id);
            $inviter->points = $inviter->points + $invitPoints;
            $inviter->save();

            // 写佣金日志
            $brokerage = [
                'type_id' => 2,
                'member_id' => $invit->member_id,
                'target_id' => $memberId,
                'points' => $invitPoints,
                ];
            $brokerageModel = new Model_Member_Brokerage($brokerage);
            $brokerageModel->save();

        }

        return $orderIds;
    }

    /**
     * 处理商品购买
     *
     * @param $phaseId integer 期数ID
     * @param $qty     integer 购买数量
     *
     * @return array 购买的号码
     */
    public function buy($phaseId, $qty) {

        $phase = Model_Phase::find($phaseId);
        $codes = unserialize($phase->codes);
        $total = count($codes);
        $fetchCodes = array_slice($codes, 0, $qty);
        $count = count($fetchCodes);

        // 如果超过了可购买数量不扣多余消耗的积分
        if($total <= $qty) {
            $count = $total;
        }

        $remainCodes = array_slice($codes, $count, $total);
        unset($codes);
        $phase->codes = serialize($remainCodes);
        $phase->remain = $phase->remain - $count;
        $phase->joined = $phase->joined + $count;

        // 卖完
        if($total == $count) {

            // 期数开奖时间更新
            Config::load('common');
            // 如果是4:00 - 4:10之间延长一倍
            if(date('H') == 4 && date('i') < 10) {
                $time = time() + Config::get('open') * 2 * 60;
            } else {
                $time = time() + Config::get('open') * 60;
            }
            $phase->opentime = $time;

            $item = Model_Item::find($phase->item_id);
            // 生成新一期
            if($item->status == \Helper\Item::IS_CHECK 
               && $item->is_delete == \Helper\Item::NOT_DELETE 
               && ($item->phase == 0 || $item->phase >= $phase->phase_id + 1)
              ) {
                $phaseModel = new Model_Phase();
                $phaseModel->add($item);
            } else {
                // 标识已经完成
                $item->finish($item);
            }

            // 写开奖命令
            $filename = date('Y_m_d_H_i_s_', $time) . $phaseId . '.cron';
            $sec = date('s', $time);
            $dir = APPPATH . 'tmp' . DS . 'crontabs' . DS;

            if(!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }

            $root = realpath(DOCROOT . '../');
            file_put_contents($dir.$filename, 'sleep '.$sec.' && cd '. $root . ' && php oil refine result ' . $phaseId . "\n");
        }

        $phase->save();

        return $fetchCodes;
    }

    /**
     * 获取购买的订单信息
     *
     * @param $memberId  integer 会员ID
     * @param $orderIds  array   订单数组
     *
     * @return array 订单数据
     */
    public function orders($memberId, $orderIds) {

        $where = ['member_id' => $memberId, ['id', 'IN', $orderIds]];

        return Model_Order::find('all', ['where' => $where]);
    }

    /**
     * 获得某一期的参与者数目
     *
     * @param $phaseId integer 期数ID
     *
     * @return integer
     */
    public function countByPhaseId($phaseId) {

        return Model_Order::count(['where' => ['phase_id' => $phaseId]]);
    }

    /**
     * 获取某用户某期购买的号码
     *
     * @param $memberId integer 会员ID
     * @param $phaseId  integer 期数ID
     * @param $code     integer 中奖号码
     *
     * @return array
     */
    public function userCodesByPhaseId($memberId, $phaseId, $code) {
        $like = '%'.$code.'%';
        $order = Model_Order::find('first',['select' => ['codes'], 'where' => ['phase_id' => $phaseId, 'member_id' => $memberId, ['codes', 'LIKE', $like]]]);

        return \Helper\Codes::getArray($order->codes);
    }


    /**
     * 最新乐淘记录
     *
     * @param $phaseId integer 期数ID
     * @param $len     integer 调用条数
     *
     * @return array
     */
    public function newOrders($phaseId = 0, $len = 4) {

        $where = [];
        if(!empty($phaseId)) {
            $where = ['phase_id' => $phaseId];
        }
        $orderBy = ['id' => 'desc'];

        return Model_Order::find('all', ['where' => $where, 'limit' => $len, 'order_by' => $orderBy]);
    }

    /**
     * 我的乐淘记录
     *
     * @param $memberId integer 会员ID
     * @param $phaseId  integer 期数ID
     * @param $len      integer 调用条数
     *
     * @return array
     */
    public function myOrder($memberId, $phaseId, $len = 5) {

        $where = ['member_id' => $memberId, 'phase_id' => $phaseId];
        $orderBy = ['id' => 'desc'];

        return Model_Order::find('all', ['where' => $where, 'limit' => $len, 'order_by' => $orderBy]);
    }

    /**
     * 参与记录
     *
     * @param $phaseId integer 期数ID
     * @param $page    integer 页数
     *
     * @return array
     */
    public function joined($get) {

        if(!isset($get['page']) && !isset($get['phaseId'])) return [];

        $offset = ($get['page'] - 1)*\Helper\Page::PAGESIZE;

        $where   = ['phase_id' => $get['phaseId']];
        $orderBy = ['id' => 'desc'];

        $orders = Model_Order::find('all', ['where' => $where, 'order_by' => $orderBy, 'offset' => $offset, 'limit' => \Helper\Page::PAGESIZE]);

        $data = [];
        list($memberIds) = Model_Order::getIds($orders, ['member_id']);
        $members = Model_Member::byIds($memberIds);

        foreach($orders as  $order) {
            $data[] = [
                    'link' => Uri::create('u/'.$members[$order->member_id]->id),
                    'avatar' => \Helper\Image::showImage($members[$order->member_id]->avatar, '60x60'),
                    'nickname' => $members[$order->member_id]->nickname,
                    'count' => $order->code_count,
                    'ip'    => $order->ip,
                    'area' => $order->area,
                    'created_at' => date('Y-m-d H:i:s', $order->created_at),
                ];
        }

        return $data;
    }

    /*
    *获得总购买人次
    */
    public static function totalCountBuy()
    {
        $result = DB::select(DB::expr(' SUM(code_count) as count'))->from('orders')->execute()->as_array();
        if ($result)
        {
            return  str_pad($result[0]['count'],8,"0",STR_PAD_LEFT);;
        }
        return '000000000';
    }
}
