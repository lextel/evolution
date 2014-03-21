<?php

class Model_Member_Brokerage extends \Classes\Model
{
	protected static $_properties = array(
		'id',
		'type_id',
		'member_id',
		'target_id',
		'points',
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
	protected static $_table_name = 'member_brokerages';

}
