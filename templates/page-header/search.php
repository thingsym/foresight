<?php
/**
 * The page header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Foresight
 */

?>
<header class="page-header">
<h1 class="page-title">
<?php
/* translators: %s: search query. */
printf( esc_html__( 'Search Results for: %s', 'foresight' ), '<span>' . get_search_query() . '</span>' );
?>
<br>
<?php
global $wp_query;
global $paged;

$local_paged = 1;
if ( $paged ) {
	$local_paged = $paged;
}

printf(
	/* translators: %s: found posts. */
	esc_html( _n( 'About %s result', 'About %s results', $wp_query->found_posts, 'foresight' ) ) . ' (' .
	/* translators: %s: paged. */
	esc_html( _n( '%s page', '%s pages', $local_paged, 'foresight' ) ) . ' / ' .
	/* translators: %s: max number of pages. */
	esc_html( _n( 'Total %s page', 'Total %s pages', $wp_query->max_num_pages, 'foresight' ) ) . ')',
	'<span>' . esc_html( $wp_query->found_posts ) . '</span>',
	'<span>' . esc_html( $local_paged ) . '</span>',
	'<span>' . esc_html( $wp_query->max_num_pages ) . '</span>'
);
?>
</h1>
</header><!-- .page-header -->
