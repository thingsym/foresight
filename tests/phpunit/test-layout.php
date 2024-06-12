<?php
/**
 * Class Test_Layout
 *
 * @package Layout
 */

class Test_Layout extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->layout = new \Foresight\Functions\Layout\Layout();
	}

	public function tearDown(): void {
		remove_theme_mod( $this->layout->options_name );
		remove_filter( 'foresight/functions/layout/get_option', array( $this, '_filter_option' ) );
		remove_filter( 'foresight/functions/layout/get_options', array( $this, '_filter_options' ) );
		parent::tearDown();
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function object_attribute() {
		$this->assertObjectHasAttribute( 'section_prefix', $this->layout );
		$this->assertObjectHasAttribute( 'options_name', $this->layout );
		$this->assertObjectHasAttribute( 'section_priority', $this->layout );
		$this->assertObjectHasAttribute( 'capability', $this->layout );
		$this->assertObjectHasAttribute( 'default_options', $this->layout );
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function public_variable() {
		$this->assertSame( 'foresight_layout', $this->layout->section_prefix );
		$this->assertSame( 'foresight_layout_options', $this->layout->options_name );
		$this->assertSame( 81, $this->layout->section_priority );
		$this->assertSame( 'edit_theme_options', $this->layout->capability );

		$expected = [
			'archive_sidebar'          => false,
			'archive'                  => 'article-all',
			'archive_image'            => '',
		];
		$this->assertSame( $expected, $this->layout->default_options );
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'customize_register', [ $this->layout, 'customizer' ] ) );
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
			'archive_image'            => '',
		];
		$this->assertSame( $expected, $this->layout->get_options() );

		$options = [
			'archive_sidebar'          => true,
			'archive'                  => 'article-only',
			'archive_image'            => 112,
		];

		set_theme_mod( $this->layout->options_name, $options );

		$options = $this->layout->get_options();
		$this->assertTrue( $options['archive_sidebar'] );
		$this->assertSame( 'article-only', $options['archive'] );
		$this->assertSame( 112, $options['archive_image'] );
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

		$this->go_to( '/' );
		$layout = $this->layout->get_archive_layout();
		$this->assertSame( 'article-all', $layout );

		$this->go_to( '/?cat=1' );
		$layout = $this->layout->get_archive_layout();
		$this->assertSame( 'article-all', $layout );

		$this->go_to( '/?s=abc' );
		$layout = $this->layout->get_archive_layout();
		$this->assertSame( 'article-all', $layout );

		$options = [
			'archive_sidebar'          => true,
			'archive'                  => 'article-only',
			'archive_image'            => 112,
		];

		set_theme_mod( $this->layout->options_name, $options );

		$this->go_to( '/' );
		$layout = $this->layout->get_archive_layout();
		$this->assertSame( 'article-only', $layout );
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function data_attr_archive_layout() {
		ob_start();
		$this->layout->data_attr_archive_layout();
		$result = ob_get_clean();
		$this->assertEmpty( $result );

		$this->go_to( '/' );
		ob_start();
		$this->layout->data_attr_archive_layout();
		$result = ob_get_clean();
		$this->assertSame( ' data-archive-layout="article-all"', $result );

		$this->go_to( '/?cat=1' );
		ob_start();
		$this->layout->data_attr_archive_layout();
		$result = ob_get_clean();
		$this->assertSame( ' data-archive-layout="article-all"', $result );

		$this->go_to( '/?s=abc' );
		ob_start();
		$this->layout->data_attr_archive_layout();
		$result = ob_get_clean();
		$this->assertSame( ' data-archive-layout="article-all"', $result );

		$options = [
			'archive_sidebar'          => true,
			'archive'                  => 'article-only',
			'archive_image'            => 112,
		];

		set_theme_mod( $this->layout->options_name, $options );

		$this->go_to( '/' );
		ob_start();
		$this->layout->data_attr_archive_layout();
		$result = ob_get_clean();
		$this->assertSame( ' data-archive-layout="article-only"', $result );
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
			'archive_image'            => '',
		];
		set_theme_mod( $this->layout->options_name, $options );

		$sidebar = $this->layout->has_archive_sidebar();
		$this->assertTrue( $sidebar );
	}

	/**
	 * @test
	 * @group Layout
	 */
	public function get_archive_image_id() {
		$image_id = $this->layout->get_archive_image_id();
		$this->assertEmpty( $image_id );

		$options = [
			'archive_sidebar'          => true,
			'archive'                  => 'article-only',
			'archive_image'            => 112,
		];
		set_theme_mod( $this->layout->options_name, $options );

		$image_id = $this->layout->get_archive_image_id();
		$this->assertSame( 112, $image_id );
	}

}
