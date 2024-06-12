<?php
/**
 * Class Test_Copyright
 *
 * @package Foresight
 */

class Test_Copyright extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->copyright = new \Foresight\Functions\Copyright\Copyright();
	}

	public function tearDown(): void {
		remove_theme_mod( $this->copyright->options_name );
		remove_filter( 'foresight/functions/copyright/get_option', array( $this, '_filter_option' ) );
		remove_filter( 'foresight/functions/copyright/get_options', array( $this, '_filter_options' ) );
		parent::tearDown();
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function object_attribute() {
		$this->assertObjectHasAttribute( 'section_id', $this->copyright );
		$this->assertObjectHasAttribute( 'options_name', $this->copyright );
		$this->assertObjectHasAttribute( 'section_priority', $this->copyright );
		$this->assertObjectHasAttribute( 'capability', $this->copyright );
		$this->assertObjectHasAttribute( 'default_options', $this->copyright );
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function public_variable() {
		$this->assertSame( 'foresight_copyright', $this->copyright->section_id );
		$this->assertSame( 'foresight_copyright_options', $this->copyright->options_name );
		$this->assertSame( 40, $this->copyright->section_priority );
		$this->assertSame( 'edit_theme_options', $this->copyright->capability );

		$expected = [
			'theme_info' => true,
		];
		$this->assertSame( $expected, $this->copyright->default_options );
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'customize_register', [ $this->copyright, 'customizer' ] ) );
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function get_options() {
		$this->assertNull( $this->copyright->get_options( null, null ) );

		$expected = [
			'theme_info' => true,
		];
		$this->assertSame( $expected, $this->copyright->get_options() );

		$options = [
			'theme_info' => false,
		];

		set_theme_mod( $this->copyright->options_name, $options );

		$option = $this->copyright->get_options( 'theme_info' );
		$this->assertFalse( $option );
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function has_theme_info() {
		# dafault is true
		$this->assertTrue( $this->copyright->has_theme_info() );

		# false
		$options = [
			'theme_info' => false,
		];
		set_theme_mod( $this->copyright->options_name, $options );

		$this->assertFalse( $this->copyright->has_theme_info() );

		# empty string
		$options = [
			'theme_info' => '',
		];
		set_theme_mod( $this->copyright->options_name, $options );

		$this->assertFalse( $this->copyright->has_theme_info() );

		# null
		$options = [
			'theme_info' => null,
		];
		set_theme_mod( $this->copyright->options_name, $options );

		$this->assertFalse( $this->copyright->has_theme_info() );

		# option nothing, merge default settings
		$options = [];
		set_theme_mod( $this->copyright->options_name, $options );

		$this->assertTrue( $this->copyright->has_theme_info() );
	}
}
