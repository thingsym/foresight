<?php
/**
 * Class Test_Theme_Hook
 *
 * @package Foresight
 */

class Test_Theme_Hook extends WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->theme_hook = new \Foresight\Functions\Theme_Hook\Theme_Hook();
	}

	/**
	 * @test
	 * @group Theme_Hook
	 */
	public function constructor() {
		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/site/header', [ $this->theme_hook, 'header' ] ) );
		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/site/header/after', [ $this->theme_hook, 'global_navi' ] ) );
		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/site/header/after', [ $this->theme_hook, 'header_image' ] ) );
		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/site/footer', [ $this->theme_hook, 'footer_widget' ] ) );
		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/site/footer', [ $this->theme_hook, 'copyright' ] ) );
		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/site/footer/after', [ $this->theme_hook, 'theme_info' ] ) );

		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/entry/post_thumbnail', [ $this->theme_hook, 'post_thumbnail' ] ) );
		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/entry/meta/header', [ $this->theme_hook, 'entry_meta_header' ] ) );
		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/entry/content', [ $this->theme_hook, 'entry_content' ] ) );
		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/entry/meta/footer', [ $this->theme_hook, 'entry_meta_footer' ] ) );

		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/content/index/prepend', [ $this->theme_hook, 'add_page_header' ] ) );
		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/content/archive/prepend', [ $this->theme_hook, 'add_page_header' ] ) );

		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/content/index/append', [ $this->theme_hook, 'add_posts_navigation' ] ) );
		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/content/archive/append', [ $this->theme_hook, 'add_posts_navigation' ] ) );
		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/content/search/append', [ $this->theme_hook, 'add_posts_navigation' ] ) );

		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/content/single/append', [ $this->theme_hook, 'add_post_navigation' ] ) );

		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/content/page/append', [ $this->theme_hook, 'add_comments' ] ) );
		$this->assertEquals( 10, has_filter( 'foresight/theme_hook/content/single/append', [ $this->theme_hook, 'add_comments' ] ) );
	}
}
