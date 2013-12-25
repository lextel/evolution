<?php

class Model_Phase extends \Orm\Model
{

    /**
     * @def 商品上架状态
     */
    const ON_SELF = 1;

    protected static $_belongs_to = array('items');

    protected static $_properties = array(
            'id',
            'item_id',
            'phase_id',
            'cate_id',
            'brand_id',
            'title',
            'cost',
            'remain',
            'amount',
            'joined',
            'hots',
            'codes',
            'is_delete',
            'opentime',
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

        $config = Config::load('common');

        $phase = Model_Phase::find('first', ['where' => ['item_id' => $item->id, 'opentime' => 0]]);

        if($item && empty($phase)) {
            $count = Model_Phase::count(['where' => ['item_id' => $item->id]]);
            $cost = $item->price * $config['point'];
            $codes = $this->_createCodes($item->price);
            $data = [
                'item_id'         => $item->id,
                'phase_id'        => $count+1,
                'cate_id'         => $item->cate_id,
                'brand_id'        => $item->brand_id,
                'title'           => $item->title,
                'cost'            => $cost,
                'remain'          => $item->price,
                'amount'          => $item->price,
                'joined'          => 0,
                'hots'            => 0,
                'codes'           => serialize($codes),
                'is_delete'       => $item->is_delete,
                'opentime'        => 0,
                'item_created_at' => $item->created_at,
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
}
