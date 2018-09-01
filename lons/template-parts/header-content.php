<?php
/**
 * The template part for displaying the project footer navigation
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.3
 */
global $first;
  
 $post_id 	= $post->ID;
 $slug 			= $post->post_name;
?>
<header class="entry-header" id="<?php echo $slug; ?>-header">
<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
	<span class="sticky-post"><?php _e( 'Featured', 'lons' ); ?></span>
<?php endif; ?>
<?php if($first == true) :?>
	<h1 class="entry-title"><?php the_title();?><?php edit_post_link('&nbsp;<em class="lnr lnr-pencil"></em>'); ?></h1>
<?php else: ?>
	<h2 class="entry-title"><?php the_title();?><?php edit_post_link('&nbsp;<em class="lnr lnr-pencil"></em>'); ?></h2>
<?php endif; ?>
</header>