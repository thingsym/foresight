<?php
/**
 * Class Test_Setup_Widget
 *
 * @package Foresight
 */

class Test_Setup_Widget extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->widget = new \Foresight\Functions\Setup\Widget();
	}

	/**
	 * @test
	 * @group Widget
	 */
	public function constructor() {
		$this->assertEquals( 10, has_filter( 'widgets_init', array( $this->widget, 'init' ) ) );
	}

}
