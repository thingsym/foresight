<?php
/**
 * Class Test_Layout
 *
 * @package Layout
 */

class Test_Layout extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->layout = new \Foresight\Functions\Layout\Layout();
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function public_variable() {
		$this->assertEquals( 'foresight_layout', $this->layout->section_prefix );
		$this->assertEquals( 'foresight_layout_options', $this->layout->options_name );
		$this->assertEquals( 81, $this->layout->section_priority );
		$this->assertEquals( 'edit_theme_options', $this->layout->capability );

		$expected = [
			'archive_sidebar'          => false,
			'archive'                  => 'article-all',
			'archive_image'            => null,
			'footer_area_column_ratio' => 'one-to-one',
		];
		$this->assertEquals( $expected, $this->layout->default_options );
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function constructor() {
		$this->assertEquals( 10, has_filter( 'customize_register', [ $this->layout, 'customizer' ] ) );
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function get_options() {
		$this->assertNull( $this->layout->get_options( null, null ) );

		$expected = [
			'archive_sidebar'          => false,
			'archive'                  => 'article-all',
			'archive_image'            => null,
			'footer_area_column_ratio' => 'one-to-one',
		];
		$this->assertEquals( $expected, $this->layout->get_options() );

		$options = [
			'archive_sidebar'          => true,
			'archive'                  => 'article-only',
			'archive_image'            => 112,
			'footer_area_column_ratio' => 'two-to-one',
		];

		set_theme_mod( $this->layout->options_name, $options );

		$options = $this->layout->get_options();
		$this->assertTrue( $options['archive_sidebar'] );
		$this->assertEquals( 'article-only', $options['archive'] );
		$this->assertEquals( 112, $options['archive_image'] );
		$this->assertEquals( 'two-to-one', $options['footer_area_column_ratio'] );
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function get_archive_options() {
		$options = $this->layout->get_archive_options();
		$this->assertTrue( is_array( $options ) );
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function get_archive_layout() {
		$layout = $this->layout->get_archive_layout();
		$this->assertNull( $layout );
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function data_attr_archive_layout() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function get_footer_area_column_ratio_options() {
		$options = $this->layout->get_footer_area_column_ratio_options();
		$this->assertTrue( is_array( $options ) );
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function get_footer_area_column_ratio() {
		$ratio = $this->layout->get_footer_area_column_ratio();
		$this->assertEquals( 'one-to-one', $ratio );

		$options = [
			'archive_sidebar'          => true,
			'archive'                  => 'article-only',
			'archive_image'            => 112,
			'footer_area_column_ratio' => 'two-to-one',
		];
		set_theme_mod( 'foresight_layout_options', $options );

		$ratio = $this->layout->get_footer_area_column_ratio();
		$this->assertEquals( 'two-to-one', $ratio );
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function data_attr_footer_area_column_ratio() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function has_archive_sidebar() {
		$sidebar = $this->layout->has_archive_sidebar();
		$this->assertFalse( $sidebar );

		$options = [
			'archive_sidebar'          => true,
			'archive'                  => 'article-all',
			'archive_image'            => null,
			'footer_area_column_ratio' => 'one-to-one',
		];
		set_theme_mod( 'foresight_layout_options', $options );

		$sidebar = $this->layout->has_archive_sidebar();
		$this->assertTrue( $sidebar );
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function get_archive_image_id() {
		$image_id = $this->layout->get_archive_image_id();
		$this->assertNull( $image_id );

		$options = [
			'archive_sidebar'          => true,
			'archive'                  => 'article-only',
			'archive_image'            => 112,
			'footer_area_column_ratio' => 'two-to-one',
		];
		set_theme_mod( 'foresight_layout_options', $options );

		$image_id = $this->layout->get_archive_image_id();
		$this->assertEquals( 112, $image_id );
	}

}
