<?php
/**
 * Class Test_Customize_Control_Image_Picker
 *
 * @package Foresight
 */

class Test_Customize_Control_Image_Picker extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();

		require_once( ABSPATH . WPINC . '/class-wp-customize-setting.php' );
		require_once( ABSPATH . WPINC . '/class-wp-customize-section.php' );
		require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );

		$this->image_picker = new \Foresight\Functions\Customizer\Customize_Control\Image_Picker();
	}

	public function tearDown(): void {
		parent::tearDown();
	}

	/**
	 * @test
	 * @group Image_Picker
	 */
	public function object_attribute() {
		$this->assertObjectHasAttribute( 'type', $this->image_picker );
	}

	/**
	 * @test
	 * @group Image_Picker
	 */
	public function public_variable() {
		$this->assertSame( 'image', $this->image_picker->type );
	}

	/**
	 * @test
	 * @group Image_Picker
	 */
	public function constructor() {
		$this->assertInstanceOf( '\WP_Customize_Image_Control', $this->image_picker );

		$this->assertObjectHasAttribute( 'type', $this->image_picker );
		$this->assertObjectHasAttribute( 'mime_type', $this->image_picker );
	}

}
