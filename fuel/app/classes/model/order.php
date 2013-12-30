<?php

class Model_Order extends \Orm\Model
{
    protected static $_properties = array(
        'id',
        'phase_id',
        'member_id',
        'codes',
        'code_count',
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
        foreach($carts as $cart) {

            $phaseId = $cart->get_id();
            $fetchCodes = $this->buy($phaseId, $cart->get_qty());
            $data = [
                'phase_id'   => $phaseId,
                'member_id'  => $memberId,
                'codes'      => serialize($fetchCodes),
                'code_count' => count($fetchCodes),
                'ordered_at' => $timer->millitime(),
                ];

            $orderModel = new Model_Order($data);
            if($orderModel->save()) {
                $cart->delete();

                $quantity += count($fetchCodes);
                $orderIds[] = $orderModel->id;
            }
        }

        // 更新用户积分
        $member = Model_Member::find($memberId);
        $member->points = $member->points - $quantity;
        $member->save();

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
        $phase->codes = serialize($remainCodes);
        $phase->remain = $phase->remain - $count;
        $phase->joined = $phase->joined + $count;
        if($phase->remain == 0) {
            $config = Config::load('common');
            $phase->opentime = time() + ($config['open'] * 60);
        }

        $phase->save();

        // 生成新一期
        if($total == $count) {
            $item = Model_Item::find($phase->item_id);
            if($item->status == \Helper\Item::IS_PASS) {
                $phaseModel = new Model_Phase();
                $phaseModel->add($item);
            }
        }

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

        return Model_Order::find('all', ['where' => ['member_id' => $memberId, ['id', 'IN', $orderIds]]]);
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
     * 最新乐拍记录
     *
     * @param $phaseId integer 期数ID
     * @param $len     integer 调用条数
     *
     * @return array
     */
    public function newOrders($phaseId, $len = 5) {

        return Model_Order::find('all', ['where' => ['phase_id' => $phaseId], 'limit' => $len, 'order_by' => ['id' => 'desc']]);
    }

    /**
     * 我的乐拍记录
     *
     * @param $memberId integer 会员ID
     * @param $phaseId  integer 期数ID
     * @param $len      integer 调用条数
     *
     * @return array
     */
    public function myOrder($memberId, $phaseId, $len = 5) {

        return Model_Order::find('all', ['where' => ['member_id' => $memberId, 'phase_id' => $phaseId], 'limit' => $len, 'order_by' => ['id' => 'desc']]);
    }
}
