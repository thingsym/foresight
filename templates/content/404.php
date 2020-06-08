<?php
/**
 * Template part for 404 posts
 *
 * @package Foresight
 */

?>
<article class="error-404 not-found">
<header class="entry-header">
<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'foresight' ); ?></h1>
</header>

<div class="entry-content">
<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'foresight' ); ?></p>

<?php
get_search_form();

the_widget( 'WP_Widget_Recent_Posts' );
?>

<div class="widget widget_categories">
<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'foresight' ); ?></h2>
<ul>
	<?php
	wp_list_categories(
		[
			'orderby'    => 'count',
			'order'      => 'DESC',
			'show_count' => 1,
			'title_li'   => '',
			'number'     => 10,
		]
	);
	?>
</ul>
</div><!-- .widget -->

<?php
/* translators: %1$s: smiley */
$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'foresight' ), convert_smilies( ':)' ) ) . '</p>';
the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

the_widget( 'WP_Widget_Tag_Cloud' );
?>

</div><!-- .entry-content -->
</article><!-- .error-404 -->
