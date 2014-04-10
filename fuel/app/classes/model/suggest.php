<?php

class Model_Suggest extends \Classes\Model
{
    protected static $_table_name = 'suggests';

    protected static $_properties = array(
        'id',
        'mobile',
        'title',
        'type',
        'text',
        'user_id',
        'user_name',
        'nickname',
        'email',
        'created_at',
        'updated_at',
        'status',
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
        /*
        'Orm\Observer_LastLogin' => array(
            'events' => array('before_update'),
            'mysql_timestamp' => false,
        ),*/
    );
}
