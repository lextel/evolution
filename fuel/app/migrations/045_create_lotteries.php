<?php

namespace Fuel\Migrations;

class Create_lotteries
{
    public function up()
    {
        \DBUtil::create_table('lotteries', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'item_id' => array('constraint' => 11, 'type' => 'int'),
            'phase_id' => array('constraint' => 11, 'type' => 'int'),
            'order_id' => array('constraint' => 11, 'type' => 'int'),
            'code' => array('constraint' => 255, 'type' => 'varchar'),
            'member_id' => array('constraint' => 11, 'type' => 'int'),
            'post_id' => array('constraint' => 11, 'type' => 'int'),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

        ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('lotteries');
    }
}
