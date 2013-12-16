<?php

namespace Fuel\Migrations;

class Create_phases
{
    public function up()
    {
        \DBUtil::create_table('phases', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'item_id' => array('constraint' => 11, 'type' => 'int'),
            'cost' => array('constraint' => 11, 'type' => 'int'),
            'remain' => array('constraint' => 11, 'type' => 'int'),
            'amount' => array('constraint' => 11, 'type' => 'int'),
            'joined' => array('constraint' => 11, 'type' => 'int'),
            'hots' => array('constraint' => 11, 'type' => 'int'),
            'opentime' => array('constraint' => 11, 'type' => 'int'),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

        ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('phases');
    }
}