<?php

namespace Fuel\Migrations;

class Create_giftcodes
{
    public function up()
    {
        \DBUtil::create_table('giftcodes', array(
            'id' => array('constraint' => 11, 'type' => 'int',  'auto_increment' => true, 'unsigned' => true),
            'member_id' => array('constraint' => 11, 'type' => 'int'),
            'game_id' => array('constraint' => 11, 'type' => 'int'),
            'gift_id' => array('constraint' => 11, 'type' => 'int',  'default'=>0),
            'code' => array('constraint' => 11, 'type' => 'int'),
            'order_id' => array('constraint' => 11, 'type' => 'int'),
            'phase_id' => array('constraint' => 11, 'type' => 'int'),
            'is_delete' => array('constraint' => 4, 'type' => 'int', 'default'=>0),
            'status' => array('constraint' => 4, 'type' => 'int',  'default'=>0),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
        ), array('id'));
    }

    public function down()
    {
        \DBUtil::drop_table('giftcodes');
    }
}