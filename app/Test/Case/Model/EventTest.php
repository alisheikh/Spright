<?php
App::uses('Event', 'Model');

/**
 * Event Test Case
 *
 */
class EventTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.event',
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
		'app.attendee',
		'app.recurrence_rule'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Event = ClassRegistry::init('Event');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Event);

		parent::tearDown();
	}

}
