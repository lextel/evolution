<?php

class Model_Member_Address extends \Classes\Model
{
    protected static $_properties = array(
        'id',
        'member_id',
        'postcode',
        'address',
        'mobile',
        'name',
        'created_at',
        'updated_at',
        'rate',
        'is_delete',
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

    protected static $_table_name = 'member_addresses';

    public static function validate($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('province', '', 'required');
        $val->add_field('city', '', 'required');
        $val->add_field('county', '', 'required');
        $val->add_field('address', '', 'required');
        $val->add_field('name', '', 'required');
        $val->add_field('phone', '', 'required');
        return $val;
    }

    /*
    *增加个人收货地址信息
    */
    public static function add($uid)
    {
        $val = Model_Member_Address::forge([
                'member_id'=>$uid,
                'postcode'=>'',
                'address'=>'',
                'mobile'=>'',
                'name'=>'',
            ]);
        $val->save();
        $post = Model_Member_Address::find_by_uid($uid);
        return $post;
    }
}
