<?php

namespace Fuel\Migrations;

class Create_posts
{
    public function up()
    {
        \DBUtil::create_table('posts', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'title' => array('constraint' => 255, 'type' => 'varchar'),
            'desc' => array('type' => 'text'),
            'status' => array('constraint' => 11, 'type' => 'int'),
            'item_id' => array('constraint' => 11, 'type' => 'int'),
            'user_id' => array('constraint' => 11, 'type' => 'int'),
            'type_id' => array('constraint' => 11, 'type' => 'int'),
            'phase_id' => array('constraint' => 11, 'type' => 'int'),
            'topimage' => array('constraint' => 255, 'type' => 'varchar'),
            'images' => array('constraint' => 255, 'type' => 'varchar'),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

        ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('posts');
    }
}