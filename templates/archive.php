<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ace
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
else {
	do_action( 'wp_body_open' );
}
?>
<div class="container">
<?php do_action( 'ace/theme_hook/site/header/before' ); ?>
<header class="site-header">
<div class="header-container">
<?php do_action( 'ace/theme_hook/site/header' ); ?>
</div>
</header>
<?php do_action( 'ace/theme_hook/site/header/after' ); ?>

<?php do_action( 'ace/theme_hook/site/content/before' ); ?>
<div class="site-content">
<main class="primary">
<div class="main-container">
<?php
do_action( 'ace/theme_hook/content/prepend' );
if ( have_posts() ) {
	do_action( 'ace/theme_hook/content/archive/prepend' );
	while ( have_posts() ) :
		the_post();

		/**
		 * Include the Post-Type-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
		 */
		get_template_part( 'templates/content/archive', get_post_type() );
	endwhile;
	do_action( 'ace/theme_hook/content/archive/append' );
}
else {
	get_template_part( 'templates/content/not-found' );
}
do_action( 'ace/theme_hook/content/append' );
?>
</div>
</main>
</div>
<?php do_action( 'ace/theme_hook/site/content/after' ); ?>

<?php do_action( 'ace/theme_hook/site/footer/before' ); ?>
<footer class="site-footer">
<div class="footer-container">
<?php do_action( 'ace/theme_hook/site/footer' ); ?>
</div>
</footer>
<?php do_action( 'ace/theme_hook/site/footer/after' ); ?>
</div>
<?php wp_footer(); ?>
</body>
</html>
