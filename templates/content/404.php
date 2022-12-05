<?php
/**
 * Template part for 404 posts
 *
 * @package Foresight
 */

?>
<article class="error-404 not-found">
<header class="entry-header">
<h1 class="entry-title"><?php esc_html_e( 'The page you are looking for could not be found.', 'foresight' ); ?></h1>
</header>

<div class="entry-content">
<p><?php esc_html_e( 'The page you accessed has been deleted or the URL has changed and cannot be displayed.', 'foresight' ); ?></p>

<?php get_search_form(); ?>

</div><!-- .entry-content -->
</article><!-- .error-404 -->
