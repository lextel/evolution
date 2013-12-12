<?php
class Model_Item extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'title',
		'desc',
		'price',
		'cate_id',
		'status',
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
		$val->add_field('title', 'Title', 'required|max_length[255]');
		$val->add_field('desc', 'Desc', 'required');
		$val->add_field('price', 'Price', 'required|valid_string[numeric]');
		$val->add_field('cate_id', 'Cate Id', 'required|valid_string[numeric]');
		$val->add_field('status', 'Status', 'required|valid_string[numeric]');

		return $val;
	}

}
