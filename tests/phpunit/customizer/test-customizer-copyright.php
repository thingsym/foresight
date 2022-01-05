<?php
/**
 * Class Test_Customizer_Copyright
 *
 * @package Foresight
 */

class Test_Customizer_Copyright extends WP_UnitTestCase {

	public function setUp() {
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

	/**
	 * @test
	 * @group Copyright
	 */
	public function section() {
		$section = $this->wp_customize->get_section( 'foresight_copyright' );
		$this->assertEquals( 'foresight_copyright', $section->id );
		$this->assertEquals( 40, $section->priority );
		$this->assertEquals( 'layout', $section->panel );
		$this->assertEquals( 'edit_theme_options', $section->capability );
		$this->assertEquals( 'Copyright', $section->title );
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function control() {
		$setting = $this->wp_customize->get_setting( 'foresight_copyright_options[copyright]' );
		$this->assertEquals( 'foresight_copyright_options[copyright]', $setting->id );
		$this->assertEquals( 'theme_mod', $setting->type );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertEquals( 'edit_theme_options', $setting->capability );
		$this->assertEquals( 'Copyright &copy; <strong>Test Blog</strong>, All rights reserved.', $setting->default );
		$this->assertEquals( 'wp_kses_post', $setting->sanitize_callback );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEquals( 'Copyright &copy; <strong>Test Blog</strong>, All rights reserved.', $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_copyright_options[copyright]' );
		$this->assertEquals( 'foresight_copyright', $control->section );
		$this->assertEquals( 'textarea', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_copyright_options[theme_info]' );
		$this->assertEquals( 'foresight_copyright_options[theme_info]', $setting->id );
		$this->assertEquals( 'theme_mod', $setting->type );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertEquals( 'edit_theme_options', $setting->capability );
		$this->assertTrue( $setting->default );
		$this->assertTrue( in_array( 'sanitize_checkbox_boolean', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertTrue( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_copyright_options[theme_info]' );
		$this->assertEquals( 'foresight_copyright', $control->section );
		$this->assertEquals( 'checkbox', $control->type );
	}

	/**
	 * @test
	 * @group Copyright
	 */
	function save_case_normal() {
		$this->wp_customize->set_post_value( 'foresight_copyright_options[copyright]', 'aaa' );
		$setting = $this->wp_customize->get_setting( 'foresight_copyright_options[copyright]' );
		$setting->save();
		$this->assertEquals( 'aaa', $setting->value() );

		$option = $this->copyright->get_options( 'copyright' );
		$this->assertEquals( 'aaa', $option );

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
	function save_case_sanitize_callback() {
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
