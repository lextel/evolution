<?php

namespace Fuel\Migrations;

class Create_ads
{
	public function up()
	{
		\DBUtil::create_table('ads', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'title' => array('constraint' => 255, 'type' => 'varchar'),
			'zone' => array('constraint' => 1, 'type' => 'int'),
			'type' => array('constraint' => 1, 'type' => 'int'),
			'sort' => array('constraint' => 3, 'type' => 'int'),
			'start_at' => array('constraint' => 11, 'type' => 'int'),
			'end_at' => array('constraint' => 11, 'type' => 'int'),
			'image' => array('constraint' => 255, 'type' => 'varchar'),
			'link' => array('constraint' => 255, 'type' => 'varchar'),
			'status' => array('constraint' => 1, 'type' => 'int'),
			'is_delete' => array('constraint' => 1, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('ads');
	}
}
