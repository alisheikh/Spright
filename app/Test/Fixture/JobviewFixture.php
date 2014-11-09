<?php
/**
 * JobviewFixture
 *
 */
class JobviewFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'JobCode' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'SiteCode' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'BuildingCode' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'FloorCode' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'RoomCode' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10, 'unsigned' => false, 'key' => 'primary'),
		'code' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			
		),
		'tableParameters' => array()
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'JobCode' => 1,
			'SiteCode' => 'Lorem ipsum dolor sit amet',
			'BuildingCode' => 'Lorem ipsum dolor sit amet',
			'FloorCode' => 'Lorem ipsum dolor sit amet',
			'RoomCode' => 'Lorem ipsum dolor sit amet',
			'id' => 1,
			'code' => 'Lorem ipsum dolor sit amet'
		),
	);

}
