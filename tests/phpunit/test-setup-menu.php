<?php
/**
 * Class Test_Setup_Menu
 *
 * @package Foresight
 */

class Test_Setup_Menu extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->menu = new \Foresight\Functions\Setup\Menu();
	}

	/**
	 * @test
	 * @group Menu
	 */
	public function constructor() {
		$this->assertEquals( 10, has_filter( 'after_setup_theme', [ $this->menu, 'init' ] ) );
	}

	/**
	 * @test
	 * @group Menu
	 */
	public function init() {
		$menus = get_registered_nav_menus();
		$this->assertTrue( is_array( $menus ) );

		$this->assertArrayHasKey( 'global', $menus );
		$this->assertEquals( 'Global Menu', $menus['global'] );
	}

}
