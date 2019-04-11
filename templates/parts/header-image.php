<?php
/**
 * The header image
 *
 * @package Ace
 */

?>
<?php if ( has_header_image() ) : ?>
<div class="site-header-image">
<img src="<?php header_image(); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" alt="">
</div>
<?php endif; ?>
