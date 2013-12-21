<?php

class Model_Lottery extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'item_id',
		'phase_id',
		 'order_id',
		'code',
		'member_id',
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
	protected static $_table_name = 'lotteries';

}
