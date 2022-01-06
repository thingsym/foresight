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
		$this->assertEquals( 'foresight_font_font_basic', $section->id );
		$this->assertEquals( 10, $section->priority );
		$this->assertEquals( 'font', $section->panel );
		$this->assertEquals( 'edit_theme_options', $section->capability );
		$this->assertEquals( 'Basic', $section->title );

		$section = $this->wp_customize->get_section( 'foresight_font_font_family' );
		$this->assertEquals( 'foresight_font_font_family', $section->id );
		$this->assertEquals( 20, $section->priority );
		$this->assertEquals( 'font', $section->panel );
		$this->assertEquals( 'edit_theme_options', $section->capability );
		$this->assertEquals( 'Font Family', $section->title );

		$section = $this->wp_customize->get_section( 'foresight_font_fontset' );
		$this->assertEquals( 'foresight_font_fontset', $section->id );
		$this->assertEquals( 30, $section->priority );
		$this->assertEquals( 'font', $section->panel );
		$this->assertEquals( 'edit_theme_options', $section->capability );
		$this->assertEquals( 'Font Set', $section->title );

		$section = $this->wp_customize->get_section( 'foresight_font_icon_font' );
		$this->assertEquals( 'foresight_font_icon_font', $section->id );
		$this->assertEquals( 40, $section->priority );
		$this->assertEquals( 'font', $section->panel );
		$this->assertEquals( 'edit_theme_options', $section->capability );
		$this->assertEquals( 'Icon Font', $section->title );
	}

	/**
	 * @test
	 * @group Font
	 */
	public function control() {
		$setting = $this->wp_customize->get_setting( 'foresight_font_options[font_feature_settings]' );
		$this->assertEquals( 'foresight_font_options[font_feature_settings]', $setting->id );
		$this->assertEquals( 'theme_mod', $setting->type );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertEquals( 'edit_theme_options', $setting->capability );
		$this->assertEquals( 'normal', $setting->default );
		$this->assertTrue( in_array( 'sanitize_select', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEquals( 'normal', $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_font_options[font_feature_settings]' );
		$this->assertEquals( 'foresight_font_font_basic', $control->section );
		$this->assertEquals( 'select', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_font_options[line_break]' );
		$this->assertEquals( 'foresight_font_options[line_break]', $setting->id );
		$this->assertEquals( 'theme_mod', $setting->type );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertEquals( 'edit_theme_options', $setting->capability );
		$this->assertEquals( 'auto', $setting->default );
		$this->assertTrue( in_array( 'sanitize_select', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEquals( 'auto', $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_font_options[line_break]' );
		$this->assertEquals( 'foresight_font_font_basic', $control->section );
		$this->assertEquals( 'select', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_font_options[font_family_base]' );
		$this->assertEquals( 'foresight_font_options[font_family_base]', $setting->id );
		$this->assertEquals( 'theme_mod', $setting->type );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertEquals( 'edit_theme_options', $setting->capability );
		$this->assertEmpty( $setting->default );
		$this->assertEquals( 'sanitize_text_field', $setting->sanitize_callback );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEmpty( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_font_options[font_family_base]' );
		$this->assertEquals( 'foresight_font_font_family', $control->section );
		$this->assertEquals( 'text', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_font_options[font_family_site_title]' );
		$this->assertEquals( 'foresight_font_options[font_family_site_title]', $setting->id );
		$this->assertEquals( 'theme_mod', $setting->type );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertEquals( 'edit_theme_options', $setting->capability );
		$this->assertEmpty( $setting->default );
		$this->assertEquals( 'sanitize_text_field', $setting->sanitize_callback );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEmpty( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_font_options[font_family_site_title]' );
		$this->assertEquals( 'foresight_font_font_family', $control->section );
		$this->assertEquals( 'text', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_font_options[font_family_headings]' );
		$this->assertEquals( 'foresight_font_options[font_family_headings]', $setting->id );
		$this->assertEquals( 'theme_mod', $setting->type );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertEquals( 'edit_theme_options', $setting->capability );
		$this->assertEmpty( $setting->default );
		$this->assertEquals( 'sanitize_text_field', $setting->sanitize_callback );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEmpty( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_font_options[font_family_headings]' );
		$this->assertEquals( 'foresight_font_font_family', $control->section );
		$this->assertEquals( 'text', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_font_options[fontset_google_fonts]' );
		$this->assertEquals( 'foresight_font_options[fontset_google_fonts]', $setting->id );
		$this->assertEquals( 'theme_mod', $setting->type );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertEquals( 'edit_theme_options', $setting->capability );
		$this->assertEmpty( $setting->default );
		$this->assertEquals( 'sanitize_text_field', $setting->sanitize_callback );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEmpty( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_font_options[fontset_google_fonts]' );
		$this->assertEquals( 'foresight_font_fontset', $control->section );
		$this->assertEquals( 'text', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_font_options[use_fontawesome]' );
		$this->assertEquals( 'foresight_font_options[use_fontawesome]', $setting->id );
		$this->assertEquals( 'theme_mod', $setting->type );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertEquals( 'edit_theme_options', $setting->capability );
		$this->assertFalse( $setting->default );
		$this->assertTrue( in_array( 'sanitize_checkbox_boolean', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertFalse( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_font_options[use_fontawesome]' );
		$this->assertEquals( 'foresight_font_icon_font', $control->section );
		$this->assertEquals( 'checkbox', $control->type );
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
