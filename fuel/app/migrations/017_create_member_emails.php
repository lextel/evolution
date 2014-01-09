<?php

namespace Fuel\Migrations;

class Create_member_emails
{
	public function up()
	{
		\DBUtil::create_table('member_emails', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'email' => array('constraint' => 255, 'type' => 'varchar'),
			'member_id' => array('constraint' => 11, 'type' => 'int'),
			'key' => array('constraint' => 255, 'type' => 'varchar'),
			'status' => array('constraint' => 11, 'type' => 'int'),
			'type' => array('constraint' => 255, 'type' => 'varchar'),
			'is_delete' => array('constraint' => 11, 'type' => 'int'),
			'deadtime' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('member_emails');
	}
}