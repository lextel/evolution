<?php
class Model_Gift extends \Orm\Model
{
    protected static $_properties = array(
        'id',
        'project',
        'code',
        'mark',
        'status',
        'member_id',
        'member_code',
        'game_id',
        'is_delete',
        'end_time',
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
        $val->add_field('codes', 'Code', 'required');
        $val->add_field('game_ID', 'Game Id', 'required|max_length[255]');
        return $val;
    }

}
