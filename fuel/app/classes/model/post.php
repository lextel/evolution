<?php
class Model_Post extends \Orm\Model
{

    //protected static $_belongs_to = array('user', 'item', 'phase');
    protected static $_table_name = 'posts';

    protected static $_properties = array(
        'id',
        'title',
        'desc',
        'status',
        'item_id',
        'member_id',
        'type_id',
        'phase_id',
        'created_at',
        'updated_at',
        'topimage',
        'images',
        'up',
        'comment_count',
        'comment_top',
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
        $val->add_field('title', 'Title', 'required|max_length[255]');
        $val->add_field('desc', 'Desc', 'required');
        $val->add_field('status', 'Status', 'required|valid_string[numeric]');
        $val->add_field('item_id', 'Item Id', 'required|valid_string[numeric]');
        $val->add_field('member_id', 'Member Id', 'required|valid_string[numeric]');
        $val->add_field('type_id', 'Type Id', 'required|valid_string[numeric]');
        $val->add_field('phase_id', 'Phase Id', 'required|valid_string[numeric]');
        $val->add_field('topimage', 'Topimage', 'required');
        $val->add_field('images', 'Images', 'required');
        return $val;
    }

}
