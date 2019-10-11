<?php
/**
 * Template Name: Landing Page Template
 * Template Post Type: page
 *
 * The page template for landing page
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
<div class="site-content">
<main class="primary">
<div class="main-container">
<?php
while ( have_posts() ) :
	the_post();
	get_template_part( 'templates/content/blank' );
endwhile;
?>
</div>
</main>
</div>

<?php do_action( 'ace/theme_hook/site/footer/after' ); ?>
</div>
<?php wp_footer(); ?>
</body>
</html>
