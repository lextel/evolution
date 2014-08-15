<?php

namespace Fuel\Migrations;

class Create_invitcodes
{
    public function up()
    {
        \DBUtil::create_table('invitcodes', array(
            'id' => array('constraint' => 10, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'code' => array('constraint' => 8, 'type' => 'varchar'),
            'status' => array('constraint' => 1, 'type' => 'int'),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

        ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('invitcodes');
    }
}