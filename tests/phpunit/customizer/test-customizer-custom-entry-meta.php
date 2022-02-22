<?php
/**
 * Class Test_Customizer_Custom_Entry_Meta
 *
 * @package Foresight
 */

class Test_Customizer_Custom_Entry_Meta extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->custom_entry_meta = new \Foresight\Functions\Custom_Entry_Meta\Custom_Entry_Meta();

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
	 * @group Custom_Entry_Meta
	 */
	public function section() {
		$section = $this->wp_customize->get_section( 'foresight_entry_meta' );
		$this->assertSame( 'foresight_entry_meta', $section->id );
		$this->assertSame( 20, $section->priority );
		$this->assertSame( 'layout', $section->panel );
		$this->assertSame( 'edit_theme_options', $section->capability );
		$this->assertSame( 'Entry Meta', $section->title );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	public function control() {
		$setting = $this->wp_customize->get_setting( 'foresight_entry_meta_options[header]' );
		$this->assertSame( 'foresight_entry_meta_options[header]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'refresh', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );

		$expected = [
			'postdate',
			'modifieddate',
			'author',
		];
		$this->assertSame( $expected, $setting->default );

		$this->assertTrue( in_array( 'sanitize_options', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertSame( $expected, $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_entry_meta_options[header]' );
		$this->assertSame( 'foresight_entry_meta', $control->section );
		$this->assertSame( 'sortable_multiple_checkbox', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_entry_meta_options[footer]' );
		$this->assertSame( 'foresight_entry_meta_options[footer]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'refresh', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );

		$expected = [
			'category',
			'tag',
			'comment',
			'editpost',
		];
		$this->assertSame( $expected, $setting->default );
		$this->assertTrue( in_array( 'sanitize_options', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertSame( $expected, $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_entry_meta_options[footer]' );
		$this->assertSame( 'foresight_entry_meta', $control->section );
		$this->assertSame( 'sortable_multiple_checkbox', $control->type );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	function save_case_normal() {
		$options = [
			'postdate',
			'comment',
			'editpost',
		];
		$this->wp_customize->set_post_value( 'foresight_entry_meta_options[header]', $options );
		$setting = $this->wp_customize->get_setting( 'foresight_entry_meta_options[header]' );
		$setting->save();

		$expected = [
			'postdate',
			'comment',
			'editpost',
		];
		$this->assertSame( $expected, $setting->value() );

		$option = $this->custom_entry_meta->get_options( 'header' );
		$this->assertSame( $expected, $option );

		$options = [
			'category',
			'tag',
			'modifieddate',
			'author',
		];
		$this->wp_customize->set_post_value( 'foresight_entry_meta_options[footer]', $options );
		$setting = $this->wp_customize->get_setting( 'foresight_entry_meta_options[footer]' );
		$setting->save();

		$expected = [
			'category',
			'tag',
			'modifieddate',
			'author',
		];
		$this->assertSame( $expected, $setting->value() );

		$option = $this->custom_entry_meta->get_options( 'footer' );
		$this->assertSame( $expected, $option );
	}

	/**
	 * @test
	 * @group Custom_Entry_Meta
	 */
	function save_case_sanitize_callback() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}
}
