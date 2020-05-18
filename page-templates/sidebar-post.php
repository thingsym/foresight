<?php
/**
 * Template Name: Sidebar Page Template
 * Template Post Type: post
 *
 * The page template for sidebar post
 *
 * @package Foresight
 */

?>
<?php get_header(); ?>

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
<div class="main-container" id="main-container">
<?php
do_action( 'foresight/theme_hook/content/prepend' );
while ( have_posts() ) :
	the_post();
	do_action( 'foresight/theme_hook/content/single/prepend' );
	get_template_part( 'templates/content/single', get_post_type() );
	do_action( 'foresight/theme_hook/content/single/append' );
endwhile;
do_action( 'foresight/theme_hook/content/append' );
?>
</div>
</main>
<?php get_template_part( 'templates/sidebar/sidebar-post' ); ?>
</div>
<?php do_action( 'foresight/theme_hook/site/content/after' ); ?>

<?php get_footer(); ?>
