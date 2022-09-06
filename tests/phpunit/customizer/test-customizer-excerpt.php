<?php
/**
 * Class Test_Customizer_Excerpt
 *
 * @package Foresight
 */

class Test_Customizer_Excerpt extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->excerpt = new \Foresight\Functions\Excerpt\Excerpt();

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
	 * @group Excerpt
	 */
	public function control() {
		$setting = $this->wp_customize->get_setting( 'foresight_excerpt_options[excerpt_type]' );
		$this->assertSame( 'foresight_excerpt_options[excerpt_type]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'refresh', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertSame( 'fulltext', $setting->default );
		$this->assertTrue( in_array( 'sanitize_radio', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertSame( 'fulltext', $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_excerpt_options[excerpt_type]' );
		$this->assertSame( 'foresight_layout_archive', $control->section );
		$this->assertSame( 'radio', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_excerpt_options[excerpt_length]' );
		$this->assertSame( 'foresight_excerpt_options[excerpt_length]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'refresh', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertSame( 55, $setting->default );
		$this->assertTrue( in_array( 'sanitize_number', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertSame( 55, $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_excerpt_options[excerpt_length]' );
		$this->assertSame( 'foresight_layout_archive', $control->section );
		$this->assertSame( 'number', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_excerpt_options[more_reading_link]' );
		$this->assertSame( 'foresight_excerpt_options[more_reading_link]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'refresh', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertTrue( $setting->default );
		$this->assertTrue( in_array( 'sanitize_checkbox_boolean', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertTrue( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_excerpt_options[more_reading_link]' );
		$this->assertSame( 'foresight_layout_archive', $control->section );
		$this->assertSame( 'checkbox', $control->type );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	function save_case_normal() {
		$this->wp_customize->set_post_value( 'foresight_excerpt_options[excerpt_type]', 'summary' );
		$setting = $this->wp_customize->get_setting( 'foresight_excerpt_options[excerpt_type]' );
		$setting->save();
		$this->assertSame( 'summary', $setting->value() );

		$option = $this->excerpt->get_options( 'excerpt_type' );
		$this->assertSame( 'summary', $option );

		$this->wp_customize->set_post_value( 'foresight_excerpt_options[excerpt_length]', 12 );
		$setting = $this->wp_customize->get_setting( 'foresight_excerpt_options[excerpt_length]' );
		$setting->save();
		$this->assertSame( 12, $setting->value() );

		$option = $this->excerpt->get_options( 'excerpt_length' );
		$this->assertSame( 12, $option );

		$this->wp_customize->set_post_value( 'foresight_excerpt_options[more_reading_link]', false );
		$setting = $this->wp_customize->get_setting( 'foresight_excerpt_options[more_reading_link]' );
		$setting->save();
		$this->assertFalse( $setting->value() );

		$option = $this->excerpt->get_options( 'more_reading_link' );
		$this->assertFalse( $option );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	function save_case_sanitize_callback() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}
}
