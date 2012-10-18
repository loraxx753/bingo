<?php

namespace Fuel\Migrations;

class Fill_squares
{
	public function up()
	{
		$query = \DB::insert('squares');

		$query->columns(array(
			'value',
			'created_at'));
		$query->values(array(
			'Says he takes no for answer', time()));
		$query->values(array(
			"Shows Friend's Website", time()));
		$query->values(array(
			'Talks about former student', time()));
		$query->values(array(
			'Says "Expanding young minds"', time()));
		$query->values(array(
			'Says Friends have to eat with him to be friends', time()));
		$query->values(array(
			'Talks down Vegans', time()));
		$query->values(array(
			'Talks about Iceland Trip', time()));
		$query->values(array(
			'Talks about Craft Beer', time()));
		$query->values(array(
			'Drinking Starbucks Coffee', time()));
		$query->values(array(
			'Bothers a Techranger', time()));
		$query->values(array(
			'Talks about being a mechanic', time()));
		$query->values(array(
			'Talks about his search engine', time()));
		$query->values(array(
			'Talks about Ex-Wife', time()));
		$query->values(array(
			'Story about being smarter then other kids in elementary school', time()));
		$query->values(array(
			'Talks about Sulley', time()));
		$query->values(array(
			'Talks about being a vegitarian', time()));
		$query->values(array(
			'Movie Producer Story', time()));
		$query->values(array(
			'Spends more than 10 minutes on a story', time()));
		$query->values(array(
			'Makes a car reference', time()));
		$query->values(array(
			'Talks about multiple degrees', time()));
		$query->values(array(
			'Love for Macs', time()));
		$query->values(array(
			'UCF Policy', time()));
		$query->values(array(
			'Talks about anything on here more than once', time()));
		$query->values(array(
			'Hates Croft', time()));
		$query->values(array(
			'Make yolo insignificant', time()));
		$query->values(array(
			'Says Skynet', time()));
		$query->values(array(
			'Disagree with Dombrowski', time()));
		$query->values(array(
			'Is Pompous', time()));
		$query->values(array(
			'Says his coffee is alcohol', time()));
		$query->values(array(
			'Tells Personal Story', time()));
		$query->values(array(
			'Notified when name appears on internet', time()));
		$query->values(array(
			'Many Tablets', time()));
		$query->values(array(
			'Talks about Daughter', time()));
		$query->values(array(
			'Ignores his mom on the phone', time()));
		$query->values(array(
			'Makes a show out of turning off his cell phone', time()));
		$query->values(array(
			'Says he was a professional gamer', time()));
		$query->values(array(
			'Tells story about his amnesia', time()));
		$query->values(array(
			'STEVE JOBS', time()));
		$query->values(array(
			'Grew up with creator of dungeons and dragons', time()));
		$query->values(array(
			'Talks about DM Page or UCF Reddit', time()));
		$query->execute();

	}

	public function down()
	{
		\DBUtil::truncate_table('squares');
	}
}