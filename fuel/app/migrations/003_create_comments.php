<?php

namespace Fuel\Migrations;

class Create_comments
{
    public function up()
    {
        \DBUtil::create_table('comments', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'member_id' => array('constraint' => 11, 'type' => 'int'),
            'text' => array('type' => 'text',  'default'=>''),
            'status' => array('constraint' => 11, 'type' => 'int', 'default'=>0),
            'pid' => array('constraint' => 11, 'type' => 'int'),
            'is_deleted' => array('constraint' => 11, 'type' => 'int', 'default'=>0),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

        ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('comments');
    }
}