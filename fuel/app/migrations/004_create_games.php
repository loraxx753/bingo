<?php

namespace Fuel\Migrations;

class Create_games
{
	public function up()
	{
		\DBUtil::create_table('games', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'moves' => array('type' => 'text', 'null' => true),
			'players' => array('type' => 'text'),
			'winner' => array('constraint' => 255, 'type' => 'varchar', 'default' => 'null', 'null' => true),
			'type' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('games');
	}
}