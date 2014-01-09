<?php

namespace Fuel\Migrations;

class Create_shippings
{
	public function up()
	{
		\DBUtil::create_table('shippings', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'member_id' => array('constraint' => 11, 'type' => 'int'),
			'phase_id' => array('constraint' => 11, 'type' => 'int'),
			'status' => array('constraint' => 11, 'type' => 'int'),
			'excode' => array('constraint' => 11, 'type' => 'int'),
			'exname' => array('constraint' => 255, 'type' => 'varchar'),
			'exdesc' => array('type' => 'text'),
			'admin_id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('shippings');
	}
}