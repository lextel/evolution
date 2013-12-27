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
            'status' => array('constraint' => 11, 'type' => 'int', 'default' => '0'),
            'item_id' => array('constraint' => 11, 'type' => 'int'),
            'member_id' => array('constraint' => 11, 'type' => 'int'),
            'type_id' => array('constraint' => 11, 'type' => 'int'),
            'phase_id' => array('constraint' => 11, 'type' => 'int'),
            'lottery_id' => array('constraint' => 11, 'type' => 'int'),
            'topimage' => array('constraint' => 255, 'type' => 'varchar'),
            'images' => array('constraint' => 255, 'type' => 'varchar'),
            'up' => array('constraint' => 11, 'type' => 'int', 'default' => '0'),
            'comment_count' => array('constraint' => 11, 'type' => 'int', 'default' => '0'),
            'comment_top' => array('constraint' => 11, 'type' => 'int', 'default' => '0'),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'is_delete' => array('constraint' => 11, 'type' => 'int', 'default' => '0')
        ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('posts');
    }
}