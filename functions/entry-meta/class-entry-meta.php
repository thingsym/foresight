<?php
/**
 * Entry Meta
 *
 * @package Foresight
 * @since 1.0.0
 */

namespace Foresight\Functions\Entry_Meta;

/**
 * Class Entry_Meta
 *
 * @since 1.0.0
 */
class Entry_Meta {

	public function __construct() {}

	public static function entry_header() {
		self::posted_on();
		self::modified_on();
		self::posted_by();
	}

	public static function posted_on() {
		if ( empty( get_option( 'date_format' ) ) ) {
			return;
		}

		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s %3$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_html( get_the_time() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'foresight' ),
			$time_string
		);

		echo '<span class="posted-on"><i class="fas fa-clock"></i> ' . $posted_on . '</span> '; // WPCS: XSS OK.
	}

	public static function modified_on() {
		if ( empty( get_option( 'date_format' ) ) ) {
			return;
		}

		if ( get_the_modified_time( 'U' ) <= get_the_time( 'U' ) ) {
			return;
		}

		$time_string = '<time class="entry-date modified" datetime="%1$s">%2$s %3$s</time>';

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() ),
			esc_html( get_the_modified_time() )
		);

		$modified_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Modified on %s', 'post date', 'foresight' ),
			$time_string
		);

		echo '<span class="modified-on"><i class="fas fa-clock"></i> ' . $modified_on . '</span> '; // WPCS: XSS OK.
	}

	public static function posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'foresight' ),
			// @phpstan-ignore-next-line
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"><i class="fas fa-user-alt"></i> ' . $byline . '</span> '; // WPCS: XSS OK.
	}

	public static function entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'foresight' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links"><i class="fas fa-folder-open"></i> ' . esc_html__( 'Posted in %1$s', 'foresight' ) . '</span>', $categories_list ); // WPCS: XSS OK.
				echo ' ';
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'foresight' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links"><i class="fas fa-tags"></i> ' . esc_html__( 'Tagged %1$s', 'foresight' ) . '</span>', $tags_list ); // WPCS: XSS OK.
				echo ' ';
			}
		}
		else {
			do_action( 'foresight/functions/entry_meta/custom_post_type/category' );
			do_action( 'foresight/functions/entry_meta/custom_post_type/tag' );
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link"><i class="fas fa-comments"></i> ';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'foresight' ),
						[
							'span' => [
								'class' => [],
							],
						]
					),
					get_the_title()
				)
			);
			echo '</span> ';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit<span class="screen-reader-text"> %s</span>', 'foresight' ),
					[
						'span' => [
							'class' => [],
						],
					]
				),
				get_the_title()
			),
			'<span class="edit-link"><i class="fas fa-edit"></i> ',
			'</span>'
		);
	}

}
