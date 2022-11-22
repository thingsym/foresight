<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Foresight
 */

?>
<article class="no-result not-found">
<header class="entry-header">
<h1 class="entry-title"><?php esc_html_e( 'The page you are looking for could not be found.', 'foresight' ); ?></h1>
</header>
<div class="entry-content">
	<?php
	if ( is_home() && current_user_can( 'publish_posts' ) ) {
		printf(
			'<p>' . wp_kses(
				/* translators: 1: link to WP admin new post page. */
				__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'foresight' ),
				[
					'a' => [
						'href' => [],
					],
				]
			) . '</p>',
			esc_url( admin_url( 'post-new.php' ) )
		);

	} elseif ( is_search() ) {
		?>
		<p><?php esc_html_e( 'Nothing matched your search keywords. Please try again with some different keywords.', 'foresight' ); ?></p>
		<?php
		get_search_form();
	} else {
		?>
		<p><?php esc_html_e( 'The page you accessed has been deleted or the URL has changed and cannot be displayed.', 'foresight' ); ?></p>
		<?php
		get_search_form();
	}
	?>
</div><!-- .entry-content -->
</article><!-- .no-results -->
