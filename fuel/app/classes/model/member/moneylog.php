<?php
use Orm\Model;

class Model_Member_Moneylog extends Model
{
    /*
    * type = 0 is recharge
    * type = 1 is buy
    */
    protected static $_properties = array(
        'id',
        'phase_id',
        'total',
        'sum',
        'type',
        'source',
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
        $val->add_field('total', 'Total', 'required|valid_string[numeric]');
        $val->add_field('sum', 'Sum', 'required|valid_string[numeric]');
        $val->add_field('type', 'Type', 'required|valid_string[numeric]');
        $val->add_field('member_id', 'Member Id', 'required|valid_string[numeric]');
        return $val;
    }

    /*
    * 增加用户充值记录
    * member_id 为用户ID, sum为充值数量, source 来源
    */
    public static function recharge_log($member_id, $sum, $source)
    {
        $recharge = Model_Member_Moneylog::forge([
            'member_id'=>$member_id,
            'phase_id'=>0,
            'sum'=>$sum,
            'type'=>0,
            'source'=>$source,
            'total'=>0,
            ]);
        if($recharge->save()){
            return true;
        }
        return false;
    }
    /*
    * 增加用户消费记录
    * member_id 为用户ID,sum为用户消费额，item_id为商品ID，phase_id为期数ID，TOTAL为一次购买的数量
    */
    public static function buy_log($member_id, $sum, $phase_id, $total)
    {
        $buy = Model_Member_Moneylog::forge([
            'member_id'=>$member_id,
            'sum'=>$sum,
            'type'=>1,
            'phase_id'=>$phase_id,
            'total'=>$total,
            ]);
        if($buy->save()){
            return true;
        }
        return false;
    }

}
