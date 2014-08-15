<?php
App::uses('FilesCopy', 'Model');

/**
 * FilesCopy Test Case
 *
 */
class FilesCopyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.files_copy'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FilesCopy = ClassRegistry::init('FilesCopy');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FilesCopy);

		parent::tearDown();
	}

}
