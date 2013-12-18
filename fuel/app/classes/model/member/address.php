<?php

class Model_Member_Address extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'uid',
		'postcode',
		'address',
		'mobile',
		'name',
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
	protected static $_table_name = 'member_addresses';

}
