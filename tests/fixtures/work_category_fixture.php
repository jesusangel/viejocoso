<?php
/* WorkCategory Fixture generated on: 2011-08-11 00:27:30 : 1313015250 */
class WorkCategoryFixture extends CakeTestFixture {
	var $name = 'WorkCategory';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'lft' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'rght' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'level' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 4),
		'slug' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 150, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'work_count' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'title' => 'Lorem ipsum dolor sit amet',
			'lft' => 1,
			'rght' => 1,
			'level' => 1,
			'slug' => 'Lorem ipsum dolor sit amet',
			'parent_id' => 1,
			'work_count' => 1
		),
	);
}
?>