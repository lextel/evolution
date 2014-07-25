<?php

class Model_Phase extends \Classes\Model {

    protected static $_properties = array(
            'id',
            'item_id',
            'phase_id',
            'cate_id',
            'brand_id',
            'post_id',
            'order_id',
            'member_id',
            'title',
            'image',
            'cost',
            'remain',
            'amount',
            'joined',
            'hots',
            'code',
            'codes',
            'code_count',
            'sort',
            'status',
            'total',
            'results',
            'is_recommend',
            'is_delete',
            'opentime',
            'status',
            'order_created_at',
            'item_created_at',
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

    protected static $_table_name = 'phases';

    /**
     * 添加期数
     *
     * @param $item object 商品对象
     *
     * @return void
     */
    public function add($item) {


        $phase = Model_Phase::count(['where' => ['item_id' => $item->id, 'opentime' => 0]]);

        $result = false;
        if($item && $phase <= 1) {
            Config::load('common');
            $count = Model_Phase::count(['where' => ['item_id' => $item->id]]);
            $cost = $item->price * Config::get('point');
            $codes = $this->_createCodes($item->price);
            $data = [
                'item_id'          => $item->id,
                'phase_id'         => $count+1,
                'cate_id'          => $item->cate_id,
                'brand_id'         => $item->brand_id,
                'post_id'          => 0,
                'order_id'         => 0,
                'member_id'        => 0,
                'image'            => $item->image,
                'title'            => $item->title,
                'cost'             => $cost,
                'remain'           => $item->price,
                'amount'           => $item->price,
                'joined'           => 0,
                'hots'             => 0,
                'code'             => '',
                'codes'            => serialize($codes),
                'code_count'       => 0,
                'sort'             => $item->sort,
                'is_recommend'     => $item->is_recommend,
                'is_delete'        => $item->is_delete,
                'opentime'         => 0,
                'total'            => 0,
                'results'          => '',
                'status'           => $item->status,
                'order_created_at' => 0,
                'item_created_at'  => $item->created_at,
                ];
            $phaseModel = new Model_Phase($data);
            $result = $phaseModel->save();
        }

        if(!$result) {
            $reason = empty($item) ? '母商品内容是空的' : '有其他正在进行的期数';
            Log::error('期数:开启新一期 商品ID#'. $item->id . '失败 原因:' .  $reason);
        }
    }

    /**
     * 生成号码
     *
     * @param $len integer 数目
     *
     * @return array
     */
    public function _createCodes($len) {

        $codes = [];
        $code  = 10000000;
        for($i = 1; $i <= $len; $i++) {
            $codes[] = $code+$i;
        }

        shuffle($codes);

        return $codes;
    }

    /**
     * 最新揭晓统计
     */
    public function countWins() {

        return Model_Phase::count(['where' => [['opentime', '>', 0],  'and'=>['is_delete', '=', 0]]]);
    }

    /**
     * 获取揭晓列表
     *
     * @param $offset integer 偏移
     * @param $limit  integer 限制
     *
     * @return array
     */
    public function getWins($offset, $limit) {

        $where = [['opentime', '>', 0], 'and'=>['is_delete', '=', 0]];

        return Model_Phase::find('all', ['where' => $where, 'offset' => $offset, 'limit' => $limit, 'order_by' => ['opentime' => 'desc']]);
    }

    /**
     * 获取揭晓详情
     *
     * @param $id integer 期数ID
     *
     * @return array
     */
    public function win($id) {

        return Model_Phase::find('first', ['where' => ['id' => $id, 'is_delete' => '0']]);
    }


    public static function byWinsIds($ids, $options) {
        if(!is_array($ids)) $ids = [0];
        if ($ids[0] == 0){
            return [];
        }
        $ids     = array_unique($ids);
        $model   = get_called_class();
        $condition = [];
        $condition['where'] = [['member_id', 'in', $ids]];
        if(isset($options['offset']) && isset($options['limit'])) {

            $condition['offset'] = $options['offset'];
            $condition['limit']  = $options['limit'];
        }
        if(isset($options['status'])) {
            if ($options['status'] == 0)
            {
               $postid = 0;
               $condition['where'] += ['and'=>['post_id', '=', $postid]];
            }elseif ($options['status'] == 1){
               $postid = 0;
               $condition['where'] += ['and'=>['post_id', '!=', $postid]];
            }else{

            }

        }
        $condition['order_by'] = ['id' => 'desc'];
        $results = $model::find('all', $condition);

        $data = [];
        foreach($results as $result) {
            $data[$result->id] = $result;
        }

        return $data;
    }

    public static function byWinsIdsCount($ids, $options) {

        if(!is_array($ids)) $ids = [0];
        if ($ids[0] == 0){
            return 0;
        }
        $ids     = array_unique($ids);
        $model   = get_called_class();
        $condition = [];
        $condition['where'] = [['member_id', 'in', $ids]];
        if(isset($options['status'])) {
            if ($options['status'] == 0)
            {
               $postid = 0;
               $condition['where'] += ['and'=>['post_id', '=', $postid]];
            }elseif ($options['status'] == 1){
               $postid = 0;
               $condition['where'] += ['and'=>['post_id', '!=', $postid]];
            }else{

            }

        }
        $count = $model::count($condition);

        return $count;
    }
}
