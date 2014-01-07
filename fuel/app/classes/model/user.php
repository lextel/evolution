<?php

class Model_User extends \Orm\Model
{
    protected static $_table_name = 'users';

    protected static $_properties = array(
        'id',
        'username',
        'password',
        'group',
        'email',
        'last_login',
        'login_hash',
        'profile_fields',
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
        'Orm\Observer_LastLogin' => array(
            'events' => array('before_update'),
            'mysql_timestamp' => false,
        ),
    );
    
    
    public static function validate($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('username', '账号', 'required|max_length[255]');
        $val->add_field('group', '权限', 'required|valid_string[numeric]');
        $val->add_field('email', '邮箱', 'required');
        return $val;
    }

    /**
     * 更新管理员
     *
     * @param $id     integer 管理员ID
     * @param $update array   更新数据
     *
     * @return boolean
     */
    public function edit($id, $update) {

        $affected_rows = \DB::update(\Config::get('simpleauth.table_name'))
            ->set($update)
            ->where('id', '=', $id)
            ->execute(\Config::get('simpleauth.db_connection'));

        Model_Log::add('更新管理员 #' . $id);

        return $affected_rows > 0;
    }
}
