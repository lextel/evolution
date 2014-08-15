<?php

namespace Fuel\Migrations;

class Create_gifts
{
    public function up()
    {
        \DBUtil::create_table('gifts', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'project' => array('constraint' => 255, 'type' => 'varchar'),
            'code' => array('constraint' => 255, 'type' => 'varchar'),
            'mark' => array('constraint' => 255, 'type' => 'varchar'),
            'status' => array('constraint' => 2, 'type' => 'int', 'default'=>0),
            'member_id' => array('constraint' => 11, 'type' => 'int'),
            'member_code' => array('constraint' => 11, 'type' => 'int'),
            'game_id' => array('constraint' => 11, 'type' => 'int'),
            'is_delete' => array('constraint' => 2, 'type' => 'int', 'default'=>0),
            'end_time' => array('constraint' => 11, 'type' => 'int', 'default' => 0),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
        ), array('id'));
        /*\DBUtil::add_fields('gifts', array(
             'end_time' => array('constraint' => 11, 'type' => 'int', 'default' => 0),
        ));*/
    }

    public function down()
    {
        \DBUtil::drop_table('gifts');
    }
}