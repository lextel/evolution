<?php

class Model_Shipping extends \Classes\Model
{
    protected static $_properties = array(
        'id',
        'member_id',
        'phase_id',
        'status',
        'excode',
        'exname',
        'exdesc',
        'name',
        'postcode',
        'mobile',
        'address',
        'admin_id',
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
    protected static $_table_name = 'shippings';

    /**
     * 数量
     *
     * @param $options array 筛选条件
     *
     * @return 统计
     */
    public function countShipping($options) {

        $where = $this->handleWhere($options);

        return Model_Shipping::count(['where' => $where]);
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
        if(isset($options['status']) && $options['status']  >= 0) {
            $where += ['status' => $options['status']];
        }

        if(isset($options['excode']) && $options['excode'] != '') {
            $where += ['excode' => $options['excode']];
        }

        return $where;
    }

    /**
     * 列表
     *
     * @param $options array get数据
     *
     * @return array
     */
    public function index($options) {

        $condition['where'] = $this->handleWhere($options);

        if(isset($options['offset']) && isset($options['limit'])) {

            $condition['offset'] = $options['offset'];
            $condition['limit']  = $options['limit'];
        }

        $condition['order_by'] = ['id' => 'desc'];


        return Model_Shipping::find('all', $condition);
    }

}
