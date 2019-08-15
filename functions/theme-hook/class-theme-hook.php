<?php
/**
 * Theme Hook
 *
 * @package Ace
 * @since 1.0.0
 */

namespace Ace\Functions\Theme_Hook;

use Ace\Functions\Post_Thumbnail\Post_Thumbnail;
use Ace\Functions\Entry_Meta\Entry_Meta;

/**
 * Class Theme_Hook
 *
 * @since 1.0.0
 */
class Theme_Hook {
	public function __construct() {
		add_action( 'ace/theme_hook/site/header', array( $this, 'header' ) );
		add_action( 'ace/theme_hook/site/header/after', array( $this, 'global_navi' ) );
		add_action( 'ace/theme_hook/site/header/after', array( $this, 'header_image' ) );
		add_action( 'ace/theme_hook/site/footer', array( $this, 'footer_widget' ) );
		add_action( 'ace/theme_hook/site/footer', array( $this, 'site_info' ) );

		add_action( 'ace/theme_hook/entry/post_thumbnail', array( $this, 'post_thumbnail' ) );
		add_action( 'ace/theme_hook/entry/meta/header', array( $this, 'entry_meta_header' ) );
		add_action( 'ace/theme_hook/entry/meta/footer', array( $this, 'entry_meta_footer' ) );

		add_action( 'ace/theme_hook/content/index/prepend', array( $this, 'prepend_content_index' ) );
		add_action( 'ace/theme_hook/content/archive/prepend', array( $this, 'prepend_content_archive' ) );

		add_action( 'ace/theme_hook/content/index/append', array( $this, 'append_content_archive' ) );
		add_action( 'ace/theme_hook/content/archive/append', array( $this, 'append_content_archive' ) );
		add_action( 'ace/theme_hook/content/search/append', array( $this, 'append_content_archive' ) );

		add_action( 'ace/theme_hook/content/page/append', array( $this, 'append_content_page' ) );
		add_action( 'ace/theme_hook/content/single/append', array( $this, 'append_content_single' ) );
	}

	public function header() {
		get_template_part( 'templates/parts/site-header' );
	}

	public function header_image() {
		if ( basename( get_page_template() ) === 'top-page.php' ) {
			get_template_part( 'templates/parts/header-image' );
		}
	}

	public function global_navi() {
		get_template_part( 'templates/parts/global-navi' );
	}

	public function footer_widget() {
		get_template_part( 'templates/sidebar/footer' );
	}

	public function site_info() {
		get_template_part( 'templates/parts/site-info' );
	}

	public function post_thumbnail() {
		Post_Thumbnail::post_thumbnail();
	}

	public function entry_meta_header() {
		Entry_Meta::entry_header();
	}

	public function entry_meta_footer() {
		Entry_Meta::entry_footer();
	}

	public function prepend_content_index() {
		if ( is_home() && ! is_front_page() ) {
			get_template_part( 'templates/parts/page-header-single-post' );
		}
	}

	public function prepend_content_archive() {
		if ( is_archive() ) {
			get_template_part( 'templates/parts/page-header-archive' );
		}
		elseif ( is_search() ) {
			get_template_part( 'templates/parts/page-header-search' );
		}
	}

	public function append_content_archive() {
		the_posts_navigation();
	}

	public function append_content_page() {
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template( '/templates/parts/comments.php', true );
		}
	}

	public function append_content_single() {
		the_post_navigation();

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template( '/templates/parts/comments.php', true );
		}
	}

}
