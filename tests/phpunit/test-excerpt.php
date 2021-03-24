<?php
/**
 * Class Test_Excerpt
 *
 * @package Excerpt
 */

class Test_Excerpt extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->excerpt = new \Foresight\Functions\Excerpt\Excerpt();
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function constructor() {
		$this->assertEquals( 10, has_filter( 'customize_register', [ $this->excerpt, 'customizer' ] ) );
		$this->assertEquals( 10, has_filter( 'excerpt_length', [ $this->excerpt, 'get_excerpt_length' ] ) );
		$this->assertEquals( 10, has_filter( 'excerpt_mblength', [ $this->excerpt, 'get_excerpt_mblength' ] ) );
		$this->assertEquals( 10, has_filter( 'excerpt_more', [ $this->excerpt, 'auto_excerpt_more' ] ) );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function get_options() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function get_excerpt_length() {
		$length = $this->excerpt->get_excerpt_length();
		$this->assertEquals( 55, $length );

		$options = array(
			'excerpt_type'      => 'fulltext',
			'excerpt_length'    => 110,
			'more_reading_link' => true,
		);
		set_theme_mod( 'foresight_excerpt_options', $options );

		$length = $this->excerpt->get_excerpt_length();
		$this->assertEquals( 110, $length );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function get_excerpt_mblength() {
		$length = $this->excerpt->get_excerpt_mblength();
		$this->assertEquals( 55, $length );

		$options = array(
			'excerpt_type'      => 'fulltext',
			'excerpt_length'    => 110,
			'more_reading_link' => true,
		);
		set_theme_mod( 'foresight_excerpt_options', $options );

		$length = $this->excerpt->get_excerpt_mblength();
		$this->assertEquals( 110, $length );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function get_excerpt_type() {
		$length = $this->excerpt->get_excerpt_type();
		$this->assertEquals( 'fulltext', $length );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function render_continue_reading_link() {
		// TODO:
		// $link_html = $this->excerpt->render_continue_reading_link();
		// $this->assertEquals( '', $link_html );
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function auto_excerpt_more() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function customizer() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
