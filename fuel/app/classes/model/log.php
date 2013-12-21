<?php
class Model_Log extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'desc',
		'ip',
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
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
		$val->add_field('desc', 'Desc', 'required|max_length[255]');
		$val->add_field('ip', 'Ip', 'required|max_length[15]');

		return $val;
	}

}
