<?php
/**
 * Class Test_Setup_Menu
 *
 * @package Ace
 */

class Test_Setup_Menu extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->menu = new \Ace\Functions\Setup\Menu();
	}

	/**
	 * @test
	 * @group Menu
	 */
	public function constructor() {
		$this->assertEquals( 10, has_filter( 'after_setup_theme', array( $this->menu, 'init' ) ) );
	}

}
