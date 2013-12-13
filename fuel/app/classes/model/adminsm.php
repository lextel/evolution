<?php
class Model_Adminsm extends \Orm\Model
{
	const ITEM = 1;
	const POST = 2;
	
    protected static $_table_name = 'adminsms';
    //protected static $_has_one = array('users');

	protected static $_properties = array(
		'id',
		'ower_id',
		'action',
		'type',
		'user_id',
		'isread',
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
		$val->add_field('ower_id', 'Ower Id', 'required|valid_string[numeric]');
		$val->add_field('action', 'Action', 'required|max_length[255]');
		$val->add_field('type', 'Type', 'required|max_length[255]');
		$val->add_field('user_id', 'User Id', 'required|valid_string[numeric]');
		$val->add_field('isread', 'Isread', 'required|valid_string[numeric]');
		$val->add_field('obj_id', 'Obj Id', 'required|valid_string[numeric]');

		return $val;
	}
    //push the sms to some user
	public function pushMutilSms($params, $users)
	{
        
        foreach($users as $user){
        	$this->pushSingleSms($params, $user);
        }
        
	}
    public function pushSingleSms($params, $user_id){
    	$adminsm = DB::forge(array(
		        'ower_id' => $params->ower_id,
				'action' => $params->action,
				'type' => $params->type,
				'user_id' => $user_id,
				'isread' => 0,
				'obj_id' => $params->obj_id,
		));

		if ($adminsm and $adminsm->save())
		{
		    Session::set_flash('success', e('Added adminsm #'.$adminsm->id.'.'));
			return true;
		}
		else
		{
			    Session::set_flash('error', e('Could not save adminsm.'));
			return false;
	    }
	}
    
}
