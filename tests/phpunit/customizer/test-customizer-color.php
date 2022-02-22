<?php
/**
 * Class Test_Customizer_Color
 *
 * @package Foresight
 */

class Test_Customizer_Color extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->color = new \Foresight\Functions\Color\Color();

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
	 * @group Color
	 */
	public function control() {
		$setting = $this->wp_customize->get_setting( 'foresight_color_options[header-background-color]' );
		$this->assertSame( 'foresight_color_options[header-background-color]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'postMessage', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertSame( false, $setting->default );
		$this->assertSame( 'sanitize_hex_color_no_hash', $setting->sanitize_callback );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEmpty( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_color_options[header-background-color]' );
		$this->assertSame( 'colors', $control->section );
		$this->assertSame( 'color', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_color_options[footer-background-color]' );
		$this->assertSame( 'foresight_color_options[footer-background-color]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'postMessage', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertSame( false, $setting->default );
		$this->assertSame( 'sanitize_hex_color_no_hash', $setting->sanitize_callback );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEmpty( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_color_options[footer-background-color]' );
		$this->assertSame( 'colors', $control->section );
		$this->assertSame( 'color', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_color_options[primary-color]' );
		$this->assertSame( 'foresight_color_options[primary-color]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'postMessage', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertSame( false, $setting->default );
		$this->assertSame( 'sanitize_hex_color_no_hash', $setting->sanitize_callback );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEmpty( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_color_options[primary-color]' );
		$this->assertSame( 'colors', $control->section );
		$this->assertSame( 'color', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_color_options[secondary-color]' );
		$this->assertSame( 'foresight_color_options[secondary-color]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'postMessage', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertSame( false, $setting->default );
		$this->assertSame( 'sanitize_hex_color_no_hash', $setting->sanitize_callback );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEmpty( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_color_options[secondary-color]' );
		$this->assertSame( 'colors', $control->section );
		$this->assertSame( 'color', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_color_options[header-background-color]' );
		$this->assertSame( 'foresight_color_options[header-background-color]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'postMessage', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertSame( false, $setting->default );
		$this->assertSame( 'sanitize_hex_color_no_hash', $setting->sanitize_callback );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEmpty( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_color_options[header-background-color]' );
		$this->assertSame( 'colors', $control->section );
		$this->assertSame( 'color', $control->type );
	}

	/**
	 * @test
	 * @group Color
	 */
	function save_case_normal() {
		$this->wp_customize->set_post_value( 'foresight_color_options[header-background-color]', 'cccccc' );
		$setting = $this->wp_customize->get_setting( 'foresight_color_options[header-background-color]' );
		$setting->save();
		$this->assertSame( 'cccccc', $setting->value() );

		$option = $this->color->get_options( 'header-background-color' );
		$this->assertSame( 'cccccc', $option );

		$this->wp_customize->set_post_value( 'foresight_color_options[footer-background-color]', 'cccccc' );
		$setting = $this->wp_customize->get_setting( 'foresight_color_options[footer-background-color]' );
		$setting->save();
		$this->assertSame( 'cccccc', $setting->value() );

		$option = $this->color->get_options( 'footer-background-color' );
		$this->assertSame( 'cccccc', $option );

		$this->wp_customize->set_post_value( 'foresight_color_options[primary-color]', 'cccccc' );
		$setting = $this->wp_customize->get_setting( 'foresight_color_options[primary-color]' );
		$setting->save();
		$this->assertSame( 'cccccc', $setting->value() );

		$option = $this->color->get_options( 'primary-color' );
		$this->assertSame( 'cccccc', $option );

		$this->wp_customize->set_post_value( 'foresight_color_options[secondary-color]', 'cccccc' );
		$setting = $this->wp_customize->get_setting( 'foresight_color_options[secondary-color]' );
		$setting->save();
		$this->assertSame( 'cccccc', $setting->value() );

		$option = $this->color->get_options( 'secondary-color' );
		$this->assertSame( 'cccccc', $option );

		$this->wp_customize->set_post_value( 'foresight_color_options[tertiary-color]', 'cccccc' );
		$setting = $this->wp_customize->get_setting( 'foresight_color_options[tertiary-color]' );
		$setting->save();
		$this->assertSame( 'cccccc', $setting->value() );

		$option = $this->color->get_options( 'tertiary-color' );
		$this->assertSame( 'cccccc', $option );
	}

		/**
	 * @test
	 * @group Color
	 */
	function save_case_add_hash() {
		$this->wp_customize->set_post_value( 'foresight_color_options[header-background-color]', '#cccccc' );
		$setting = $this->wp_customize->get_setting( 'foresight_color_options[header-background-color]' );
		$setting->save();
		$this->assertSame( 'cccccc', $setting->value() );

		$option = $this->color->get_options( 'header-background-color' );
		$this->assertSame( 'cccccc', $option );
	}

	/**
	 * @test
	 * @group Color
	 */
	function save_case_no_hex_color() {
		$this->wp_customize->set_post_value( 'foresight_color_options[header-background-color]', 'dddddd' );
		$setting = $this->wp_customize->get_setting( 'foresight_color_options[header-background-color]' );
		$setting->save();

		$this->wp_customize->set_post_value( 'foresight_color_options[header-background-color]', 'xxxxxx' );
		$setting = $this->wp_customize->get_setting( 'foresight_color_options[header-background-color]' );
		$setting->save();
		$this->assertSame( 'dddddd', $setting->value() );

		$option = $this->color->get_options( 'header-background-color' );
		$this->assertSame( 'dddddd', $option );
	}
}
