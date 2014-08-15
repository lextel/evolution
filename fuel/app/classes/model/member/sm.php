<?php

class Model_Member_Sm extends \Classes\Model
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
        'status',
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

    public static function updateNew($owner_id)
    {
         DB::update('member_sms')->set(['status'  => 1])->where('owner_id', '=', $owner_id)->execute();
        return false;
    }
    /**
     * 日志列表
     *
     * @param $get array get数据
     *
     * @return array
     */
    public function index($options) {

        $condition = [];
        $condition['where'] = $this->handleWhere($options);

        if(isset($options['offset']) && isset($options['limit'])) {

            $condition['offset'] = $options['offset'];
            $condition['limit']  = $options['limit'];
        }

        $condition['order_by'] = ['id' => 'desc'];


        return Model_Member_Sm::find('all', $condition);
    }

    /**
     * 统计日志
     *
     * @param $options array 筛选条件
     *
     * @return integer 数量
     */
    public function countLog($options) {

        $where = $this->handleWhere($options);

        return Model_Member_Sm::count(['where' => $where]);
    }

    /**
     * 处理where条件
     *
     * @param $options array 筛选条件
     *
     * @return array where数组
     */
    public function handleWhere($options) {

        $where = [];
        if(isset($options['user_id']) && $options['user_id'] !== '') {
            $where += ['user_id' => $options['user_id']];
        }

        if(isset($options['start_at']) && !empty($options['start_at']) && isset($options['end_at']) && !empty($options['end_at'])) {
            $where += [['created_at', '>=', strtotime($options['start_at'])]];
            $where += [['created_at', '<=', strtotime($options['end_at'])]];
        }

        return $where;
    }
}
