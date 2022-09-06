<?php
/**
 * Class Test_Loadup
 *
 * @package Foresight
 */

class Test_Loadup extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
	}

	/**
	 * @test
	 * @group Loadup
	 */
	public function class_exists() {
		$this->assertTrue( class_exists( 'Foresight\Functions\Setup\Theme' ) );
		$this->assertTrue( class_exists( 'Foresight\Functions\Setup\Style_Script' ) );
		$this->assertTrue( class_exists( 'Foresight\Functions\Setup\Menu' ) );
		$this->assertTrue( class_exists( 'Foresight\Functions\Setup\Widget' ) );
		$this->assertTrue( class_exists( 'Foresight\Functions\Setup\Editor' ) );

		$this->assertTrue( class_exists( 'Foresight\Functions\Template\Template' ) );
		$this->assertTrue( class_exists( 'Foresight\Functions\Customizer\Customizer' ) );
		$this->assertTrue( class_exists( 'Foresight\Functions\Customizer\Panel' ) );
		$this->assertTrue( class_exists( 'Foresight\Functions\Customizer\Sanitize' ) );
		$this->assertTrue( class_exists( 'Foresight\Functions\Theme_Hook\Theme_Hook' ) );

		$this->assertTrue( class_exists( 'Foresight\Functions\Custom_Header\Custom_Header' ) );
		$this->assertTrue( class_exists( 'Foresight\Functions\Post_Thumbnail\Post_Thumbnail' ) );
		$this->assertTrue( class_exists( 'Foresight\Functions\Color\Color' ) );
		$this->assertTrue( class_exists( 'Foresight\Functions\Font\Font' ) );

		$this->assertTrue( class_exists( 'Foresight\Functions\Layout\Layout' ) );
		$this->assertTrue( class_exists( 'Foresight\Functions\Excerpt\Excerpt' ) );
		$this->assertTrue( class_exists( 'Foresight\Functions\Custom_Entry_Meta\Custom_Entry_Meta' ) );
		$this->assertTrue( class_exists( 'Foresight\Functions\Copyright\Copyright' ) );
	}

	/**
	 * @test
	 * @group Loadup
	 */
	public function instance_exists() {
		global $foresight_setup_theme;
		$this->assertInstanceOf( 'Foresight\Functions\Setup\Theme', $foresight_setup_theme );
		global $foresight_setup_style_script;
		$this->assertInstanceOf( 'Foresight\Functions\Setup\Style_Script', $foresight_setup_style_script );
		global $foresight_setup_menu;
		$this->assertInstanceOf( 'Foresight\Functions\Setup\Menu', $foresight_setup_menu );
		global $foresight_setup_widget;
		$this->assertInstanceOf( 'Foresight\Functions\Setup\Widget', $foresight_setup_widget );
		global $foresight_setup_editor;
		$this->assertInstanceOf( 'Foresight\Functions\Setup\Editor', $foresight_setup_editor );

		global $foresight_fn_layout;
		$this->assertInstanceOf( 'Foresight\Functions\Layout\Layout', $foresight_fn_layout );
		global $foresight_fn_excerpt;
		$this->assertInstanceOf( 'Foresight\Functions\Excerpt\Excerpt', $foresight_fn_excerpt );
		global $foresight_fn_entry_meta;
		$this->assertInstanceOf( 'Foresight\Functions\Custom_Entry_Meta\Custom_Entry_Meta', $foresight_fn_entry_meta );
		global $foresight_fn_copyright;
		$this->assertInstanceOf( 'Foresight\Functions\Copyright\Copyright', $foresight_fn_copyright );
	}
}
