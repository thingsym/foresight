<?php
/**
 * Class Test_Customizer_Sanitize
 *
 * @package Foresight
 */

class Test_Customizer_Sanitize extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->sanitize = new \Foresight\Functions\Customizer\Sanitize();
	}

	/**
	 * @test
	 * @group Customizer_Sanitize
	 */
	public function constructor() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
