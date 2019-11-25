<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Foresight
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
<?php do_action( 'foresight/theme_hook/site/header/before' ); ?>
<header class="site-header">
<div class="header-container">
<?php do_action( 'foresight/theme_hook/site/header' ); ?>
</div>
</header>
<?php do_action( 'foresight/theme_hook/site/header/after' ); ?>

<?php do_action( 'foresight/theme_hook/site/content/before' ); ?>
<div class="site-content">
<main class="primary">
<div class="main-container">
<?php
do_action( 'foresight/theme_hook/content/prepend' );
get_template_part( 'templates/content/404' );
do_action( 'foresight/theme_hook/content/append' );
?>
</div>
</main>
</div>
<?php do_action( 'foresight/theme_hook/site/content/after' ); ?>

<?php do_action( 'foresight/theme_hook/site/footer/before' ); ?>
<footer class="site-footer">
<div class="footer-container">
<?php do_action( 'foresight/theme_hook/site/footer' ); ?>
</div>
</footer>
<?php do_action( 'foresight/theme_hook/site/footer/after' ); ?>
</div>
<?php wp_footer(); ?>
</body>
</html>
