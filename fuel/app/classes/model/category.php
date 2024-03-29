<?php

class Model_Category extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name',
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
		'types' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Type',
			'key_to' => 'category',
			'cascade_save' => true,
			'cascade_delete' => false,
		),
	);
}
