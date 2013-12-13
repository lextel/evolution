<?php

namespace Fuel\Migrations;

class Create_accounts
{
	public function up()
	{
		\DBUtil::create_table('accounts', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'username' => array('constraint' => 255, 'type' => 'varchar'),
			'password' => array('constraint' => 255, 'type' => 'varchar'),
			'nickname' => array('constraint' => 255, 'type' => 'varchar'),
			'avatar' => array('constraint' => 255, 'type' => 'varchar'),
			'bio' => array('constraint' => 255, 'type' => 'varchar'),
			'mobile' => array('constraint' => 255, 'type' => 'varchar'),
			'points' => array('constraint' => 11, 'type' => 'int'),
			'last_login' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('accounts');
	}
}