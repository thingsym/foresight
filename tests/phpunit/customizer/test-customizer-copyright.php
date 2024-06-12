<?php
/**
 * Class Test_Customizer_Copyright
 *
 * @package Foresight
 */

class Test_Customizer_Copyright extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->copyright = new \Foresight\Functions\Copyright\Copyright();

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

	public function tearDown(): void {
		remove_theme_mod( $this->copyright->options_name );
		parent::tearDown();
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function section() {
		$section = $this->wp_customize->get_section( 'foresight_copyright' );
		$this->assertSame( 'foresight_copyright', $section->id );
		$this->assertSame( 40, $section->priority );
		$this->assertSame( 'layout', $section->panel );
		$this->assertSame( 'edit_theme_options', $section->capability );
		$this->assertSame( 'Copyright', $section->title );
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function control() {
		$setting = $this->wp_customize->get_setting( 'foresight_copyright_options[theme_info]' );
		$this->assertSame( 'foresight_copyright_options[theme_info]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'refresh', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertTrue( $setting->default );
		$this->assertTrue( in_array( 'sanitize_checkbox_boolean', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertTrue( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_copyright_options[theme_info]' );
		$this->assertSame( 'foresight_copyright', $control->section );
		$this->assertSame( 'checkbox', $control->type );
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function save_case_normal() {
		$this->wp_customize->set_post_value( 'foresight_copyright_options[theme_info]', false );
		$setting = $this->wp_customize->get_setting( 'foresight_copyright_options[theme_info]' );
		$setting->save();
		$this->assertFalse( $setting->value() );

		$option = $this->copyright->get_options( 'theme_info' );
		$this->assertFalse( $option );
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function save_case_sanitize_callback() {
		$this->wp_customize->set_post_value( 'foresight_copyright_options[theme_info]', false );
		$setting = $this->wp_customize->get_setting( 'foresight_copyright_options[theme_info]' );
		$setting->save();

		$option = $this->copyright->get_options( 'theme_info' );
		$this->assertFalse( $option );

		$this->wp_customize->set_post_value( 'foresight_copyright_options[theme_info]', 'aaa' );
		$setting = $this->wp_customize->get_setting( 'foresight_copyright_options[theme_info]' );
		$setting->save();
		$this->assertFalse( $setting->value() );

		$option = $this->copyright->get_options( 'theme_info' );
		$this->assertFalse( $option );
	}
}
