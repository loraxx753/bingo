<?php

namespace Fuel\Migrations;

class Create_types
{
	public function up()
	{
		\DBUtil::create_table('types', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
			'catagory' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
		\DB::query('ALTER TABLE  `squares` ADD  `type` INT NOT NULL AFTER  `value`')->execute();
		\DB::query('ALTER TABLE  `games` ADD  `type` INT NOT NULL AFTER  `chat`')->execute();
	}
	public function down()
	{
		\DBUtil::drop_table('types');
		\DB::query('ALTER TABLE `squares` DROP `type`')->execute();
		\DB::query('ALTER TABLE `games` DROP `type`')->execute();
	}
}