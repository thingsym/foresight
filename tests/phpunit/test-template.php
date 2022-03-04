<?php
/**
 * Class Test_Template
 *
 * @package Foresight
 */

class Test_Template extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->template = new \Foresight\Functions\Template\Template();
	}

	/**
	 * @test
	 * @group Template
	 */
	public function public_variable() {
		$this->assertSame( 'templates/', $this->template->templates_dir );
	}

	/**
	 * @test
	 * @group Template
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'after_setup_theme', [ $this->template, 'custom_template_hierarchy' ] ) );
		$this->assertSame( 10, has_filter( 'get_search_form', [ $this->template, 'get_search_form' ] ) );
		$this->assertSame( 10, has_filter( 'body_class', [ $this->template, 'add_archive_template_name' ] ) );
	}

	/**
	 * @test
	 * @group Template
	 */
	public function custom_template_hierarchy() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Template
	 */
	public function get_search_form() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Template
	 */
	public function add_archive_template_name() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
