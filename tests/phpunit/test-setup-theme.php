<?php
/**
 * Class Test_Setup_Theme
 *
 * @package Foresight
 */

class Test_Setup_Theme extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->theme = new \Foresight\Functions\Setup\Theme();
	}

	/**
	 * @test
	 * @group Theme
	 */
	public function constructor() {
		$this->assertEquals( 10, has_filter( 'after_setup_theme', [ $this->theme, 'setup' ] ) );
		$this->assertEquals( 10, has_filter( 'after_setup_theme', [ $this->theme, 'content_width' ] ) );
		$this->assertEquals( 1, has_filter( 'wp_head', [ $this->theme, 'print_meta' ] ) );
		$this->assertEquals( 10, has_filter( 'wp_body_open', [ $this->theme, 'add_skip_link' ] ) );
		$this->assertEquals( 10, has_filter( 'image_size_names_choose', [ $this->theme, 'add_image_size_option_medium_large' ] ) );
		$this->assertEquals( 10, has_filter( 'get_custom_logo_image_attributes', [ $this->theme, 'add_custom_logo_image_attributes' ] ) );
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
		// $this->assertTrue( is_array( get_theme_support( 'html5' ) ) );
		$this->assertTrue( is_array( get_theme_support( 'custom-background' ) ) );
		$this->assertTrue( is_array( get_theme_support( 'custom-header' ) ) );
		$this->assertTrue( get_theme_support( 'customize-selective-refresh-widgets' ) );
		$this->assertTrue( is_array( get_theme_support( 'custom-logo' ) ) );
		$this->assertTrue( get_theme_support( 'editor-styles' ) );
		$this->assertTrue( get_theme_support( 'wp-block-styles' ) );
		$this->assertTrue( get_theme_support( 'align-wide' ) );
		$this->assertTrue( get_theme_support( 'responsive-embeds' ) );

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
		$this->assertEquals( 640, $GLOBALS['content_width'] );

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
		$this->assertEquals( 'lazy', $attributes['loading'] );
	}

	/**
	 * @test
	 * @group Theme
	 */
	public function add_image_size_option_medium_large() {
		$imagesizes = $this->theme->add_image_size_option_medium_large( [] );
		$this->assertArrayHasKey( 'medium_large', $imagesizes );
		$this->assertEquals( 'Medium Large', $imagesizes['medium_large'] );
	}

}
