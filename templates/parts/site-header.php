<?php
/**
 * The site header for our theme
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ace
 */

?>
<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
<div class="site-logo">
	<?php the_custom_logo(); ?>
</div>
<?php endif; ?>
<div class="site-branding">
<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
<?php
$description = get_bloginfo( 'description', 'display' );
if ( $description || is_customize_preview() ) :
	?>
	<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
<?php endif; ?>
</div><!-- .site-branding -->
