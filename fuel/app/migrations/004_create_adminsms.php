<?php

namespace Fuel\Migrations;

class Create_adminsms
{
	public function up()
	{
		\DBUtil::create_table('adminsms', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'ower_id' => array('constraint' => 11, 'type' => 'int'),
			'action' => array('constraint' => 255, 'type' => 'varchar'),
			'type' => array('constraint' => 255, 'type' => 'varchar'),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'isread' => array('constraint' => 11, 'type' => 'int'),
			'obj_id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('adminsms');
	}
}