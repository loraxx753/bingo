<?php

class Model_Game extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'players',
		'creator',
		'moves',
		'winner',
		'chat',
		'type',
		'created_at',
		'updated_at'
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);
	
	protected static $_belongs_to = array(
		'type' => array(
			'key_from' => 'type',
			'model_to' => 'Model_Type',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);
	protected static $_has_one = array(
		'parent' => array(
			'key_from' => 'type',
			'model_to' => 'Model_Type',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);
}
