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
    public function myOrders() {

        list(, $userId) = Auth::get_user_id();

        return Model_Order::find('all', ['where' => ['mid' => $userId], 'order_by' => ['created_at' => 'desc']]);
    }
}
