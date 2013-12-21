<?php

class Model_Order extends \Orm\Model
{
    protected static $_properties = array(
        'id',
        'phase_id',
        'mid',
        'codes',
        'code_count',
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
        return Model_Order::find('all', ['where' => ['mid' =>$uid ], 'order_by' => ['created_at' => 'desc']]);
    }
}
