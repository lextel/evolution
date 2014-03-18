<?php

class Model_Comment extends \Classes\Model
{
    protected static $_properties = array(
        'id',
        'item_id',
        'member_id',
        'text',
        'status',
        'pid',
        'is_delete',
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
        $val->add_field('member_id', 'Member Id', 'required|valid_string[numeric]');
        $val->add_field('text', 'Text', 'required');
        $val->add_field('status', 'Status', 'required|valid_string[numeric]');
        $val->add_field('pid', 'Pid', 'required|valid_string[numeric]');
        return $val;
    }
    public static function validateComment($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('text', 'Text', 'required');
        return $val;
    }

}
