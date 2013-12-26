<?php

class Model_User extends \Orm\Model
{
    protected static $_table_name = 'users';

    protected static $_properties = array(
        'id',
        'username',
        'password',
        'group',
        'email',
        'last_login',
        'login_hash',
        'profile_fields',
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
        'Orm\Observer_LastLogin' => array(
            'events' => array('before_update'),
            'mysql_timestamp' => false,
        ),
    );
    
    
    public static function validate($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('username', 'username', 'required|max_length[255]');
        $val->add_field('password', 'password', 'required');
        $val->add_field('group', 'group', 'required|valid_string[numeric]');
        $val->add_field('email', 'email', 'required');
        return $val;
    }
}
