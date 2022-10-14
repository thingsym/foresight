<?php
/**
 * Class Test_Setup_Theme
 *
 * @package Foresight
 */

class Test_Setup_Theme extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->theme = new \Foresight\Functions\Setup\Theme();
	}

	/**
	 * @test
	 * @group Theme
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'after_setup_theme', [ $this->theme, 'load_textdomain' ] ) );
		$this->assertSame( 10, has_filter( 'after_setup_theme', [ $this->theme, 'setup' ] ) );
		$this->assertSame( 10, has_filter( 'after_setup_theme', [ $this->theme, 'content_width' ] ) );
		$this->assertSame( 1, has_filter( 'wp_head', [ $this->theme, 'print_meta' ] ) );
		$this->assertSame( 10, has_filter( 'wp_body_open', [ $this->theme, 'add_skip_link' ] ) );
		$this->assertSame( 10, has_filter( 'image_size_names_choose', [ $this->theme, 'add_image_size_option_medium_large' ] ) );
		$this->assertSame( 10, has_filter( 'get_custom_logo_image_attributes', [ $this->theme, 'add_custom_logo_image_attributes' ] ) );
	}

	/**
	 * @test
	 * @group Theme
	 */
	public function theme_setup() {
		// global $l10n;
		// var_dump($l10n);

		// global $_wp_theme_features;
		// var_dump($_wp_theme_features);

		$this->assertTrue( get_theme_support( 'automatic-feed-links' ) );
		$this->assertTrue( get_theme_support( 'title-tag' ) );
		$this->assertTrue( get_theme_support( 'post-thumbnails' ) );
		// $this->assertTrue( get_theme_support( 'html5' ) );
		$this->assertTrue( is_array( get_theme_support( 'custom-background' ) ) );
		$this->assertTrue( is_array( get_theme_support( 'custom-header' ) ) );
		$this->assertTrue( get_theme_support( 'customize-selective-refresh-widgets' ) );
		$this->assertTrue( is_array( get_theme_support( 'custom-logo' ) ) );
		$this->assertTrue( get_theme_support( 'editor-styles' ) );
		$this->assertTrue( get_theme_support( 'wp-block-styles' ) );
		$this->assertTrue( get_theme_support( 'align-wide' ) );
		$this->assertTrue( get_theme_support( 'responsive-embeds' ) );
		$this->assertTrue( get_theme_support( 'custom-line-height' ) );

		// add_post_type_support( 'page', 'excerpt' );

		// global $editor_styles;
		// $this->assertContains( 'css/editor-style.css', $editor_styles );
	}

	/**
	 * @test
	 * @group Theme
	 */
	public function content_width() {
		global $GLOBALS;

		$this->assertArrayHasKey( 'content_width', $GLOBALS );
		$this->assertSame( 1024, $GLOBALS['content_width'] );

		// TODO: check apply_filters 'foresight/functions/setup/content_width'
	}

	/**
	 * @test
	 * @group Theme
	 */
	public function print_meta() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Theme
	 */
	public function add_skip_link() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Theme
	 */
	public function add_custom_logo_image_attributes() {
		$attributes = $this->theme->add_custom_logo_image_attributes();
		$this->assertArrayHasKey( 'loading', $attributes );
		$this->assertSame( 'lazy', $attributes['loading'] );
	}

	/**
	 * @test
	 * @group Theme
	 */
	public function add_image_size_option_medium_large() {
		$imagesizes = $this->theme->add_image_size_option_medium_large( [] );
		$this->assertArrayHasKey( 'medium_large', $imagesizes );
		$this->assertSame( 'Medium Large', $imagesizes['medium_large'] );
	}

	/**
	 * @test
	 * @group Theme
	 */
	public function textdomain() {
		$loaded = $this->theme->load_textdomain();
		$this->assertFalse( $loaded );

		unload_textdomain( 'foresight' );

		add_filter( 'locale', [ $this, '_change_locale' ] );
		add_filter( 'load_textdomain_mofile', [ $this, '_change_textdomain_mofile' ], 10, 2 );

		$loaded = $this->theme->load_textdomain();
		$this->assertTrue( $loaded );

		remove_filter( 'load_textdomain_mofile', [ $this, '_change_textdomain_mofile' ] );
		remove_filter( 'locale', [ $this, '_change_locale' ] );

		unload_textdomain( 'foresight' );
	}

	/**
	 * hook for load_textdomain
	 */
	function _change_locale( $locale ) {
		return 'ja';
	}

	function _change_textdomain_mofile( $mofile, $domain ) {
		if ( $domain === 'foresight' ) {
			$locale = determine_locale();
			$mofile = get_template_directory() . '/languages/' . $locale . '.mo';

			$this->assertSame( $locale, get_locale() );
			$this->assertFileExists( $mofile );
		}

		return $mofile;
	}

}
