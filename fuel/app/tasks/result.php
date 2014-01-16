<?php

/**
 * 运算结果
 */
namespace Fuel\Tasks;

class Result {
    public static function run($phaseId = null)
    {
        $phaseId = intval($phaseId);
        if(empty($phaseId)) return 'fail';

        $time = time();
        $phase = \Model_Phase::find('first', ['where' => ['id' => $phaseId, 'member_id' => 0,['opentime', '!=', 0], ['opentime', '<=', $time]]]);

        if(empty($phase)) return 'fail';

        // 获取100个支付记录
        $orders = \Model_Order::find('all', ['where' => [['created_at', '<=', $phase->updated_at]], 'limit' => 100]);

        $total = 0;
        $results = [];
        foreach($orders as $order) {
            $times = explode('.', $order->ordered_at);

            $number = date('His', $times[0]) . $times[1];
            $total += $number;
            $results[] = [
                'member_id' => $order->member_id,
                'phase_id' => $order->phase_id,
                'number' => $number,
                'ordered_at' => $order->ordered_at,
                'count' => $order->code_count,
                ];
        }

        $num = $total%$phase->amount;
        $code = 10000001 + $num;
        $like = '%'.$code.'%';
        $where = ['phase_id' => $phaseId, ['codes', 'LIKE', $like]];
        $order = \Model_Order::find('first', ['where' => $where]);

        $phase->code = $code;
        $phase->code_count = $order->code_count;
        $phase->results = serialize($results);
        $phase->total = $total;
        $phase->member_id = $order->member_id;
        $phase->order_created_at = $order->created_at;
        $phase->order_id = $order->id;
        $phase->save();

        // 写发货表
        $data = [
            'member_id' => $order->member_id,
            'phase_id'  => $phaseId,
            'status'    => 100,
            'address'   => '',
            'mobile'    => '',
            'name'      => '',
            'excode'    => '',
            'exname'    => '',
            'exdesc'    => '',
            'admin_id'  => 0,
            ];
        $shipping = new \Model_Shipping($data);
        $shipping->save();

        // 发送通知
        $data = [
            'owner_id'  => $order->member_id,
            'title'     => sprintf('(第%d期)%s', $phase->phase_id, $phase->title),
            'type'      => 'win',
            'user_id'   => 0,
            'user_name' => '系统',
            ];
        $sms = new \Model_Member_Sm($data);
        $sms->save();

        return 'success';
    }
}

