<?php

namespace Fuel\Migrations;

class Create_phases
{
    public function up()
    {
        \DBUtil::create_table('phases', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'item_id' => array('constraint' => 11, 'type' => 'int'),
            'phase_id' => array('constraint' => 11, 'type' => 'int'),
            'cate_id' => array('constraint' => 11, 'type' => 'int'),
            'brand_id' => array('constraint' => 11, 'type' => 'int'),
            'post_id' => ['constraint' => 11, 'type' => 'int'],
            'order_id' => ['constraint' => 11, 'type' => 'int'],
            'member_id' => ['constraint' => 11, 'type' => 'int'],
            'title' => array('constraint' => 255, 'type' => 'varchar'),       // 商品标题
            'image' => ['constraint' => 255, 'type' => 'varchar'],            // 商品首图
            'cost' => array('constraint' => 11, 'type' => 'int'),
            'remain' => array('constraint' => 11, 'type' => 'int'),
            'amount' => array('constraint' => 11, 'type' => 'int'),
            'joined' => array('constraint' => 11, 'type' => 'int'),
            'hots' => array('constraint' => 11, 'type' => 'int'),
            'code' => array('constraint' => 12, 'type' => 'varchar'),
            'codes' => array('type' => 'mediumtext'),                         // 本期幸运码 // TODO 需要优化
            'code_count' => ['constraint' => 11, 'type' => 'int'],
            'sort' => array('constraint' => 11, 'type' => 'int'),             // 排序
            'status' => array('constraint' => 11, 'type' => 'int'),
            'is_delete' => array('constraint' => 1, 'type' => 'int'),
            'opentime' => array('constraint' => 11, 'type' => 'int'),
            'total' => ['constraint' => 20, 'type' => 'varchar'],
            'results' => ['type' => 'text'],
            'item_created_at' => array('constraint' => 11, 'type' => 'int'),
            'order_created_at' => ['constraint' => 11, 'type' => 'int'],
            'status' => array('constraint' => 11, 'type' => 'int'),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

        ), array('id'));
        \DBUtil::create_index('phases', 'item_id');
        \DBUtil::create_index('phases', 'cate_id');
        \DBUtil::create_index('phases', 'brand_id');
        \DBUtil::create_index('phases', 'cost');
        \DBUtil::create_index('phases', 'remain');
        \DBUtil::create_index('phases', 'hots');
        \DBUtil::create_index('phases', 'opentime');
    }

    public function down()
    {
        \DBUtil::drop_table('phases');
    }
}
