<?php
/**
 * Class Test_Color
 *
 * @package Foresight
 */

class Test_Color extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->color = new \Foresight\Functions\Color\Color();
	}

	/**
	 * @test
	 * @group Color
	 */
	public function constructor() {
		$this->assertEquals( 10, has_filter( 'customize_register', [ $this->color, 'customizer' ] ) );
		$this->assertEquals( 10, has_filter( 'wp_enqueue_scripts', [ $this->color, 'enqueue_styles' ] ) );
		$this->assertEquals( 10, has_filter( 'enqueue_block_editor_assets', [ $this->color, 'enqueue_block_editor_styles' ] ) );
	}

	/**
	 * @test
	 * @group Color
	 */
	public function get_default_options() {
		$options = $this->color->get_default_options();
		$this->assertTrue( is_array( $options ) );
	}

	/**
	 * @test
	 * @group Color
	 */
	public function get_options() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Color
	 */
	public function enqueue_styles() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Color
	 */
	public function enqueue_block_editor_styles() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Color
	 */
	public function generate_inline_style() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Copyright
	 */
	public function customizer() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
