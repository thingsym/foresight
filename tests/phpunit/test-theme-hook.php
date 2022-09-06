<?php
/**
 * Class Test_Theme_Hook
 *
 * @package Foresight
 */

class Test_Theme_Hook extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->theme_hook = new \Foresight\Functions\Theme_Hook\Theme_Hook();
	}

	/**
	 * @test
	 * @group Theme_Hook
	 */
	public function constructor() {
		$this->assertSame( 10, has_filter( 'foresight/theme_hook/site/header', [ $this->theme_hook, 'header' ] ) );
		$this->assertSame( 10, has_filter( 'foresight/theme_hook/site/header/after', [ $this->theme_hook, 'global_navi' ] ) );
		$this->assertSame( 10, has_filter( 'foresight/theme_hook/site/header/after', [ $this->theme_hook, 'header_image' ] ) );
		$this->assertSame( 10, has_filter( 'foresight/theme_hook/site/footer', [ $this->theme_hook, 'footer_widget' ] ) );
		$this->assertSame( 10, has_filter( 'foresight/theme_hook/site/footer', [ $this->theme_hook, 'copyright' ] ) );
		$this->assertSame( 10, has_filter( 'foresight/theme_hook/site/footer/after', [ $this->theme_hook, 'theme_info' ] ) );

		$this->assertSame( 10, has_filter( 'foresight/theme_hook/entry/post_thumbnail', [ $this->theme_hook, 'post_thumbnail' ] ) );
		$this->assertSame( 10, has_filter( 'foresight/theme_hook/entry/meta/header', [ $this->theme_hook, 'entry_meta_header' ] ) );
		$this->assertSame( 10, has_filter( 'foresight/theme_hook/entry/content', [ $this->theme_hook, 'entry_content' ] ) );
		$this->assertSame( 10, has_filter( 'foresight/theme_hook/entry/meta/footer', [ $this->theme_hook, 'entry_meta_footer' ] ) );

		$this->assertSame( 10, has_filter( 'foresight/theme_hook/content/index/prepend', [ $this->theme_hook, 'add_page_header' ] ) );
		$this->assertSame( 10, has_filter( 'foresight/theme_hook/content/archive/prepend', [ $this->theme_hook, 'add_page_header' ] ) );

		$this->assertSame( 10, has_filter( 'foresight/theme_hook/content/index/append', [ $this->theme_hook, 'add_posts_navigation' ] ) );
		$this->assertSame( 10, has_filter( 'foresight/theme_hook/content/archive/append', [ $this->theme_hook, 'add_posts_navigation' ] ) );
		$this->assertSame( 10, has_filter( 'foresight/theme_hook/content/search/append', [ $this->theme_hook, 'add_posts_navigation' ] ) );

		$this->assertSame( 10, has_filter( 'foresight/theme_hook/content/single/append', [ $this->theme_hook, 'add_post_navigation' ] ) );

		$this->assertSame( 10, has_filter( 'foresight/theme_hook/content/page/append', [ $this->theme_hook, 'add_comments' ] ) );
		$this->assertSame( 10, has_filter( 'foresight/theme_hook/content/single/append', [ $this->theme_hook, 'add_comments' ] ) );
	}
}
