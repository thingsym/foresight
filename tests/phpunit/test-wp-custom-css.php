<?php
/**
 * Class Test_Wp_Custom_Css
 *
 * @package Wp_Custom_Css
 */

class Test_Wp_Custom_Css extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->wp_custom_css = new \Foresight\Functions\Wp_Custom_Css\Wp_Custom_Css();
	}

	/**
	 * @test
	 * @group Wp_Custom_Css
	 */
	public function object_attribute() {
		$this->assertObjectHasAttribute( 'section_id', $this->wp_custom_css );
		$this->assertObjectHasAttribute( 'options_name', $this->wp_custom_css );
		$this->assertObjectHasAttribute( 'capability', $this->wp_custom_css );
		$this->assertObjectHasAttribute( 'default_options', $this->wp_custom_css );
	}

	/**
	 * @test
	 * @group Wp_Custom_Css
	 */
	public function public_variable() {
		$this->assertSame( 'custom_css', $this->wp_custom_css->section_id );
		$this->assertSame( 'foresight_wp_custom_css_options', $this->wp_custom_css->options_name );
		$this->assertSame( 'manage_options', $this->wp_custom_css->capability );

		$expected = [
			'footer' => false,
		];
		$this->assertSame( $expected, $this->wp_custom_css->default_options );
	}

	/**
	 * @test
	 * @group Wp_Custom_Css
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'customize_register', [ $this->wp_custom_css, 'customizer' ] ) );
		$this->assertSame( 10, has_filter( 'after_setup_theme', [ $this->wp_custom_css, 'init' ] ) );
		$this->assertSame( 10, has_filter( 'customize_controls_print_styles', [ $this->wp_custom_css, 'customize_control_enqueue_styles' ] ) );
	}

	/**
	 * @test
	 * @group Emoji
	 */
	public function get_options() {
		$this->assertNull( $this->wp_custom_css->get_options( null, null ) );

		$expected = [
			'footer' => false,
		];
		$this->assertSame( $expected, $this->wp_custom_css->get_options() );

		$options = [
			'footer' => true,
		];

		set_theme_mod( $this->wp_custom_css->options_name, $options );

		$options = $this->wp_custom_css->get_options();
		$this->assertTrue( $options['footer'] );
	}

	/**
	 * @test
	 * @group Wp_Custom_Css
	 */
	public function init() {
		$this->assertSame( 101, has_filter( 'wp_head', 'wp_custom_css_cb' ) );
		$this->assertFalse( has_filter( 'wp_footer', 'wp_custom_css_cb' ) );

		$options = [
			'footer' => true,
		];

		set_theme_mod( $this->wp_custom_css->options_name, $options );

		$this->wp_custom_css->init();

		$this->assertFalse( has_filter( 'wp_head', 'wp_custom_css_cb' ) );
		$this->assertSame( 9999, has_filter( 'wp_footer', 'wp_custom_css_cb' ) );
	}

	/**
	 * @test
	 * @group Wp_Custom_Css
	 */
	public function customize_control_enqueue_styles() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
