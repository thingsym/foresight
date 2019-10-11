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
use Ace\Functions\Excerpt\Excerpt;

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

		add_action( 'ace/theme_hook/content/index/prepend', array( $this, 'add_page_header' ) );
		add_action( 'ace/theme_hook/content/archive/prepend', array( $this, 'add_page_header' ) );

		add_action( 'ace/theme_hook/content/index/prepend', array( $this, 'add_archive_container_start' ) );
		add_action( 'ace/theme_hook/content/index/append', array( $this, 'add_archive_container_end' ) );
		add_action( 'ace/theme_hook/content/archive/prepend', array( $this, 'add_archive_container_start' ) );
		add_action( 'ace/theme_hook/content/archive/append', array( $this, 'add_archive_container_end' ) );

		add_action( 'ace/theme_hook/content/index/append', array( $this, 'add_posts_navigation' ) );
		add_action( 'ace/theme_hook/content/archive/append', array( $this, 'add_posts_navigation' ) );
		add_action( 'ace/theme_hook/content/search/append', array( $this, 'add_posts_navigation' ) );

		add_action( 'ace/theme_hook/content/single/append', array( $this, 'add_post_navigation' ) );

		add_action( 'ace/theme_hook/content/page/append', array( $this, 'add_comments' ) );
		add_action( 'ace/theme_hook/content/single/append', array( $this, 'add_comments' ) );

		add_action( 'ace/theme_hook/entry/content', array( $this, 'entry_content' ) );
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

	public function add_page_header() {
		if ( is_home() && ! is_front_page() ) {
			get_template_part( 'templates/parts/page-header-single-post' );
		}
		elseif ( is_archive() ) {
			get_template_part( 'templates/parts/page-header-archive' );
		}
		elseif ( is_search() ) {
			get_template_part( 'templates/parts/page-header-search' );
		}
	}

	public function add_posts_navigation() {
		the_posts_navigation();
	}

	public function add_post_navigation() {
		the_post_navigation();
	}

	public function add_comments() {
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template( '/templates/parts/comments.php', true );
		}
	}

	public function entry_content() {
		if ( class_exists( 'Ace\Functions\Excerpt\Excerpt' ) ) {
			global $ace_fn_excerpt;
			if ( method_exists( $ace_fn_excerpt, 'get_excerpt_type' ) && 'summary' === $ace_fn_excerpt->get_excerpt_type() ) {
				the_excerpt();
			}
			else {
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ace' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					)
				);

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ace' ),
						'after'  => '</div>',
					)
				);
			}
		}
	}

	public function add_archive_container_start() {
		$archive_layout = 'article-all';
		if ( class_exists( 'Ace\Functions\Layout\Layout' ) ) {
			global $ace_fn_layout;
			if ( method_exists( $ace_fn_layout, 'get_archive_layout' ) ) {
				$archive_layout = $ace_fn_layout->get_archive_layout();
			}
		}

		if ( 'card' === $archive_layout ) {
			echo '<div class="archive-container">';
		}
	}

	public function add_archive_container_end() {
		$archive_layout = 'article-all';
		if ( class_exists( 'Ace\Functions\Layout\Layout' ) ) {
			global $ace_fn_layout;
			if ( method_exists( $ace_fn_layout, 'get_archive_layout' ) ) {
				$archive_layout = $ace_fn_layout->get_archive_layout();
			}
		}

		if ( 'card' === $archive_layout ) {
			echo '</div>';
		}
	}

}
