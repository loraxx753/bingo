<?php

namespace Fuel\Migrations;

class Fill_squares
{
	public function up()
	{
		$query = \DB::insert('squares');

		$query->columns(array(
			'value',
			'type',
			'created_at'));

		$values = array(
			'Says he takes no for answer',
			"Shows Friend's Website",
			'Talks about former student',
			'Says "Expanding young minds"',
			'Says Friends have to eat with him to be friends',
			'Talks down Vegans',
			'Talks about Iceland Trip',
			'Talks about Craft Beer',
			'Drinking Starbucks Coffee',
			'Bothers a Techranger',
			'Talks about being a mechanic',
			'Talks about his search engine',
			'Talks about Ex-Wife',
			'Story about being smarter then other kids in elementary school',
			'Talks about Sulley',
			'Talks about being a vegitarian',
			'Movie Producer Story',
			'Spends more than 10 minutes on a story',
			'Makes a car reference',
			'Talks about multiple degrees',
			'Love for Macs',
			'UCF Policy',
			'Talks about anything on here more than once',
			'Hates Croft',
			'Make yolo insignificant',
			'Says Skynet',
			'Disagree with Dombrowski',
			'Is Pompous',
			'Says his coffee is alcohol',
			'Tells Personal Story',
			'Notified when name appears on internet',
			'Many Tablets',
			'Talks about Daughter',
			'Ignores his mom on the phone',
			'Makes a show out of turning off his cell phone',
			'Says he was a professional gamer',
			'Tells story about his amnesia',
			'STEVE JOBS',
			'Grew up with creator of dungeons and dragons',
			'Talks about DM Page or UCF Reddit',	
		);
		
		foreach ($values as $value) {
			$query->values(array($value, 1, time()));
		}
			$query->execute();


	}

	public function down()
	{
		\DBUtil::truncate_table('squares');
	}
}