<?php
/**
 * Class Test_Template
 *
 * @package Foresight
 */

class Test_Template extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->template = new \Foresight\Functions\Template\Template();
	}

	public function tearDown(): void {
		parent::tearDown();
	}

	/**
	 * @test
	 * @group Template
	 */
	public function public_variable() {
		$this->assertSame( 'templates/', $this->template->templates_dir );
	}

	/**
	 * @test
	 * @group Template
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'after_setup_theme', [ $this->template, 'custom_template_hierarchy' ] ) );
		$this->assertSame( 10, has_filter( 'get_search_form', [ $this->template, 'get_search_form' ] ) );
		$this->assertSame( 10, has_filter( 'body_class', [ $this->template, 'add_archive_template_name' ] ) );
	}

	/**
	 * @test
	 * @group Template
	 */
	public function object_attribute() {
		$this->assertObjectHasAttribute( 'templates_dir', $this->template );
	}

	/**
	 * @test
	 * @group Template
	 */
	public function custom_template_hierarchy() {
		// $this->template->custom_template_hierarchy();

		// $types = [
		// 	'index',
		// 	'404',
		// 	'archive',
		// 	'author',
		// 	'category',
		// 	'tag',
		// 	'taxonomy',
		// 	'date',
		// 	'embed',
		// 	'home',
		// 	'frontpage',
		// 	'page',
		// 	'paged',
		// 	'search',
		// 	'single',
		// 	'singular',
		// 	'attachment',
		// ];

		// foreach ( $types as $type ) {
		// 	$this->assertSame( 10, has_filter( "{$type}_template_hierarchy", [ $this->template, 'custom_template_hierarchy' ] ) );
		// }

		$this->markTestIncomplete( 'This test has not been implemented yet.' );
	}

	/**
	 * @test
	 * @group Template
	 */
	public function get_search_form() {
		$form = $this->template->get_search_form();

		$this->assertEmpty( $form );
	}

	/**
	 * @test
	 * @group Template
	 */
	public function add_archive_template_name() {
		$classes = $this->template->add_archive_template_name();
		$this->assertCount( 0, $classes );

		$classes = $this->template->add_archive_template_name( [ 'aaa' ]);
		$this->assertCount( 1, $classes );

		$options = [
			'archive_sidebar'          => true,
			'archive'                  => 'article-all',
			'archive_image'            => null,
			'footer_area_column_ratio' => 'one-to-one',
		];
		set_theme_mod( 'foresight_layout_options', $options );

		$this->go_to( '/' );
		$classes = $this->template->add_archive_template_name( [ 'aaa' ]);
		$this->assertCount( 2, $classes );
		$this->assertContains( 'archive-template-index-sidebar', $classes );

		$this->go_to( '/?cat=1' );
		$classes = $this->template->add_archive_template_name( [ 'aaa' ]);
		$this->assertCount( 2, $classes );
		$this->assertContains( 'archive-template-archive-sidebar', $classes );
	}

}
