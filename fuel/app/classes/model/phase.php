<?php

class Model_Phase extends \Orm\Model
{

    const ON_SELF = 1;

    protected static $_belongs_to = array('item');

    protected static $_properties = array(
            'id',
            'item_id',
            'cost',
            'remain',
            'amount',
            'joined',
            'hots',
            'opentime',
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

    protected static $_table_name = 'phases';



}
