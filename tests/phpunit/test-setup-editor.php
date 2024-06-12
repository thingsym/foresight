<?php
/**
 * Class Test_Setup_Editor
 *
 * @package Setup_Editor
 */

class Test_Setup_Editor extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->editor = new \Foresight\Functions\Setup\Editor();
	}

	public function tearDown(): void {
		parent::tearDown();
	}

	/**
	 * @test
	 * @group Setup_Editor
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'after_setup_theme', [ $this->editor, 'editor_color_palette' ] ) );
		$this->assertSame( 10, has_filter( 'after_setup_theme', [ $this->editor, 'editor_font_sizes' ] ) );
	}

	/**
	 * @test
	 * @group Setup_Editor
	 */
	public function editor_color_palette() {
		$palette = get_theme_support( 'editor-color-palette' );
		$this->assertTrue( is_array( $palette ) );
	}

	/**
	 * @test
	 * @group Setup_Editor
	 */
	public function editor_font_sizes() {
		$font_sizes = get_theme_support( 'editor-font-sizes' );
		$this->assertTrue( is_array( $font_sizes ) );
	}

}
