<?php
/**
 * Class Test_Color
 *
 * @package Foresight
 */

class Test_Color extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->color = new \Foresight\Functions\Color\Color();
		$this->style_script = new \Foresight\Functions\Setup\Style_Script();
	}

	/**
	 * @test
	 * @group Color
	 */
	public function object_attribute() {
		$this->assertObjectHasAttribute( 'section_id', $this->color );
		$this->assertObjectHasAttribute( 'options_name', $this->color );
		$this->assertObjectHasAttribute( 'capability', $this->color );
	}

	/**
	 * @test
	 * @group Color
	 */
	public function public_variable() {
		$this->assertSame( 'colors', $this->color->section_id );
		$this->assertSame( 'foresight_color_options', $this->color->options_name );
		$this->assertSame( 'edit_theme_options', $this->color->capability );
	}

	/**
	 * @test
	 * @group Color
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'customize_register', [ $this->color, 'customizer' ] ) );
		$this->assertSame( 10, has_filter( 'wp_enqueue_scripts', [ $this->color, 'enqueue_styles' ] ) );
		$this->assertSame( 10, has_filter( 'enqueue_block_editor_assets', [ $this->color, 'enqueue_block_editor_styles' ] ) );
	}

	/**
	 * @test
	 * @group Color
	 */
	public function get_default_options() {
		$options = $this->color->get_default_options();
		$this->assertTrue( is_array( $options ) );

		$expected = [
			'header-background-color' => '',
			'footer-background-color' => '',
			'primary-color'           => '',
			'secondary-color'         => '',
			'tertiary-color'          => '',
		];
		$this->assertSame( $expected, $options );
	}

	/**
	 * @test
	 * @group Color
	 */
	public function get_options() {
		$this->assertNull( $this->color->get_options( null, null ) );

		$expected = [
			'header-background-color' => '',
			'footer-background-color' => '',
			'primary-color'           => '',
			'secondary-color'         => '',
			'tertiary-color'          => '',
		];
		$this->assertSame( $expected, $this->color->get_options() );

		$options = [
			'header-background-color' => 'cccccc',
			'footer-background-color' => '',
			'primary-color'           => '',
			'secondary-color'         => '',
			'tertiary-color'          => '',
		];

		set_theme_mod( $this->color->options_name, $options );

		$options = $this->color->get_options();
		$this->assertSame( $options['header-background-color'], 'cccccc' );

		$option = $this->color->get_options( 'header-background-color' );
		$this->assertSame( $option, 'cccccc' );

		$option = $this->color->get_options( 'test' );
		$this->assertSame( $option, null );
	}

	/**
	 * @test
	 * @group Color
	 */
	public function get_options_type_theme_mod() {
		$expected = [
			'header-background-color' => '',
			'footer-background-color' => '',
			'primary-color'           => '',
			'secondary-color'         => '',
			'tertiary-color'          => '',
		];
		$this->assertSame( $expected, $this->color->get_options( null, 'theme_mod' ) );

		$options = [
			'header-background-color' => 'cccccc',
			'footer-background-color' => '',
			'primary-color'           => '',
			'secondary-color'         => '',
			'tertiary-color'          => '',
		];

		set_theme_mod( $this->color->options_name, $options );

		$options = $this->color->get_options( null, 'theme_mod' );
		$this->assertSame( $options['header-background-color'], 'cccccc' );

		$option = $this->color->get_options( 'header-background-color', 'theme_mod'  );
		$this->assertSame( $option, 'cccccc' );

		$option = $this->color->get_options( 'test', 'theme_mod'  );
		$this->assertSame( $option, null );
	}

	/**
	 * @test
	 * @group Color
	 */
	public function get_options_type_option() {
		$expected = [
			'header-background-color' => '',
			'footer-background-color' => '',
			'primary-color'           => '',
			'secondary-color'         => '',
			'tertiary-color'          => '',
		];
		$this->assertSame( $expected, $this->color->get_options( null, 'option' ) );

		$options = [
			'header-background-color' => 'cccccc',
			'footer-background-color' => '',
			'primary-color'           => '',
			'secondary-color'         => '',
			'tertiary-color'          => '',
		];

		update_option( $this->color->options_name, $options );

		$options = $this->color->get_options( null, 'option' );
		$this->assertSame( $options['header-background-color'], 'cccccc' );

		$option = $this->color->get_options( 'header-background-color', 'option'  );
		$this->assertSame( $option, 'cccccc' );

		$option = $this->color->get_options( 'test', 'option'  );
		$this->assertSame( $option, null );
	}
	/**
	 * @test
	 * @group Color
	 */
	public function get_options_case_filter() {
		$options = [
			'header-background-color' => 'cccccc',
			'footer-background-color' => '',
			'primary-color'           => '',
			'secondary-color'         => '',
			'tertiary-color'          => '',
		];

		set_theme_mod( $this->color->options_name, $options );

		add_filter( 'foresight/functions/color/get_options', [ $this, '_filter_options' ], 10, 3 );

		$options = $this->color->get_options();
		$this->assertSame( $options['header-background-color'], 'dddddd' );

		add_filter( 'foresight/functions/color/get_option', [ $this, '_filter_option' ], 10, 4 );

		$option = $this->color->get_options( 'header-background-color' );
		$this->assertSame( $option, 'dddddd' );
	}

	public function _filter_options( $options, $type, $default ) {
		$expected = [
			'header-background-color' => 'cccccc',
			'footer-background-color' => '',
			'primary-color'           => '',
			'secondary-color'         => '',
			'tertiary-color'          => '',
		];
		$this->assertSame( $expected, $options );

		$this->assertSame( 'theme_mod', $type );

		$expected = [
			'header-background-color' => '',
			'footer-background-color' => '',
			'primary-color'           => '',
			'secondary-color'         => '',
			'tertiary-color'          => '',
		];
		$this->assertSame( $expected, $default );

		$options['header-background-color'] = 'dddddd';
		return $options;
	}

	public function _filter_option( $option, $name, $type, $default ) {
		$this->assertSame( $option, 'cccccc' );
		$this->assertSame( $name, 'header-background-color' );
		$this->assertSame( 'theme_mod', $type );

		$expected = [
			'header-background-color' => '',
			'footer-background-color' => '',
			'primary-color'           => '',
			'secondary-color'         => '',
			'tertiary-color'          => '',
		];
		$this->assertSame( $expected, $default );

		$option = 'dddddd';
		return $option;
	}

	/**
	 * @test
	 * @group Color
	 */
	public function enqueue_styles() {
		$this->style_script->enqueue_styles();

		$result = $this->color->enqueue_styles();
		$this->assertTrue( $result );

		set_theme_mod( 'background_color', 'cccccc' );
		$result = $this->color->enqueue_styles();
		$this->assertTrue( $result );

		set_theme_mod( 'background_color', '' );
		set_theme_mod( 'header_textcolor', '' );
		$result = $this->color->enqueue_styles();
		$this->assertFalse( $result );

		remove_theme_mod( 'background_color' );
		remove_theme_mod( 'header_textcolor' );
	}

	/**
	 * @test
	 * @group Color
	 */
	public function enqueue_block_editor_styles() {
		$this->style_script->enqueue_block_editor_styles();

		$result = $this->color->enqueue_block_editor_styles();
		$this->assertTrue( $result );

		set_theme_mod( 'background_color', 'cccccc' );
		$result = $this->color->enqueue_block_editor_styles();
		$this->assertTrue( $result );

		set_theme_mod( 'background_color', '' );
		set_theme_mod( 'header_textcolor', '' );
		$result = $this->color->enqueue_block_editor_styles();
		$this->assertFalse( $result );

		remove_theme_mod( 'background_color' );
		remove_theme_mod( 'header_textcolor' );
	}

	/**
	 * @test
	 * @group Color
	 */
	public function generate_inline_style() {
		$result = $this->color->generate_inline_style();
		$this->assertRegExp( '/--custom-background-color: #ffffff;/', $result );
		$this->assertRegExp( '/--custom-header-text-color: #000000;/', $result );

		set_theme_mod( 'background_color', '' );
		set_theme_mod( 'header_textcolor', '' );
		$result = $this->color->generate_inline_style();
		$this->assertEmpty( $result );

		set_theme_mod( 'background_color', 'cccccc' );
		set_theme_mod( 'header_textcolor', 'dddddd' );
		$result = $this->color->generate_inline_style();
		$this->assertRegExp( '/--custom-background-color: #cccccc;/', $result );
		$this->assertRegExp( '/--custom-header-text-color: #dddddd;/', $result );
		remove_theme_mod( 'background_color' );
		remove_theme_mod( 'header_textcolor' );

		$options = [
			'header-background-color' => 'aaaaaa',
			'footer-background-color' => 'bbbbbb',
			'primary-color'           => 'cccccc',
			'secondary-color'         => 'dddddd',
			'tertiary-color'          => 'eeeeee',
		];

		set_theme_mod( $this->color->options_name, $options );

		$result = $this->color->generate_inline_style();
		$this->assertRegExp( '/--custom-header-background-color: #aaaaaa;/', $result );
		$this->assertRegExp( '/--custom-footer-background-color: #bbbbbb;/', $result );
		$this->assertRegExp( '/--custom-primary-color: #cccccc;/', $result );
		$this->assertRegExp( '/--custom-secondary-color: #dddddd;/', $result );
		$this->assertRegExp( '/--custom-link-text-color: #dddddd;/', $result );
		$this->assertRegExp( '/--custom-tertiary-color: #eeeeee;/', $result );
		$this->assertRegExp( '/--custom-link-text-hover-color: #eeeeee;/', $result );
	}

}
