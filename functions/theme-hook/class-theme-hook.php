<?php
/**
 * Theme Hook
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Theme_Hook;

use Foresight\Functions\Post_Thumbnail\Post_Thumbnail;
use Foresight\Functions\Entry_Meta\Entry_Meta;
use Foresight\Functions\Excerpt\Excerpt;

/**
 * Class Theme_Hook
 *
 * @since 1.0.0
 */
class Theme_Hook {
	public function __construct() {
		add_action( 'foresight/theme_hook/site/header', array( $this, 'header' ) );
		add_action( 'foresight/theme_hook/site/header/after', array( $this, 'global_navi' ) );
		add_action( 'foresight/theme_hook/site/header/after', array( $this, 'header_image' ) );
		add_action( 'foresight/theme_hook/site/footer', array( $this, 'footer_widget' ) );
		add_action( 'foresight/theme_hook/site/footer', array( $this, 'copyright' ) );
		add_action( 'foresight/theme_hook/site/footer/after', array( $this, 'theme_info' ) );

		add_action( 'foresight/theme_hook/entry/post_thumbnail', array( $this, 'post_thumbnail' ), 10, 2 );
		add_action( 'foresight/theme_hook/entry/meta/header', array( $this, 'entry_meta_header' ) );
		add_action( 'foresight/theme_hook/entry/content', array( $this, 'entry_content' ) );
		add_action( 'foresight/theme_hook/entry/meta/footer', array( $this, 'entry_meta_footer' ) );

		add_action( 'foresight/theme_hook/content/index/prepend', array( $this, 'add_page_header' ) );
		add_action( 'foresight/theme_hook/content/archive/prepend', array( $this, 'add_page_header' ) );

		add_action( 'foresight/theme_hook/content/index/prepend', array( $this, 'add_archive_container_start' ) );
		add_action( 'foresight/theme_hook/content/archive/prepend', array( $this, 'add_archive_container_start' ) );
		add_action( 'foresight/theme_hook/content/index/append', array( $this, 'add_archive_container_end' ) );
		add_action( 'foresight/theme_hook/content/archive/append', array( $this, 'add_archive_container_end' ) );

		add_action( 'foresight/theme_hook/content/index/append', array( $this, 'add_posts_navigation' ) );
		add_action( 'foresight/theme_hook/content/archive/append', array( $this, 'add_posts_navigation' ) );
		add_action( 'foresight/theme_hook/content/search/append', array( $this, 'add_posts_navigation' ) );
		add_action( 'foresight/theme_hook/content/single/append', array( $this, 'add_post_navigation' ) );

		add_action( 'foresight/theme_hook/content/page/append', array( $this, 'add_comments' ) );
		add_action( 'foresight/theme_hook/content/single/append', array( $this, 'add_comments' ) );
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

	public function copyright() {
		global $foresight_fn_copyright;
		$foresight_fn_copyright->render();
	}

	public function theme_info() {
		global $foresight_fn_copyright;
		if ( $foresight_fn_copyright->has_theme_info() ) {
			get_template_part( 'templates/parts/theme-info' );
		}
	}

	public function post_thumbnail( $size, $alternative ) {
		Post_Thumbnail::post_thumbnail( $size, $alternative );
	}

	public function entry_meta_header() {
		Entry_Meta::entry_header();
	}

	public function entry_meta_footer() {
		Entry_Meta::entry_footer();
	}

	public function add_page_header() {
		if ( is_home() && ! is_front_page() ) {
			get_template_part( 'templates/page-header/single-post' );
		}
		elseif ( is_archive() ) {
			get_template_part( 'templates/page-header/archive' );
		}
		elseif ( is_search() ) {
			get_template_part( 'templates/page-header/search' );
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
		if ( class_exists( 'Foresight\Functions\Excerpt\Excerpt' ) ) {
			global $foresight_fn_excerpt;
			if ( method_exists( $foresight_fn_excerpt, 'get_excerpt_type' ) && 'summary' === $foresight_fn_excerpt->get_excerpt_type() ) {
				the_excerpt();
			}
			elseif ( method_exists( $foresight_fn_excerpt, 'get_excerpt_type' ) && 'fulltext' === $foresight_fn_excerpt->get_excerpt_type() ) {
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'foresight' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					)
				);
			}
		}
	}

	public function add_archive_container_start() {
		$archive_layout = 'article-all';
		if ( class_exists( 'Foresight\Functions\Layout\Layout' ) ) {
			global $foresight_fn_layout;
			if ( method_exists( $foresight_fn_layout, 'get_archive_layout' ) ) {
				$archive_layout = $foresight_fn_layout->get_archive_layout();
			}
		}

		if ( 'card' === $archive_layout ) {
			echo '<div class="archive-container">';
		}
	}

	public function add_archive_container_end() {
		$archive_layout = 'article-all';
		if ( class_exists( 'Foresight\Functions\Layout\Layout' ) ) {
			global $foresight_fn_layout;
			if ( method_exists( $foresight_fn_layout, 'get_archive_layout' ) ) {
				$archive_layout = $foresight_fn_layout->get_archive_layout();
			}
		}

		if ( 'card' === $archive_layout ) {
			echo '</div>';
		}
	}

}
