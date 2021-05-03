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
	public function constructor() {
		$this->assertEquals( 10, has_filter( 'customize_register', [ $this->layout, 'customizer' ] ) );
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function get_options() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
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
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
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

		$options = array(
			'archive_sidebar'            => true,
			'archive'                    => 'article-all',
			'footer_area_column_ratio' => 'one-to-one',
		);
		set_theme_mod( 'foresight_layout_options', $options );

		$sidebar = $this->layout->has_archive_sidebar();
		$this->assertTrue( $sidebar );
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function customizer() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
