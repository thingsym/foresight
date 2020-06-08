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
	public function constructor() {
		$this->assertEquals( 10, has_filter( 'after_setup_theme', [ $this->template, 'custom_template_hierarchy' ] ) );
		$this->assertEquals( 10, has_filter( 'get_search_form', [ $this->template, 'get_search_form' ] ) );
	}

}
