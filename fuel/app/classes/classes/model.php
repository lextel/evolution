<?php
/**
 * 扩展orm model
 */

namespace Classes;

use \Orm\Query;

class Model extends \Orm\Model {

    /**
     * 遍历所有某些ID
     *
     * 使用:
     *
     * $orders = Model_Order::find('all');
     * list($memberIds, $phaseIds) = Model_Order::getIds($orders, ['member_id', 'phase_id']);
     *
     * @param $modelObj array 取出的记录对象
     * @param $idFields array 收集的字段
     *
     * @return array
     */
    public static function getIds($modelObj, $idFields) {

        $data = [];
        foreach($modelObj as $item) {
            foreach($idFields as $key => $field) {
                $data[$key][] = $item->$field;
            }
        }

        return $data;
    }

    /**
     * 批量获取记录
     *
     * 单表查询辅助，把每条记录都需查询一次的信息组成一条sql
     * 比如： 晒单列表 每个晒单需要读取一次会员信息将会产生一条sql
     *        优化成先循环当前晒单得到所有的会员ID，一次获取再通过索引调用相应的会员信息
     *
     * 使用：
     * $orders = Model_Order::find('all');
     * list($memberIds, $phaseIds) = Model_Order::getIds($orders, ['member_id', 'phase_id']);
     *
     * $members = Model_Member::byIds($memberIds);
     *
     * @param $ids array 主键ID
     * 
     * @return array
     */
    public static function byIds($ids) {

        $ids     = array_unique($ids);
        $model   = get_called_class();
        $results = $model::find('all', ['where' => [['id', 'in', $ids]]]);

        $data = [];
        foreach($results as $result) {
            $data[$result->id] = $result;
        }

        return $data;
    }

    // 重写父类避免报异常 其实跟父类一样的
    public static function __callStatic($method, $args)
    {
        // Start with count_by? Get counting!
        if (strpos($method, 'count_by') === 0)
        {
            $find_type = 'count';
            $fields = substr($method, 9);
        }

        // Otherwise, lets find stuff
        elseif (strpos($method, 'find_') === 0)
        {
            if ($method == 'find_by')
            {
                $find_type = 'all';
                $fields = array_shift($args);
            }
            else
            {
                $find_type = strncmp($method, 'find_all_by_', 12) === 0 ? 'all' : (strncmp($method, 'find_by_', 8) === 0 ? 'first' : false);
                $fields = $find_type === 'first' ? substr($method, 8) : substr($method, 12);
            }
        }

        // God knows, complain
        else
        {
            throw new \FuelException('Invalid method call.  Method '.$method.' does not exist.', 0);
        }

        $where = $or_where = array();

        if (($and_parts = explode('_and_', $fields)))
        {
            foreach ($and_parts as $and_part)
            {
                $or_parts = explode('_or_', $and_part);

                if (count($or_parts) == 1)
                {
                    $where[] = array($or_parts[0], array_shift($args));
                }
                else
                {
                    foreach($or_parts as $or_part)
                    {
                        $or_where[] = array($or_part, array_shift($args));
                    }
                }
            }
        }

        $options = count($args) > 0 ? array_pop($args) : array();

        if ( ! empty($where))
        {
            if ( ! array_key_exists('where', $options))
            {
                $options['where'] = $where;
            }
            else
            {
                $options['where'] = array_merge($where, $options['where']);
            }
        }

        if ( ! empty($or_where))
        {
            if ( ! array_key_exists('or_where', $options))
            {
                $options['or_where'] = $or_where;
            }
            else
            {
                $options['or_where'] = array_merge($or_where, $options['or_where']);
            }
        }

        if ($find_type == 'count')
        {
            return static::count($options);
        }

        else
        {
            return static::find($find_type, $options);
        }

        // min_...($options)
        // max_...($options)
    }

}
