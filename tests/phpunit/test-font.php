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
	public function constructor() {
		$this->assertEquals( 10, has_filter( 'customize_register', [ $this->font, 'customizer' ] ) );
		$this->assertEquals( 10, has_filter( 'wp_enqueue_scripts', [ $this->font, 'enqueue_scripts' ] ) );
		$this->assertEquals( 10, has_filter( 'wp_enqueue_scripts', [ $this->font, 'enqueue_styles' ] ) );
		$this->assertEquals( 10, has_filter( 'script_loader_tag', [ $this->font, 'add_defer' ] ) );
	}

	/**
	 * @test
	 * @group Font
	 */
	public function get_options() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Font
	 */
	public function enqueue_styles() {
		$this->font->enqueue_styles();
		$this->assertFalse( wp_style_is( 'fontset-google-fonts' ) );

		$options = array(
			'font_family_base'                   => '',
			'font_family_site_title'             => '',
			'font_family_headings'               => '',
			'fontset_google_fonts'               => 'Roboto',
			'use_fontawesome'                    => false,
		);
		set_theme_mod( 'foresight_font_options', $options );

		$this->font->enqueue_styles();
		$this->assertTrue( wp_style_is( 'fontset-google-fonts' ) );

		// TODO:
	}

	/**
	 * @test
	 * @group Font
	 */
	public function enqueue_scripts() {
		$this->font->enqueue_scripts();
		$this->assertFalse( wp_script_is( 'fontawesome-bundle' ) );

		$options = array(
			'font_family_base'                   => '',
			'font_family_site_title'             => '',
			'font_family_headings'               => '',
			'fontset_google_fonts'               => '',
			'use_fontawesome'                    => true,
		);
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
		$this->assertEquals( ' defer src', $tag );
	}

	/**
	 * @test
	 * @group Font
	 */
	public function customizer() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
