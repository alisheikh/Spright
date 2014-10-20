<?php
App::uses('Calendar', 'Model');

/**
 * Calendar Test Case
 *
 */
class CalendarTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.calendar',
		'app.user',
		'app.group',
		'app.job',
		'app.jobtype',
		'app.room',
		'app.building',
		'app.department',
		'app.floor',
		'app.roomtype',
		'app.statustype',
		'app.task',
		'app.joblog',
		'app.event'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Calendar = ClassRegistry::init('Calendar');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Calendar);

		parent::tearDown();
	}

}
