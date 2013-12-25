<?php
use Orm\Model;

class Model_Member_Moneylog extends Model
{
    protected static $_properties = array(
        'id',
        'phase_id',
        'item_id',
        'total',
        'sum',
        'type',
        'member_id',
        'created_at',
        'updated_at',
    );

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

    public static function validate($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('phase_id', 'Phase Id', 'required|valid_string[numeric]');
        $val->add_field('item_id', 'Item Id', 'required|valid_string[numeric]');
        $val->add_field('total', 'Total', 'required|valid_string[numeric]');
        $val->add_field('sum', 'Sum', 'required|valid_string[numeric]');
        $val->add_field('type', 'Type', 'required|valid_string[numeric]');
        $val->add_field('member_id', 'Member Id', 'required|valid_string[numeric]');

        return $val;
    }
    
    /*
    * 增加用户充值记录
    */
    public static function recharge_log($member_id, $sum)
    {
    }
    /*
    * 增加用户消费记录
    */
    public static function buy_log($member_id, $sum, $item_id, $phase_id, $total)
    {
    }

}
