<?php
/**
 * Class Test_Customizer_Panel
 *
 * @package Foresight
 */

class Test_Customizer_Panel extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->panel = new \Foresight\Functions\Customizer\Panel();
	}

	/**
	 * @test
	 * @group Customizer_Panel
	 */
	public function constructor() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
