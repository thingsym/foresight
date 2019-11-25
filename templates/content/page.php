<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Foresight
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( is_front_page() || is_page_template( 'page-templates/top-page.php' ) ) : ?>
		<header class="entry-header screen-reader-text">
	<?php else : ?>
		<header class="entry-header">
	<?php endif; ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php do_action( 'foresight/theme_hook/entry/post_thumbnail', 'full', false ); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'foresight' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit<span class="screen-reader-text"> %s</span>', 'foresight' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link"><i class="fas fa-edit"></i> ',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
