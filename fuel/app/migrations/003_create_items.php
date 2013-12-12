<?php

namespace Fuel\Migrations;

class Create_items
{
	public function up()
	{
		\DBUtil::create_table('items', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'title' => array('constraint' => 255, 'type' => 'varchar'),
			'desc' => array('type' => 'text'),
			'price' => array('constraint' => 11, 'type' => 'int'),
			'cate_id' => array('constraint' => 11, 'type' => 'int'),
			'status' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('items');
	}
}