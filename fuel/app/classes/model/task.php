<?php
class Model_Task extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'owner_id',
		'user_id',
		'action',
		'type_id',
		'is_read',
		'obj_id',
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
		$val->add_field('owner_id', '接受人', 'required|valid_string[numeric]');
		$val->add_field('user_id', '发送者', 'required|valid_string[numeric]');
		$val->add_field('action', '操作', 'required|max_length[255]');
		$val->add_field('type_id', '任务类型', 'required|valid_string[numeric]');
		$val->add_field('is_read', '是否已读', 'required|valid_string[numeric]');
		$val->add_field('obj_id', '操作对象', 'required|valid_string[numeric]');

		return $val;
	}

	/**
	 * 添加任务通知
   *
   * @param $action  string  操作 (添加 | 修改 | 删除)
   * @param $type_id integer 任务类型 晒单 商品操作
   * @param $obj_id  integer 操作对象ID
   *
   * @return void
	 */
	public function add($action, $typeId, $objId) {

      list(, $userId) = Auth::get_user_id();

      $taskModel = new Model_Task();
      $taskModel->owner_id = 1;
      $taskModel->user_id  = $userId;
      $taskModel->action   = $action;
      $taskModel->type_id  = $typeId;
      $taskModel->obj_id   = $objId;
      $taskModel->is_read  = 0;
      $rs = $taskModel->save();

      if(!$rs) Log::error('Task: add error');
  }

}
