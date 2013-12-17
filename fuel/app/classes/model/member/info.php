<?php

class Model_Member_Info extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'uid',
		'username',
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
	protected static $_table_name = 'member_infos';

}
