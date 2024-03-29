<?php

namespace Fuel\Migrations;

class Create_types
{
	public function up()
	{
		\DBUtil::create_table('types', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
			'category' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}
	public function down()
	{
		\DBUtil::drop_table('types');
	}
}