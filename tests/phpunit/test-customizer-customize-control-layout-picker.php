<?php
/**
 * Class Test_Customize_Control_Layout_Picker
 *
 * @package Foresight
 */

class Test_Customize_Control_Layout_Picker extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		require_once( ABSPATH . WPINC . '/class-wp-customize-setting.php' );
		require_once( ABSPATH . WPINC . '/class-wp-customize-section.php' );
		require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );

		$this->layout_picker = new \Foresight\Functions\Customizer\Customize_Control\Layout_Picker();
	}

	/**
	 * @test
	 * @group Layout_Picker
	 */
	public function constructor() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
