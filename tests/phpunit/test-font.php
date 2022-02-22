<?php
/**
 * Class Test_Font
 *
 * @package Font
 */

class Test_Font extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->font = new \Foresight\Functions\Font\Font();
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
			'fontset_google_fonts'   => '',
			'use_fontawesome'        => false,
		];
		$this->assertSame( $expected, $this->font->default_options );
	}

	/**
	 * @test
	 * @group Font
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'customize_register', [ $this->font, 'customizer' ] ) );
		$this->assertSame( 10, has_filter( 'wp_enqueue_scripts', [ $this->font, 'enqueue_scripts' ] ) );
		$this->assertSame( 10, has_filter( 'wp_enqueue_scripts', [ $this->font, 'enqueue_styles' ] ) );
		$this->assertSame( 10, has_filter( 'script_loader_tag', [ $this->font, 'add_defer' ] ) );
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
			'fontset_google_fonts'   => '',
			'use_fontawesome'        => false,
		];
		$this->assertSame( $expected, $this->font->get_options() );

		$options = [
			'font_feature_settings'  => 'palt',
			'line_break'             => 'normal',
			'font_family_base'       => 'aaa',
			'font_family_site_title' => 'bbb',
			'font_family_headings'   => 'ccc',
			'fontset_google_fonts'   => 'ddd',
			'use_fontawesome'        => true,
		];

		set_theme_mod( $this->font->options_name, $options );

		$options = $this->font->get_options();
		$this->assertSame( 'palt', $options['font_feature_settings'] );
		$this->assertSame( 'normal', $options['line_break'] );
		$this->assertSame( 'aaa', $options['font_family_base'] );
		$this->assertSame( 'bbb', $options['font_family_site_title'] );
		$this->assertSame( 'ccc', $options['font_family_headings'] );
		$this->assertSame( 'ddd', $options['fontset_google_fonts'] );
		$this->assertTrue( $options['use_fontawesome'] );
	}

	/**
	 * @test
	 * @group Font
	 */
	public function enqueue_styles() {
		$this->font->enqueue_styles();
		$this->assertFalse( wp_style_is( 'fontset-google-fonts' ) );

		$options = [
			'font_feature_settings'  => 'normal',
			'line_break'             => 'auto',
			'font_family_base'       => '',
			'font_family_site_title' => '',
			'font_family_headings'   => '',
			'fontset_google_fonts'   => 'Roboto',
			'use_fontawesome'        => false,
		];
		set_theme_mod( 'foresight_font_options', $options );

		$this->font->enqueue_styles();
		$this->assertTrue( wp_style_is( 'fontset-google-fonts' ) );
	}

	/**
	 * @test
	 * @group Font
	 */
	public function enqueue_scripts() {
		$this->font->enqueue_scripts();
		$this->assertFalse( wp_script_is( 'fontawesome-bundle' ) );

		$options = [
			'font_feature_settings'  => 'normal',
			'line_break'             => 'auto',
			'font_family_base'       => '',
			'font_family_site_title' => '',
			'font_family_headings'   => '',
			'fontset_google_fonts'   => '',
			'use_fontawesome'        => true,
		];
		set_theme_mod( 'foresight_font_options', $options );

		$this->font->enqueue_scripts();
		$this->assertTrue( wp_script_is( 'fontawesome-bundle' ) );
	}

	/**
	 * @test
	 * @group Font
	 */
	public function add_defer() {
		$tag = $this->font->add_defer( ' src', 'fontawesome-bundle' );
		$this->assertSame( ' defer src', $tag );
	}

}
