<?php
/**
 * Class Test_Customizer_Emoji
 *
 * @package Emoji
 */

class Test_Customizer_Emoji extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->emoji = new \Foresight\Functions\Emoji\Emoji();

		require_once ABSPATH . WPINC . '/class-wp-customize-manager.php';

		$user_id = self::factory()->user->create( [
			'role' => 'administrator',
		] );

		if ( is_multisite() ) {
			grant_super_admin( $user_id );
		}

		wp_set_current_user( $user_id );

		global $wp_customize;
		$this->wp_customize = new WP_Customize_Manager();
		$wp_customize       = $this->wp_customize;

		do_action( 'customize_register', $this->wp_customize );
	}

	/**
	 * @test
	 * @group Emoji
	 */
	public function section() {
		$section = $this->wp_customize->get_section( 'foresight_emoji' );
		$this->assertSame( 'foresight_emoji', $section->id );
		$this->assertSame( 160, $section->priority );
		$this->assertSame( 'advanced_settings', $section->panel );
		$this->assertSame( 'edit_theme_options', $section->capability );
		$this->assertSame( 'Emoji resource', $section->title );
	}

	/**
	 * @test
	 * @group Emoji
	 */
	public function control() {
		$setting = $this->wp_customize->get_setting( 'foresight_emoji_options[emoji]' );
		$this->assertSame( 'foresight_emoji_options[emoji]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'refresh', $setting->transport );
		$this->assertSame( 'manage_options', $setting->capability );
		$this->assertTrue( $setting->default );
		$this->assertTrue( in_array( 'sanitize_checkbox_boolean', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertTrue( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_emoji_options[emoji]' );
		$this->assertSame( 'foresight_emoji', $control->section );
		$this->assertSame( 'checkbox', $control->type );
	}

	/**
	 * @test
	 * @group Emoji
	 */
	public function save_case_normal() {
		$this->wp_customize->set_post_value( 'foresight_emoji_options[emoji]', true );
		$setting = $this->wp_customize->get_setting( 'foresight_emoji_options[emoji]' );
		$setting->save();
		$this->assertTrue( $setting->value() );

		$option = $this->emoji->get_options( 'emoji' );
		$this->assertTrue( $option );

		$this->wp_customize->set_post_value( 'foresight_emoji_options[emoji]', false );
		$setting = $this->wp_customize->get_setting( 'foresight_emoji_options[emoji]' );
		$setting->save();
		$this->assertFalse( $setting->value() );
	}

	/**
	 * @test
	 * @group Emoji
	 */
	public function save_case_sanitize_callback() {
		$this->wp_customize->set_post_value( 'foresight_emoji_options[emoji]', 'aaa' );
		$setting = $this->wp_customize->get_setting( 'foresight_emoji_options[emoji]' );
		$setting->save();
		$this->assertFalse( $setting->value() );

		$option = $this->emoji->get_options( 'emoji' );
		$this->assertFalse( $option );
	}

}
