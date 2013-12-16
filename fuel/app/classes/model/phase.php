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
            'cost',
            'remain',
            'amount',
            'joined',
            'hots',
            'opentime',
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
     * 当商品为上架状态，而且没有正在进行的云购则可添加新一期
     *
     * @param $id integer 商品id
     *
     * @return void
     */
    public function add($id) {

        $config = Config::load('common');

        $item = Model_Item::find('first', ['where' => ['id' => $id, 'status' => self::ON_SELF]]);
        $phase = Model_Phase::find('first', ['where' => ['item_id' => $id, 'status' => 0]]);

        if($item && empty($phase)) {
            $cost = $item->price * $config['point'];
            $data = [
                'item_id'  => $id,
                'cost'     => $cost,
                'remain'   => $item->price,
                'amount'   => $item->price,
                'joined'   => 0,
                'hots'     => 0,
                'opentime' => 0
                ];
            $phaseModel = new Model_Phase($data);
            $result = $phaseModel->save();

            if(!$result) {
                Log::error('Phase: add #'. $id . ' error');
            }
        }

    }


}
