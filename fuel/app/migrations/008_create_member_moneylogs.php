<?php

namespace Fuel\Migrations;

class Create_member_moneylogs
{
	public function up()
	{
		\DBUtil::create_table('member_moneylogs', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'phase_id' => array('constraint' => 11, 'type' => 'int'),
			'total' => array('constraint' => 11, 'type' => 'int'),
			'sum' => array('constraint' => 11, 'type' => 'int'),
			'type' => array('constraint' => 11, 'type' => 'int'),
			'source' => array('constraint' => 255, 'type' => 'text'),
			'member_id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('member_moneylogs');
	}
}