<?php

namespace Fuel\Migrations;

class Create_member_mobiles
{
	public function up()
	{
		\DBUtil::create_table('member_mobiles', array(
			'id' => array('constraint' => 10, 'type' => 'int'),
			'member_id' => array('constraint' => 10, 'type' => 'int', 'varchar' => '6'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('member_mobiles');
	}
}