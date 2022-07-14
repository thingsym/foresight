<?php
/**
 * Class Test_Customizer_Font
 *
 * @package Foresight
 */

class Test_Customizer_Font extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->font = new \Foresight\Functions\Font\Font();

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
	 * @group Font
	 */
	public function section() {
		$section = $this->wp_customize->get_section( 'foresight_font_font_basic' );
		$this->assertSame( 'foresight_font_font_basic', $section->id );
		$this->assertSame( 10, $section->priority );
		$this->assertSame( 'font', $section->panel );
		$this->assertSame( 'edit_theme_options', $section->capability );
		$this->assertSame( 'Basic', $section->title );

		$section = $this->wp_customize->get_section( 'foresight_font_font_family' );
		$this->assertSame( 'foresight_font_font_family', $section->id );
		$this->assertSame( 20, $section->priority );
		$this->assertSame( 'font', $section->panel );
		$this->assertSame( 'edit_theme_options', $section->capability );
		$this->assertSame( 'Font Family', $section->title );

		$section = $this->wp_customize->get_section( 'foresight_font_fontset' );
		$this->assertSame( 'foresight_font_fontset', $section->id );
		$this->assertSame( 30, $section->priority );
		$this->assertSame( 'font', $section->panel );
		$this->assertSame( 'edit_theme_options', $section->capability );
		$this->assertSame( 'Font Set', $section->title );
	}

	/**
	 * @test
	 * @group Font
	 */
	public function control() {
		$setting = $this->wp_customize->get_setting( 'foresight_font_options[font_feature_settings]' );
		$this->assertSame( 'foresight_font_options[font_feature_settings]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'refresh', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertSame( 'normal', $setting->default );
		$this->assertTrue( in_array( 'sanitize_select', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertSame( 'normal', $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_font_options[font_feature_settings]' );
		$this->assertSame( 'foresight_font_font_basic', $control->section );
		$this->assertSame( 'select', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_font_options[line_break]' );
		$this->assertSame( 'foresight_font_options[line_break]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'refresh', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertSame( 'auto', $setting->default );
		$this->assertTrue( in_array( 'sanitize_select', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertSame( 'auto', $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_font_options[line_break]' );
		$this->assertSame( 'foresight_font_font_basic', $control->section );
		$this->assertSame( 'select', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_font_options[font_family_base]' );
		$this->assertSame( 'foresight_font_options[font_family_base]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'refresh', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertEmpty( $setting->default );
		$this->assertSame( 'sanitize_text_field', $setting->sanitize_callback );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEmpty( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_font_options[font_family_base]' );
		$this->assertSame( 'foresight_font_font_family', $control->section );
		$this->assertSame( 'text', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_font_options[font_family_site_title]' );
		$this->assertSame( 'foresight_font_options[font_family_site_title]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'refresh', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertEmpty( $setting->default );
		$this->assertSame( 'sanitize_text_field', $setting->sanitize_callback );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEmpty( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_font_options[font_family_site_title]' );
		$this->assertSame( 'foresight_font_font_family', $control->section );
		$this->assertSame( 'text', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_font_options[font_family_headings]' );
		$this->assertSame( 'foresight_font_options[font_family_headings]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'refresh', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertEmpty( $setting->default );
		$this->assertSame( 'sanitize_text_field', $setting->sanitize_callback );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEmpty( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_font_options[font_family_headings]' );
		$this->assertSame( 'foresight_font_font_family', $control->section );
		$this->assertSame( 'text', $control->type );

	}

	/**
	 * @test
	 * @group Font
	 */
	function save_case_normal() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Font
	 */
	function save_case_sanitize_callback() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}
}
