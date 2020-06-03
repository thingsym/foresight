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
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
			<?php do_action( 'foresight/theme_hook/entry/meta/header' ); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php do_action( 'foresight/theme_hook/entry/post_thumbnail', 'full', false ); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			[
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'foresight' ),
				'after'  => '</div>',
			]
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
	<div class="entry-meta">
	<?php do_action( 'foresight/theme_hook/entry/meta/footer' ); ?>
	</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
