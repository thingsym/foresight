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
		$this->assertEquals( 10, has_filter( 'customize_controls_print_styles', [ $this->sortable_options, 'customize_control_enqueue_styles' ] ) );
	}

	/**
	 * @test
	 * @group Sortable_Options
	 */
	public function render_content() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Sortable_Options
	 */
	public function sanitize_options() {
		$setting = New WP_Customize_Setting(
			'test',
			'test',
			[]
		);

		$this->assertTrue( is_array( $this->sortable_options->sanitize_options( 'aaa,bbb', $setting ) ) );

		$expected = [ 'aaa','bbb' ];
		$this->assertEquals( $expected, $this->sortable_options->sanitize_options( 'aaa,bbb', $setting ) );

		$this->assertTrue( is_array( $this->sortable_options->sanitize_options( ['aaa', 'bbb'], $setting ) ) );

		$expected = [ 'aaa','bbb' ];
		$this->assertEquals( $expected, $this->sortable_options->sanitize_options( ['aaa', 'bbb'], $setting ) );

		$this->assertTrue( is_array( $this->sortable_options->sanitize_options( '', $setting ) ) );
		$this->assertEquals( [ '' ], $this->sortable_options->sanitize_options( '', $setting ) );

		$this->assertTrue( is_array( $this->sortable_options->sanitize_options( [], $setting ) ) );
		$this->assertEquals( [], $this->sortable_options->sanitize_options( [], $setting ) );
	}

	/**
	 * @test
	 * @group Sortable_Options
	 */
	public function customize_control_enqueue_styles() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
