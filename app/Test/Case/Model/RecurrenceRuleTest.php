<?php
App::uses('RecurrenceRule', 'Model');

/**
 * RecurrenceRule Test Case
 *
 */
class RecurrenceRuleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.recurrence_rule',
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
		'app.attendee'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RecurrenceRule = ClassRegistry::init('RecurrenceRule');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RecurrenceRule);

		parent::tearDown();
	}

}
