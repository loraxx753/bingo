<?php
return array(
	'_root_'  => 'manager/index',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
	'type/(.*)?' => "/manager/type/$1",
	'category/(.*)?' => "/manager/category/$1",
);