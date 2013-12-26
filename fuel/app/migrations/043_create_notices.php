<?php

namespace Fuel\Migrations;

class Create_notices
{
    public function up()
    {
        \DBUtil::create_table('notices', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'user_id' => ['constraint' => 11, 'type' => 'int'],
            'is_top' => ['constraint' => 1, 'type' => 'int'],
            'title' => array('constraint' => 255, 'type' => 'varchar'),
            'summary' => array('constraint' => 255, 'type' => 'varchar'),
            'desc' => array('type' => 'text'),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

        ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('notices');
    }
}
