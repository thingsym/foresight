<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Foresight
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'foresight/theme_hook/entry/post_thumbnail', 'medium', true ); ?>

	<div class="article-inner">
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		<div class="entry-meta">
		<?php do_action( 'foresight/theme_hook/entry/meta/header' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
	<?php do_action( 'foresight/theme_hook/entry/content' ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="entry-meta">
		<?php do_action( 'foresight/theme_hook/entry/meta/footer' ); ?>
		</div>
	</footer><!-- .entry-footer -->
	</div><!-- .article-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
