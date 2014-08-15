<?php

namespace Fuel\Migrations;

class Create_giftgames
{
    public function up()
    {
        \DBUtil::create_table('giftgames', array(
            'id' => array('constraint' => 11, 'type' => 'int',  'auto_increment' => true, 'unsigned' => true),
            'name' => array('constraint' => 255, 'type' => 'varchar'),
            'status' => array('constraint' => 4, 'type' => 'int', 'default' => 0),
            'is_delete' => array('constraint' => 4, 'type' => 'int', 'default' => 0),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
        ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('giftgames');
    }
}