<?php
/**
 * Class Test_Customize_Control_Image_Picker
 *
 * @package Foresight
 */

class Test_Customize_Control_Image_Picker extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();

		require_once( ABSPATH . WPINC . '/class-wp-customize-setting.php' );
		require_once( ABSPATH . WPINC . '/class-wp-customize-section.php' );
		require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );

		$this->image_picker = new \Foresight\Functions\Customizer\Customize_Control\Image_Picker();
	}

	/**
	 * @test
	 * @group Image_Picker
	 */
	public function public_variable() {
		$this->assertEquals( 'image', $this->image_picker->type );
	}

	/**
	 * @test
	 * @group Image_Picker
	 */
	public function constructor() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
