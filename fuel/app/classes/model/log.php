<?php
class Model_Log extends \Classes\Model
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


        return Model_Log::find('all', $condition);
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

        return Model_Log::count(['where' => $where]);
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



    /**
     * 写管理日志
     *
     * @param $desc string 详情
     *
     * @return viod
     */
    public static function add($desc) {

        $auth = Auth::instance('Simpleauth');
        $userId =  $auth->get('id');

        $member = new \Helper\Member();
        $data = [
            'user_id' => $userId,
            'desc'    => $desc,
            'ip'      => $member->getIp(),
        ];

        $log = new Model_Log($data);
        if(!$log || $log->save()) {
            Log::error('Write Log:' . "UserId[{$userId}]" .$desc);
        }
    }
}
