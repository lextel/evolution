<?php

namespace Fuel\Migrations;

class Create_member_addresses
{
	public function up()
	{
		\DBUtil::create_table('member_addresses', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'uid' => array('constraint' => 11, 'type' => 'int'),
			'postcode' => array('constraint' => 255, 'type' => 'varchar'),
			'address' => array('constraint' => 255, 'type' => 'varchar'),
			'mobile' => array('constraint' => 255, 'type' => 'varchar'),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('member_addresses');
	}
}