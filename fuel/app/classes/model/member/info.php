<?php

class Model_Member_Info extends \Orm\Model
{
	protected static $_table_name = 'member_infos';

	protected static $_properties = array(
		'id',
		'uid',
		'nickname',
		'local',
		'address',
		'gender',
		'birth',
		'qq',
		'horoscope',
		'salary',
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

    
    public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('nickname', '', 'required|max_length[255]');
		$val->add_field('local', '', 'required');
		$val->add_field('gender', '', 'required');
		return $val;
	}
}
