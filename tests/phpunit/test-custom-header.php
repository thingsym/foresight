<?php
/**
 * Class Test_Custom_Header
 *
 * @package Custom_Header
 */

class Test_Custom_Header extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->custom_header = new \Foresight\Functions\Custom_Header\Custom_Header();
	}

	/**
	 * @test
	 * @group Custom_Header
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'wp_enqueue_scripts', [ $this->custom_header, 'header_style' ] ) );
	}

	/**
	 * @test
	 * @group Custom_Header
	 */
	public function header_style() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
