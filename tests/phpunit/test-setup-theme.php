<?php
/**
 * Class Test_Setup_Theme
 *
 * @package Foresight
 */

class Test_Setup_Theme extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->theme = new \Foresight\Functions\Setup\Theme();
	}

	/**
	 * @test
	 * @group Theme
	 */
	public function constructor() {
		$this->assertEquals( 10, has_filter( 'after_setup_theme', [ $this->theme, 'setup' ] ) );
		$this->assertEquals(10, has_filter( 'after_setup_theme', [ $this->theme, 'content_width' ] ) );
		$this->assertEquals( 1, has_filter( 'wp_head', [ $this->theme, 'print_meta' ] ) );
	}

}
