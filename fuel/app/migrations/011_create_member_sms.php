<?php

namespace Fuel\Migrations;

class Create_member_sms
{
    public function up()
    {
        \DBUtil::create_table('member_sms', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'owner_id' => array('constraint' => 11, 'type' => 'int'),
            'title' => array('constraint' => 255, 'type' => 'varchar'),
            'type' => array('constraint' => 255, 'type' => 'varchar'),
            'user_id' => array('constraint' => 11, 'type' => 'int'),
            'user_name' => array('constraint' => 255, 'type' => 'varchar'),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'status' => array('constraint' => 11, 'type' => 'int', 'null' => true),
        ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('member_sms');
    }
}
