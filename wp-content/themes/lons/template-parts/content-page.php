<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 1.3
 */
?>
	<div <?php post_class('entry-content active'); ?> data-background>
	<?php
	 if( has_post_thumbnail() ) :?>
	 	<div class="feature">
				 <img src="<?php echo get_the_post_thumbnail_url($post, 'medium');?>" srcset="<?php echo get_the_post_thumbnail_url($post, 'large');?> 2x, <?php echo get_the_post_thumbnail_url($post, 'fullsize');?> 3x" data-src-large="<?php echo get_the_post_thumbnail_url($post, 'large');?>" data-src-xlarge="<?php echo get_the_post_thumbnail_url($post, 'fullsize');?>" alt="">
		</div>
	 <?php endif; ?>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title();?><?php edit_post_link(' <em class="fa fa-pencil"></em>'); ?></h1>
		</header>
		<div class="entry-body">
			<?php the_content(); ?>
		</div>
	</div>