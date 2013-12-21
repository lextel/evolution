<?php

namespace Fuel\Migrations;

class Create_items
{
    public function up()
    {
        \DBUtil::create_table('items', array(
            'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'title' => array('constraint' => 255, 'type' => 'varchar'),
            'image' => array('constraint' => 255, 'type' => 'varchar'),
            'images' => array('type' => 'text'),
            'desc' => array('type' => 'text'),
            'price' => array('constraint' => 11, 'type' => 'int'),
            'cate_id' => array('constraint' => 11, 'type' => 'int'),
            'brand_id' => array('constraint' => 11, 'type' => 'int'),
            'status' => array('constraint' => 11, 'type' => 'int'),
            'is_delete' => array('constraint' => 1, 'type' => 'int'),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

        ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('items');
    }
}
