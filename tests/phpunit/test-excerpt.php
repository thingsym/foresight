<?php
/**
 * Class Test_Excerpt
 *
 * @package Excerpt
 */

class Test_Excerpt extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->excerpt = new \Foresight\Functions\Excerpt\Excerpt();
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function object_attribute() {
		$this->assertObjectHasAttribute( 'section_id', $this->excerpt );
		$this->assertObjectHasAttribute( 'options_name', $this->excerpt );
		$this->assertObjectHasAttribute( 'capability', $this->excerpt );
		$this->assertObjectHasAttribute( 'default_options', $this->excerpt );
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
		set_theme_mod( $this->excerpt->options_name, $options );

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
		set_theme_mod( $this->excerpt->options_name, $options );

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
		set_theme_mod( $this->excerpt->options_name, $options );

		$length = $this->excerpt->get_excerpt_type();
		$this->assertSame( 'summary', $length );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function render_continue_reading_link() {
		$args = array(
			'post_title'   => 'Hello World!',
			'post_content' => 'Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! ',
			'post_excerpt' => 'abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc ',
			'post_status'  => 'publish',
			'post_author'  => 1,
			'post_date'    => '2022-10-09 00:00:00',
		);

		// $options = [
		// 	'excerpt_type'      => 'summary',
		// 	'excerpt_length'    => 110,
		// 	'more_reading_link' => true,
		// ];
		// set_theme_mod( $this->excerpt->options_name, $options );

		$post_id = $this->factory->post->create( $args );

		global $post;
		$post = get_post( $post_id );
		$excerpt = get_the_excerpt( $post_id );
		// var_dump(the_excerpt( $post_id ));
		setup_postdata( $post );

		// $this->assertRegExp( '/' . preg_quote( '<span class="more-reading"> &hellip;' ) . '/', $excerpt );
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function auto_excerpt_more() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );

		// $args = array(
		// 	'post_title'   => 'Hello World!',
		// 	'post_content' => 'Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! Hello World! ',
		// 	'post_excerpt' => '',
		// 	'post_status'  => 'publish',
		// 	'post_author'  => 1,
		// 	'post_date'    => '2022-10-09 00:00:00',
		// );

		// $post_id = $this->factory->post->create( $args );

		// global $post;
		// $post = get_post( $post_id );
		// $excerpt = get_the_excerpt( $post_id );
		// setup_postdata( $post );

		// $this->assertRegExp( '/' . preg_quote( '<span class="more-reading"> &hellip;' ) . '/', $excerpt );

		// $args = array(
		// 	'post_title'   => 'Hello World!',
		// 	'post_content' => 'Hello World!',
		// 	'post_excerpt' => 'abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc abc ',
		// 	'post_status'  => 'publish',
		// 	'post_author'  => 1,
		// 	'post_date'    => '2022-10-09 00:00:00',
		// );

		// $post_id = $this->factory->post->create( $args );

		// global $post;
		// $post = get_post( $post_id );
		// $excerpt = get_the_excerpt( $post_id );
		// setup_postdata( $post );

		// $this->assertNotRegExp( '/' . preg_quote( '<span class="more-reading"> &hellip;' ) . '/', $excerpt );

		// $args = array(
		// 	'post_title'   => 'Hello World!',
		// 	'post_content' => 'Hello World!',
		// 	'post_excerpt' => '',
		// 	'post_status'  => 'publish',
		// 	'post_author'  => 1,
		// 	'post_date'    => '2022-10-09 00:00:00',
		// );

		// $post_id = $this->factory->post->create( $args );

		// global $post;
		// $post = get_post( $post_id );
		// $excerpt = get_the_excerpt( $post_id );
		// setup_postdata( $post );

		// $this->assertNotRegExp( '/' . preg_quote( '<span class="more-reading"> &hellip;' ) . '/', $excerpt );
	}

	/**
	 * @test
	 * @group Excerpt
	 */
	public function post_excerpt_length() {
		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

}
