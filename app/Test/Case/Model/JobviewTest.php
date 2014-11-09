<?php
App::uses('Jobview', 'Model');

/**
 * Jobview Test Case
 *
 */
class JobviewTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.jobview'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Jobview = ClassRegistry::init('Jobview');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Jobview);

		parent::tearDown();
	}

}
