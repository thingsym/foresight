<?php
/**
 * Class Test_Setup_Theme
 *
 * @package Ace
 */

class Test_Setup_Theme extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->theme = new \Ace\Functions\Setup\Theme();
	}

	/**
	 * @test
	 * @group Theme
	 */
	public function constructor() {
		$this->assertEquals( 10, has_filter( 'after_setup_theme', array( $this->theme, 'setup' ) ) );
		$this->assertEquals( 0, has_filter( 'after_setup_theme', array( $this->theme, 'content_width' ) ) );
		$this->assertEquals( 0, has_filter( 'wp_head', array( $this->theme, 'print_meta' ) ) );
	}

}
