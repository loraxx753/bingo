<?php

namespace Fuel\Migrations;

class Create_squares
{
	public function up()
	{
		\DBUtil::create_table('squares', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'value' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('squares');
	}
}