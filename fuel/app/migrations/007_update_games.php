<?php

namespace Fuel\Migrations;

class Update_games
{
	public function up()
	{
		\DB::query('ALTER TABLE  `games` ADD  `creator` VARCHAR(100) NOT NULL AFTER  `players`')->execute();
		\DB::query('ALTER TABLE  `games` ADD  `name` INT NOT NULL AFTER  `id`')->execute();
	}
	public function down()
	{
		\DB::query('ALTER TABLE `games` DROP `creator`')->execute();
		\DB::query('ALTER TABLE `games` DROP `name`')->execute();
	}
}