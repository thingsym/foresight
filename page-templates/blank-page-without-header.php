<?php
/**
 * Template Name: Blank Page without header Template
 * Template Post Type: page
 *
 * The page template
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
$post_type = get_post_type();
if ( in_array( $post_type, [ 'post' ] ) ) {
	$post_type = 'single';
}

while ( have_posts() ) :
	the_post();
	get_template_part( 'templates/content/blank', $post_type );
	do_action( 'foresight/theme_hook/content/' . $post_type . '/append' );
endwhile;
do_action( 'foresight/theme_hook/content/append' );
?>
</div>
</main>
</div>
<?php do_action( 'foresight/theme_hook/site/content/after' ); ?>

<?php get_footer(); ?>
