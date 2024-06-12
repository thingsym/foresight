<?php
/**
 * Class Test_Setup_Widget
 *
 * @package Foresight
 */

class Test_Setup_Widget extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->widget = new \Foresight\Functions\Setup\Widget();
	}

	public function tearDown(): void {
		parent::tearDown();
	}

	/**
	 * @test
	 * @group Widget
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'widgets_init', [ $this->widget, 'init' ] ) );
	}

	/**
	 * @test
	 * @group Widget
	 */
	public function init() {
		global $wp_registered_sidebars;
		$this->assertTrue( is_array( $wp_registered_sidebars ) );

		$this->assertTrue( is_registered_sidebar('sidebar-page') );
		$this->assertTrue( is_registered_sidebar('sidebar-post') );
		$this->assertTrue( is_registered_sidebar('footer') );

		$this->assertSame( 'Add widgets here.', wp_sidebar_description('sidebar-page') );
	}
}
