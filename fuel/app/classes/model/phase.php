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

        if($item && empty($phase)) {

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

            if(!$result) {
                Log::error('Phase: add #'. $id . ' error');
            }
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

        return Model_Phase::find($id);
    }
}
