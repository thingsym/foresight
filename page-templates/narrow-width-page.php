<?php
/**
 * Template Name: Narrow Width Page Template
 * Template Post Type: page
 *
 * The page template for one column page
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
while ( have_posts() ) :
	the_post();
	do_action( 'ace/theme_hook/content/page/prepend' );
	get_template_part( 'templates/content/page' );
	do_action( 'ace/theme_hook/content/page/append' );
endwhile;
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
