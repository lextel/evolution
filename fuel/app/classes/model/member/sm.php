<?php
use Orm\Model;

class Model_Member_Sm extends Model
{
	protected static $_properties = array(
		'id',
		'owner_id',
		'title',
		'type',
		'user_id',
		'user_name',
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
		$val->add_field('owner_id', 'Owner Id', 'required|valid_string[numeric]');
		$val->add_field('title', 'Title', 'required|max_length[255]');
		$val->add_field('type', 'Type', 'required|max_length[255]');
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
		$val->add_field('user_name', 'User Name', 'required|max_length[255]');

		return $val;
	}

}
