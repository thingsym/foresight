<?php
/**
 * Template Name: Landing Page Template
 * Template Post Type: page
 *
 * The page template for landing page
 *
 * @package Foresight
 */

?>
<?php get_header(); ?>

<div class="container">
<div class="site-content">
<main class="primary">
<div class="main-container" id="main-container">
<?php
while ( have_posts() ) :
	the_post();
	get_template_part( 'templates/content/blank' );
endwhile;
?>
</div>
</main>
</div>

<?php do_action( 'foresight/theme_hook/site/footer/after' ); ?>
</div>
<?php wp_footer(); ?>
</body>
</html>
