<?php
/**
 * Meta_Description
 *
 * @package Foresight
 * @since 2.3.0
 */

namespace Foresight\Functions\SEO;

/**
 * class Meta_Description
 *
 * @since 2.3.0
 */
class Meta_Description {
	public function __construct() {
		add_action( 'wp_head', [ $this, 'print_tag' ], 1 );
	}

	public function get_description() {
		$description = '';

		if ( is_home() ) {
			if ( is_front_page() ) {
				$description = get_bloginfo( 'description' );
			}
			else {
				$post = get_post( get_option( 'page_for_posts' ) );
				if ( $post->post_excerpt ) {
					$description = $post->post_excerpt;
				}
				else {
					$description = get_bloginfo( 'description' );
				}
			}
		}
		elseif ( is_front_page() ) {
			global $post;

			if ( $post->post_password ) {
				$description = __( 'This post is password protected.', 'foresight' );
			}
			elseif ( 'private' === $post->post_status ) {
				$description = __( 'private mode', 'foresight' );
			}
			elseif ( $post->post_excerpt ) {
				$description = $post->post_excerpt;
			}
			else {
				$description = get_bloginfo( 'description' );
			}
		}
		elseif ( is_single() || is_page() ) {
			global $post;

			if ( $post->post_password ) {
				$description = __( 'This post is password protected.', 'foresight' );
			}
			elseif ( 'private' === $post->post_status ) {
				$description = __( 'private mode', 'foresight' );
			}
			elseif ( $post->post_excerpt ) {
				$description = $post->post_excerpt;
			}
			else {
				$description = preg_split( '/<!--more-->/', $post->post_content );
				$description = $description[0];
			}
		}
		elseif ( is_archive() ) {
			if ( is_category() ) {
				$description = category_description();
			}
			elseif ( is_author() ) {
				$description = get_the_author_meta( 'description' );
			}
			elseif ( is_tag() ) {
				$description = tag_description();
			}
			elseif ( is_day() ) {
				/* translators: %s: Daily */
				$description = sprintf( __( 'Daily Archives: %s', 'foresight' ), get_the_date() );
			}
			elseif ( is_month() ) {
				/* translators: %s: Month */
				$description = sprintf( __( 'Monthly Archives: %s', 'foresight' ), get_the_date( 'F Y' ) );
			}
			elseif ( is_year() ) {
				/* translators: %s: Year */
				$description = sprintf( __( 'Yearly Archives: %s', 'foresight' ), get_the_date( 'Y' ) );
			}
			elseif ( is_tax() ) {
				$description = term_description( get_queried_object()->term_id, get_queried_object()->taxonomy );
			}
			// phpcs:ignore Generic.CodeAnalysis.EmptyStatement.DetectedElseif
			elseif ( is_post_type_archive() ) {
			}
		}
		elseif ( is_search() ) {
			$description = sprintf( __( 'Search Results for: %s', 'foresight' ), get_search_query() );
		}

		$description = $this->trim_description( apply_filters( 'foresight/functions/seo/meta_description/description', $description ) );

		return $description;
	}

	public function trim_description( $description ) {
		$description = wp_strip_all_tags( $description );
		$description = strip_shortcodes( $description );
		$description = wp_trim_words( $description, 120, '' );

		return $description;
	}

	public function print_tag() {
		$description = $this->get_description();

		if ( ! empty( $description ) ) {
			$meta = '<meta name="description" content="' . htmlentities( $description ) . '">' . "\n";
			echo apply_filters( 'foresight/functions/seo/meta_description/print_tag', $meta );
		}
	}
}
