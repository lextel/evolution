<?php

namespace Fuel\Migrations;

class Create_friends
{
    public function up()
    {
        \DBUtil::create_table('friends', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'mid' => array('constraint' => 11, 'type' => 'int'),
            'fid' => array('constraint' => 11, 'type' => 'int'),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

        ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('friends');
    }
}