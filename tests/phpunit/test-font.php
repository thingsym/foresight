<?php
/**
 * Class Test_Font
 *
 * @package Font
 */

class Test_Font extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->font = new \Foresight\Functions\Font\Font();
	}

	public function tearDown(): void {
		delete_option( $this->font->options_name );
		remove_filter( 'foresight/functions/font/get_option', array( $this, '_filter_option' ) );
		remove_filter( 'foresight/functions/font/get_options', array( $this, '_filter_options' ) );
		parent::tearDown();
	}

	/**
	 * @test
	 * @group Font
	 */
	public function object_attribute() {
		$this->assertObjectHasAttribute( 'section_prefix', $this->font );
		$this->assertObjectHasAttribute( 'options_name', $this->font );
		$this->assertObjectHasAttribute( 'section_priority', $this->font );
		$this->assertObjectHasAttribute( 'capability', $this->font );
		$this->assertObjectHasAttribute( 'default_options', $this->font );
	}

	/**
	 * @test
	 * @group Font
	 */
	public function public_variable() {
		$this->assertSame( 'foresight_font', $this->font->section_prefix );
		$this->assertSame( 'foresight_font_options', $this->font->options_name );
		$this->assertSame( 51, $this->font->section_priority );
		$this->assertSame( 'edit_theme_options', $this->font->capability );

		$expected = [
			'font_feature_settings'  => 'normal',
			'line_break'             => 'auto',
			'font_family_base'       => '',
			'font_family_site_title' => '',
			'font_family_headings'   => '',
		];
		$this->assertSame( $expected, $this->font->default_options );
	}

	/**
	 * @test
	 * @group Font
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'customize_register', [ $this->font, 'customizer' ] ) );
		$this->assertSame( 10, has_filter( 'wp_enqueue_scripts', [ $this->font, 'enqueue_styles' ] ) );
	}

	/**
	 * @test
	 * @group Font
	 */
	public function get_options() {
		$this->assertNull( $this->font->get_options( null, null ) );

		$expected = [
			'font_feature_settings'  => 'normal',
			'line_break'             => 'auto',
			'font_family_base'       => '',
			'font_family_site_title' => '',
			'font_family_headings'   => '',
		];
		$this->assertSame( $expected, $this->font->get_options() );

		$options = [
			'font_feature_settings'  => 'palt',
			'line_break'             => 'normal',
			'font_family_base'       => 'aaa',
			'font_family_site_title' => 'bbb',
			'font_family_headings'   => 'ccc',
		];

		set_theme_mod( $this->font->options_name, $options );

		$options = $this->font->get_options();
		$this->assertSame( 'palt', $options['font_feature_settings'] );
		$this->assertSame( 'normal', $options['line_break'] );
		$this->assertSame( 'aaa', $options['font_family_base'] );
		$this->assertSame( 'bbb', $options['font_family_site_title'] );
		$this->assertSame( 'ccc', $options['font_family_headings'] );
	}

	/**
	 * @test
	 * @group Font
	 */
	public function enqueue_styles() {
		$result = $this->font->enqueue_styles();
		$this->assertFalse( $result );

		$options = [
			'font_feature_settings'  => 'palt',
			'line_break'             => 'auto',
			'font_family_base'       => '',
			'font_family_site_title' => '',
			'font_family_headings'   => '',
		];

		set_theme_mod( $this->font->options_name, $options );

		$result = $this->font->enqueue_styles();
		$this->assertTrue( $result );

		$options = [
			'font_feature_settings'  => 'normal',
			'line_break'             => 'loose',
			'font_family_base'       => '',
			'font_family_site_title' => '',
			'font_family_headings'   => '',
		];

		set_theme_mod( $this->font->options_name, $options );

		$result = $this->font->enqueue_styles();
		$this->assertTrue( $result );

		$options = [
			'font_feature_settings'  => 'normal',
			'line_break'             => 'auto',
			'font_family_base'       => 'Georgia, serif',
			'font_family_site_title' => '',
			'font_family_headings'   => '',
		];

		set_theme_mod( $this->font->options_name, $options );

		$result = $this->font->enqueue_styles();
		$this->assertTrue( $result );

		$options = [
			'font_feature_settings'  => 'normal',
			'line_break'             => 'auto',
			'font_family_base'       => '',
			'font_family_site_title' => 'Georgia, serif',
			'font_family_headings'   => '',
		];

		set_theme_mod( $this->font->options_name, $options );

		$result = $this->font->enqueue_styles();
		$this->assertTrue( $result );

		$options = [
			'font_feature_settings'  => 'normal',
			'line_break'             => 'auto',
			'font_family_base'       => '',
			'font_family_site_title' => '',
			'font_family_headings'   => 'Georgia, serif',
		];

		set_theme_mod( $this->font->options_name, $options );

		$result = $this->font->enqueue_styles();
		$this->assertTrue( $result );

	}

}
