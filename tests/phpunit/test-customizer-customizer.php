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
		$this->assertEquals( 10, has_filter( 'customize_preview_init', [ $this->customizer, 'preview_enqueue_scripts' ] ) );
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
