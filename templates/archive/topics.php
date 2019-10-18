<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ace
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php do_action( 'ace/theme_hook/entry/post_thumbnail', 'thumbnail', true ); ?>

	<div class="article-inner">
	<header class="entry-header">
		<?php
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
			<?php do_action( 'ace/theme_hook/entry/meta/header' ); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<footer class="entry-footer">
		<div class="entry-meta">
		<?php do_action( 'ace/theme_hook/entry/meta/footer' ); ?>
		</div>
	</footer><!-- .entry-footer -->
	</div><!-- .article-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
