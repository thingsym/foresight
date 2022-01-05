<?php
/**
 * Class Test_Customizer_Customizer
 *
 * @package Foresight
 */

class Test_Customizer_Customizer extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->customizer = new \Foresight\Functions\Customizer\Customizer();
	}

	/**
	 * @test
	 * @group Customizer_Customizer
	 */
	public function constructor() {
		$this->assertEquals( 10, has_filter( 'customize_register', [ $this->customizer, 'customizer' ] ) );
		$this->assertEquals( 10, has_filter( 'customize_register', [ $this->customizer, 'site_title_description' ] ) );
		$this->assertEquals( 10, has_filter( 'customize_controls_enqueue_scripts', [ $this->customizer, 'control_enqueue_scripts' ] ) );
		$this->assertEquals( 10, has_filter( 'customize_preview_init', [ $this->customizer, 'preview_enqueue_scripts' ] ) );
	}

	/**
	 * @test
	 * @group Customizer_Customizer
	 */
	public function customizer() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Customizer_Customizer
	 */
	public function site_title_description() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Customizer_Customizer
	 */
	public function display_blogname() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Customizer_Customizer
	 */
	public function display_blogdescription() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Customizer_Customizer
	 */
	public function render_partial_blogname() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Customizer_Customizer
	 */
	public function render_partial_blogdescription() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Customizer_Customizer
	 */
	public function control_enqueue_scripts() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Customizer_Customizer
	 */
	public function preview_enqueue_scripts() {
		$this->customizer->preview_enqueue_scripts();
		$this->assertTrue( wp_script_is( 'foresight-customizer-preview' ) );
	}

}
