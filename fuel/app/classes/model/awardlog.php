<?php

class Model_Awardlog extends \Classes\Model
{
    protected static $_table_name = 'awardlog';
    protected static $_properties = [
        'id',
        'app_id',
        'package',
        'title',
        'award',
        'status',
        'member_id',
        'imei',
        'username',
        'created_at',
        'updated_at',
    ];

    protected static $_observers = [
        'Orm\Observer_CreatedAt' => [
            'events' => ['before_insert'],
            'mysql_timestamp' => false,
        ],
        'Orm\Observer_UpdatedAt' => [
            'events' => ['before_save'],
            'mysql_timestamp' => false,
        ],
    ];

    /**
     * 处理where条件
     *
     * @param $options array 筛选条件
     *
     * @return array where数组
     */
    public function handleWhere($options) {

        $where = [];
        if(isset($options['member']) && $options['member'] !== '') {
            $where += ['username' => $options['member']];
        }

        if(isset($options['start_at']) && !empty($options['start_at']) && isset($options['end_at']) && !empty($options['end_at'])) {
            $where += [['created_at', '>=', strtotime($options['start_at'])]];
            $where += [['created_at', '<=', strtotime($options['end_at'])]];
        }

        return $where;
    }

}
