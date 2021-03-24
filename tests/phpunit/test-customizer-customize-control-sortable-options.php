<?php
/**
 * Class Test_Customize_Control_Sortable_Options
 *
 * @package Foresight
 */

class Test_Customize_Control_Sortable_Options extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		require_once( ABSPATH . WPINC . '/class-wp-customize-setting.php' );
		require_once( ABSPATH . WPINC . '/class-wp-customize-section.php' );
		require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );

		$this->sortable_options = new \Foresight\Functions\Customizer\Customize_Control\Sortable_Options();
	}

	/**
	 * @test
	 * @group Sortable_Options
	 */
	public function constructor() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
