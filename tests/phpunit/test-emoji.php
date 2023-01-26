<?php
/**
 * Class Test_Emoji
 *
 * @package Emoji
 */

class Test_Emoji extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->emoji = new \Foresight\Functions\Emoji\Emoji();
	}

	/**
	 * @test
	 * @group Emoji
	 */
	public function object_attribute() {
		$this->assertObjectHasAttribute( 'section_id', $this->emoji );
		$this->assertObjectHasAttribute( 'section_priority', $this->emoji );
		$this->assertObjectHasAttribute( 'options_name', $this->emoji );
		$this->assertObjectHasAttribute( 'capability', $this->emoji );
		$this->assertObjectHasAttribute( 'default_options', $this->emoji );
	}

	/**
	 * @test
	 * @group Emoji
	 */
	public function public_variable() {
		$this->assertSame( 'foresight_emoji', $this->emoji->section_id );
		$this->assertSame( 160, $this->emoji->section_priority );
		$this->assertSame( 'foresight_emoji_options', $this->emoji->options_name );
		$this->assertSame( 'manage_options', $this->emoji->capability );

		$expected = [
			'emoji' => true,
		];
		$this->assertSame( $expected, $this->emoji->default_options );
	}

	/**
	 * @test
	 * @group Emoji
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'customize_register', [ $this->emoji, 'customizer' ] ) );
		$this->assertSame( 10, has_filter( 'after_setup_theme', [ $this->emoji, 'init' ] ) );
	}

	/**
	 * @test
	 * @group Emoji
	 */
	public function get_options() {
		$this->assertNull( $this->emoji->get_options( null, null ) );

		$expected = [
			'emoji' => true,
		];
		$this->assertSame( $expected, $this->emoji->get_options() );

		$options = [
			'emoji' => false,
		];

		set_theme_mod( $this->emoji->options_name, $options );

		$options = $this->emoji->get_options();
		$this->assertFalse( $options['emoji'] );
	}

	/**
	 * @test
	 * @group Emoji
	 */
	public function init() {
		$this->emoji->init();

		$this->assertSame( 7, has_filter( 'wp_head', 'print_emoji_detection_script' ) );
		$this->assertSame( 10, has_filter( 'admin_print_scripts', 'print_emoji_detection_script' ) );
		$this->assertSame( 10, has_filter( 'wp_print_styles', 'print_emoji_styles' ) );
		$this->assertSame( 10, has_filter( 'admin_print_styles', 'print_emoji_styles' ) );
		$this->assertSame( 10, has_filter( 'the_content_feed', 'wp_staticize_emoji' ) );
		$this->assertSame( 10, has_filter( 'comment_text_rss', 'wp_staticize_emoji' ) );
		$this->assertSame( 10, has_filter( 'wp_mail', 'wp_staticize_emoji_for_email' ) );

		$options = [
			'emoji' => false,
		];

		set_theme_mod( $this->emoji->options_name, $options );

		$this->emoji->init();

		$this->assertFalse( has_filter( 'wp_head', 'print_emoji_detection_script' ) );
		$this->assertFalse( has_filter( 'admin_print_scripts', 'print_emoji_detection_script' ) );
		$this->assertFalse( has_filter( 'wp_print_styles', 'print_emoji_styles' ) );
		$this->assertFalse( has_filter( 'admin_print_styles', 'print_emoji_styles' ) );
		$this->assertFalse( has_filter( 'the_content_feed', 'wp_staticize_emoji' ) );
		$this->assertFalse( has_filter( 'comment_text_rss', 'wp_staticize_emoji' ) );
		$this->assertFalse( has_filter( 'wp_mail', 'wp_staticize_emoji_for_email' ) );
	}

}
