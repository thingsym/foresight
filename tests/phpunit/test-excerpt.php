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
	public function public_variable() {
		$this->assertSame( 'foresight_layout_archive', $this->excerpt->section_id );
		$this->assertSame( 'foresight_excerpt_options', $this->excerpt->options_name );
		$this->assertSame( 'edit_theme_options', $this->excerpt->capability );

		$expected = [
			'excerpt_type'      => 'fulltext',
			'excerpt_length'    => 55,
			'more_reading_link' => true,
		];
		$this->assertSame( $expected, $this->excerpt->default_options );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'customize_register', [ $this->excerpt, 'customizer' ] ) );
		$this->assertSame( 10, has_filter( 'excerpt_length', [ $this->excerpt, 'get_excerpt_length' ] ) );
		$this->assertSame( 10, has_filter( 'excerpt_mblength', [ $this->excerpt, 'get_excerpt_mblength' ] ) );
		$this->assertSame( 10, has_filter( 'excerpt_more', [ $this->excerpt, 'auto_excerpt_more' ] ) );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function get_options() {
		$this->assertNull( $this->excerpt->get_options( null, null ) );

		$expected = [
			'excerpt_type'      => 'fulltext',
			'excerpt_length'    => 55,
			'more_reading_link' => true,
		];
		$this->assertSame( $expected, $this->excerpt->get_options() );

		$options = [
			'excerpt_type'      => 'summary',
			'excerpt_length'    => 12,
			'more_reading_link' => false,
		];

		set_theme_mod( $this->excerpt->options_name, $options );

		$options = $this->excerpt->get_options();
		$this->assertSame( 'summary', $options['excerpt_type'] );
		$this->assertSame( 12, $options['excerpt_length'] );
		$this->assertFalse( $options['more_reading_link'] );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function get_excerpt_length() {
		$length = $this->excerpt->get_excerpt_length();
		$this->assertSame( 55, $length );

		$options = [
			'excerpt_type'      => 'fulltext',
			'excerpt_length'    => 110,
			'more_reading_link' => true,
		];
		set_theme_mod( 'foresight_excerpt_options', $options );

		$length = $this->excerpt->get_excerpt_length();
		$this->assertSame( 110, $length );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function get_excerpt_mblength() {
		$length = $this->excerpt->get_excerpt_mblength();
		$this->assertSame( 55, $length );

		$options = [
			'excerpt_type'      => 'fulltext',
			'excerpt_length'    => 110,
			'more_reading_link' => true,
		];
		set_theme_mod( 'foresight_excerpt_options', $options );

		$length = $this->excerpt->get_excerpt_mblength();
		$this->assertSame( 110, $length );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function get_excerpt_type() {
		$length = $this->excerpt->get_excerpt_type();
		$this->assertSame( 'fulltext', $length );

		$options = [
			'excerpt_type'      => 'summary',
			'excerpt_length'    => 110,
			'more_reading_link' => true,
		];
		set_theme_mod( 'foresight_excerpt_options', $options );

		$length = $this->excerpt->get_excerpt_type();
		$this->assertSame( 'summary', $length );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function render_continue_reading_link() {
		// TODO:
		// $link_html = $this->excerpt->render_continue_reading_link();
		// $this->assertSame( '', $link_html );
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function auto_excerpt_more() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
