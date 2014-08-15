<?php
class Model_GiftCode extends \Classes\Model
{
    protected static $_properties = [
        'id',
        'member_id',
        'game_id',
        'gift_id',
        'code',
        'order_id',
        'phase_id',
        'is_delete',
        'status',//状态
        'created_at',
        'updated_at',
    ];

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => false,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_save'),
            'mysql_timestamp' => false,
        ),
    );
    protected static $_table_name = 'giftcodes';
    public static function validate($factory)
    {
        return;
    }
}
