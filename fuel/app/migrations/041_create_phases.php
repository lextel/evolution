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
            'title' => array('constraint' => 255, 'type' => 'varchar'),
            'cost' => array('constraint' => 11, 'type' => 'int'),
            'remain' => array('constraint' => 11, 'type' => 'int'),
            'amount' => array('constraint' => 11, 'type' => 'int'),
            'joined' => array('constraint' => 11, 'type' => 'int'),
            'hots' => array('constraint' => 11, 'type' => 'int'),
            'codes' => array('type' => 'text'),
            'status' => array('constraint' => 11, 'type' => 'int'),
            'is_delete' => array('constraint' => 1, 'type' => 'int'),
            'opentime' => array('constraint' => 11, 'type' => 'int'),
            'item_created_at' => array('constraint' => 11, 'type' => 'int'),
            'status' => array('constraint' => 11, 'type' => 'int'),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

        ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('phases');
    }
}
