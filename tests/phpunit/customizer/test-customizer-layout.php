<?php
/**
 * Class Test_Customizer_Layout
 *
 * @package Foresight
 */

class Test_Customizer_Layout extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->layout = new \Foresight\Functions\Layout\Layout();

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
		remove_theme_mod( $this->layout->options_name );
		parent::tearDown();
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function section() {
		$section = $this->wp_customize->get_section( 'foresight_layout_archive' );
		$this->assertSame( 'foresight_layout_archive', $section->id );
		$this->assertSame( 10, $section->priority );
		$this->assertSame( 'layout', $section->panel );
		$this->assertSame( 'edit_theme_options', $section->capability );
		$this->assertSame( 'Archive', $section->title );

		$section = $this->wp_customize->get_section( 'foresight_layout_footer' );
		$this->assertSame( 'foresight_layout_footer', $section->id );
		$this->assertSame( 30, $section->priority );
		$this->assertSame( 'layout', $section->panel );
		$this->assertSame( 'edit_theme_options', $section->capability );
		$this->assertSame( 'Footer', $section->title );
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function control() {
		$setting = $this->wp_customize->get_setting( 'foresight_layout_options[archive_sidebar]' );
		$this->assertSame( 'foresight_layout_options[archive_sidebar]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'refresh', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertFalse( $setting->default );
		$this->assertTrue( in_array( 'sanitize_checkbox_boolean', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertFalse( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_layout_options[archive_sidebar]' );
		$this->assertSame( 'foresight_layout_archive', $control->section );
		$this->assertSame( 'checkbox', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_layout_options[archive]' );
		$this->assertSame( 'foresight_layout_options[archive]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'refresh', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertSame( 'article-all', $setting->default );
		$this->assertTrue( in_array( 'sanitize_layout', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertSame( 'article-all', $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_layout_options[archive]' );
		$this->assertSame( 'foresight_layout_archive', $control->section );
		$this->assertSame( 'layout', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_layout_options[archive_image]' );
		$this->assertSame( 'foresight_layout_options[archive_image]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'refresh', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertEmpty( $setting->default );
		$this->assertTrue( in_array( 'sanitize_number', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertEmpty( $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_layout_options[archive_image]' );
		$this->assertSame( 'foresight_layout_archive', $control->section );
		$this->assertSame( 'media', $control->type );

		$setting = $this->wp_customize->get_setting( 'foresight_layout_options[footer_area_column_ratio]' );
		$this->assertSame( 'foresight_layout_options[footer_area_column_ratio]', $setting->id );
		$this->assertSame( 'theme_mod', $setting->type );
		$this->assertSame( 'refresh', $setting->transport );
		$this->assertSame( 'edit_theme_options', $setting->capability );
		$this->assertSame( 'one-to-one', $setting->default );
		$this->assertTrue( in_array( 'sanitize_layout', $setting->sanitize_callback ) );
		$this->assertSame( 10, has_filter( "customize_sanitize_{$setting->id}", $setting->sanitize_callback ) );

		$this->assertSame( 'one-to-one', $setting->value() );

		$control = $this->wp_customize->get_control( 'foresight_layout_options[footer_area_column_ratio]' );
		$this->assertSame( 'foresight_layout_footer', $control->section );
		$this->assertSame( 'layout', $control->type );

	}

	/**
	 * @test
	 * @group Layout
	 */
	public function save_case_normal() {
		$this->wp_customize->set_post_value( 'foresight_layout_options[archive_sidebar]', true );
		$setting = $this->wp_customize->get_setting( 'foresight_layout_options[archive_sidebar]' );
		$setting->save();
		$this->assertTrue( $setting->value() );

		$option = $this->layout->get_options( 'archive_sidebar' );
		$this->assertTrue( $option );

		$this->wp_customize->set_post_value( 'foresight_layout_options[archive]', 'article-all' );
		$setting = $this->wp_customize->get_setting( 'foresight_layout_options[archive]' );
		$setting->save();
		$this->assertSame( 'article-all', $setting->value() );

		$option = $this->layout->get_options( 'archive' );
		$this->assertSame( 'article-all', $option );

		$this->wp_customize->set_post_value( 'foresight_layout_options[archive_image]', 193 );
		$setting = $this->wp_customize->get_setting( 'foresight_layout_options[archive_image]' );
		$setting->save();
		$this->assertSame( 193, $setting->value() );

		$option = $this->layout->get_options( 'archive_image' );
		$this->assertSame( 193, $option );

		$this->wp_customize->set_post_value( 'foresight_layout_options[footer_area_column_ratio]', 'one-to-one' );
		$setting = $this->wp_customize->get_setting( 'foresight_layout_options[footer_area_column_ratio]' );
		$setting->save();
		$this->assertSame( 'one-to-one', $setting->value() );

		$option = $this->layout->get_options( 'footer_area_column_ratio' );
		$this->assertSame( 'one-to-one', $option );

	}

	/**
	 * @test
	 * @group Layout
	 */
	public function save_case_sanitize_callback() {
		$this->wp_customize->set_post_value( 'foresight_layout_options[archive_sidebar]', 'aaa' );
		$setting = $this->wp_customize->get_setting( 'foresight_layout_options[archive_sidebar]' );
		$setting->save();
		$this->assertFalse( $setting->value() );

		$option = $this->layout->get_options( 'archive_sidebar' );
		$this->assertFalse( $option );
	}
}
