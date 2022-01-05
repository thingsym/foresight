<?php
/**
 * Class Test_Customizer_Excerpt
 *
 * @package Foresight
 */

class Test_Customizer_Excerpt extends WP_UnitTestCase {

	public function setUp() {
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
		$this->assertEquals( 'foresight_excerpt_options[excerpt_type]', $setting->id );
		$this->assertEquals( 'theme_mod', $setting->type );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertEquals( 'edit_theme_options', $setting->capability );
		$this->assertEquals( 'fulltext', $setting->default );
		$this->assertTrue( in_array( 'sanitize_radio', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEquals( 'fulltext', $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_excerpt_options[excerpt_type]' );
		$this->assertEquals( 'foresight_layout_archive', $control->section );
		$this->assertEquals( 'radio', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_excerpt_options[excerpt_length]' );
		$this->assertEquals( 'foresight_excerpt_options[excerpt_length]', $setting->id );
		$this->assertEquals( 'theme_mod', $setting->type );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertEquals( 'edit_theme_options', $setting->capability );
		$this->assertEquals( 55, $setting->default );
		$this->assertTrue( in_array( 'sanitize_number', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEquals( 55, $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_excerpt_options[excerpt_length]' );
		$this->assertEquals( 'foresight_layout_archive', $control->section );
		$this->assertEquals( 'number', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_excerpt_options[more_reading_link]' );
		$this->assertEquals( 'foresight_excerpt_options[more_reading_link]', $setting->id );
		$this->assertEquals( 'theme_mod', $setting->type );
		$this->assertEquals( 'refresh', $setting->transport );
		$this->assertEquals( 'edit_theme_options', $setting->capability );
		$this->assertTrue( $setting->default );
		$this->assertTrue( in_array( 'sanitize_checkbox_boolean', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertTrue( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_excerpt_options[more_reading_link]' );
		$this->assertEquals( 'foresight_layout_archive', $control->section );
		$this->assertEquals( 'checkbox', $control->type );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	function save_case_normal() {
		$this->wp_customize->set_post_value( 'foresight_excerpt_options[excerpt_type]', 'summary' );
		$setting = $this->wp_customize->get_setting( 'foresight_excerpt_options[excerpt_type]' );
		$setting->save();
		$this->assertEquals( 'summary', $setting->value() );

		$option = $this->excerpt->get_options( 'excerpt_type' );
		$this->assertEquals( 'summary', $option );

		$this->wp_customize->set_post_value( 'foresight_excerpt_options[excerpt_length]', 12 );
		$setting = $this->wp_customize->get_setting( 'foresight_excerpt_options[excerpt_length]' );
		$setting->save();
		$this->assertEquals( 12, $setting->value() );

		$option = $this->excerpt->get_options( 'excerpt_length' );
		$this->assertEquals( 12, $option );

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
