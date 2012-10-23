<?php

class Model_Type extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name',
		'catagory',
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

	protected static $_has_many = array(
		'squares' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Square',
			'key_to' => 'type',
			'cascade_save' => true,
			'cascade_delete' => false,
		),
		'games' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Game',
			'key_to' => 'type',
			'cascade_save' => true,
			'cascade_delete' => false,
		)		
	);
}
