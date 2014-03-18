<?php

namespace Fuel\Migrations;

class Add_is_delete_to_invitcodes
{
	public function up()
	{
		\DBUtil::add_fields('invitcodes', array(
			'is_delete' => array('constraint' => 1, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('invitcodes', array(
			'is_delete'

		));
	}
}