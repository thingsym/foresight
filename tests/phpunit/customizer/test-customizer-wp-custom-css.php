<?php
/**
 * Class Test_Customizer_Wp_Custom_Css
 *
 * @package Wp_Custom_Css
 */

class Test_Customizer_Wp_Custom_Css extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->wp_custom_css = new \Foresight\Functions\Wp_Custom_Css\Wp_Custom_Css();

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
	 * @group Wp_Custom_Css
	 */
	public function control() {
		$setting = $this->wp_customize->get_setting( 'foresight_wp_custom_css_options[footer]' );
		$this->assertSame( 'foresight_wp_custom_css_options[footer]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'refresh', $setting->transport );
		$this->assertSame( 'manage_options', $setting->capability );
		$this->assertFalse( $setting->default );
		$this->assertTrue( in_array( 'sanitize_checkbox_boolean', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertFalse( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_wp_custom_css_options[footer]' );
		$this->assertSame( 'custom_css', $control->section );
		$this->assertSame( 'checkbox', $control->type );
	}

	/**
	 * @test
	 * @group Wp_Custom_Css
	 */
	public function save_case_normal() {
		$this->wp_customize->set_post_value( 'foresight_wp_custom_css_options[footer]', true );
		$setting = $this->wp_customize->get_setting( 'foresight_wp_custom_css_options[footer]' );
		$setting->save();
		$this->assertTrue( $setting->value() );

		$option = $this->wp_custom_css->get_options( 'footer' );
		$this->assertTrue( $option );

		$this->wp_customize->set_post_value( 'foresight_wp_custom_css_options[footer]', false );
		$setting = $this->wp_customize->get_setting( 'foresight_wp_custom_css_options[footer]' );
		$setting->save();
		$this->assertFalse( $setting->value() );
	}

	/**
	 * @test
	 * @group Wp_Custom_Css
	 */
	public function save_case_sanitize_callback() {
		$this->wp_customize->set_post_value( 'foresight_wp_custom_css_options[footer]', 'aaa' );
		$setting = $this->wp_customize->get_setting( 'foresight_wp_custom_css_options[footer]' );
		$setting->save();
		$this->assertFalse( $setting->value() );

		$option = $this->wp_custom_css->get_options( 'footer' );
		$this->assertFalse( $option );
	}

}
