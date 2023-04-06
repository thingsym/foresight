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
		$this->style_script = new \Foresight\Functions\Setup\Style_Script();
	}

	public function tearDown(): void {
		parent::tearDown();
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
		$this->style_script->enqueue_styles();

		$result = $this->custom_header->header_style();
		$this->assertFalse( $result );

		$options = [
			'display_site_title'       => false,
			'display_site_description' => false,
		];

		set_theme_mod( 'foresight_site_header_options', $options );

		$result = $this->custom_header->header_style();
		$this->assertTrue( $result );
	}

}
