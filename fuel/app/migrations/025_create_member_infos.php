<?php

namespace Fuel\Migrations;

class Create_member_infos
{
	public function up()
	{
		\DBUtil::create_table('member_infos', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'uid' => array('constraint' => 11, 'type' => 'int'),
			'nickname' => array('constraint' => 255, 'type' => 'varchar'),
			'local' => array('constraint' => 255, 'type' => 'varchar'),
			'address' => array('constraint' => 255, 'type' => 'varchar'),
			'gender' => array('constraint' => 255, 'type' => 'varchar'),
			'birth' => array('constraint' => 255, 'type' => 'varchar'),
			'qq' => array('constraint' => 255, 'type' => 'varchar'),
			'horoscope' => array('constraint' => 255, 'type' => 'varchar'),
			'salary' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('member_infos');
	}
}