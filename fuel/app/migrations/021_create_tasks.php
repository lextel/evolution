<?php

namespace Fuel\Migrations;

class Create_tasks
{
    public function up()
    {
        \DBUtil::create_table('tasks', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'owner_id' => array('constraint' => 11, 'type' => 'int'),
            'user_id' => array('constraint' => 11, 'type' => 'int'),
            'action' => array('constraint' => 255, 'type' => 'varchar'),
            'type_id' => array('constraint' => 2, 'type' => 'int'),
            'is_read' => array('constraint' => 1, 'type' => 'int'),
            'obj_id' => array('constraint' => 11, 'type' => 'int'),
            'status' => array('constraint' => 1, 'type' => 'int'),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

        ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('tasks');
    }
}
