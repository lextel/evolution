<?php

namespace Fuel\Migrations;

class Create_member_brokerages
{
	public function up()
	{
		\DBUtil::create_table('member_brokerages', array(
			'id' => array('constraint' => 10, 'type' => 'int'),
			'type_id' => array('constraint' => 11, 'type' => 'int', '0' => true),
			'member_id' => array('constraint' => 10, 'type' => 'int'),
			'target_id' => array('constraint' => 10, 'type' => 'int'),
			'points' => array('constraint' => 10, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('member_brokerages');
	}
}