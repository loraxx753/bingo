<?php

namespace Fuel\Migrations;

class Add_chat
{
	public function up()
	{
		\DB::query("ALTER TABLE  `games` ADD  `chat` LONGTEXT NULL DEFAULT NULL AFTER  `winner`
")->execute();
	}
	public function down()
	{
		\DB::query("ALTER TABLE `games` DROP `chat`")->execute();
	}
}


