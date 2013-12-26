<?php

namespace Fuel\Migrations;

class Create_orders
{
    public function up()
    {
        \DBUtil::create_table('orders', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'phase_id' => array('constraint' => 11, 'type' => 'int'),
            'member_id' => array('constraint' => 11, 'type' => 'int'),
            'codes' => array('type' => 'text'),
            'code_count' => array('constraint' => 11, 'type' => 'int'),
            'ordered_at' => ['constraint' => '13,3', 'type' => 'decimal'],
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

        ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('orders');
    }
}
