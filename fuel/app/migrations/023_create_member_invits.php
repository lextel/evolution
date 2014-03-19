<?php

namespace Fuel\Migrations;

class Create_member_invits
{
	public function up()
	{
		\DBUtil::create_table('member_invits', array(
			'id' => array('constraint' => 10, 'type' => 'int'),
			'memebr_id' => array('constraint' => 10, 'type' => 'int'),
			'invit_id' => array('constraint' => 10, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('member_invits');
	}
}