<?php
/**
 * The template part for displaying default post content
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.3.4
 */
  global $first;
 
 $feature_style = $bg_img = $header_align = '';
 $header_style = false;
 $post_id 	= $post->ID;
 $slug 			= $post->post_name;
 $color   	= get_post_meta( $post_id, 'lons_project_color', true );
 $theme   	= get_post_meta( $post_id, 'lons_project_theme', true );
 $align   	= get_post_meta( $post_id, 'lons_project_theme_align', true );
 $valign   	= get_post_meta( $post_id, 'lons_project_theme_valign', true );

 if($align || $color){
	 $feature_style = ' style="';
	 if($color) $feature_style .= 'background-color:'.$color.';';
	 if($align){
		 $header_align = ' data-align="'.$align.'"';
		 $feature_style .= 'background-position:'.$align.' '.$valign.';';
	 }
	 $feature_style .= '"';
 }
 
 if($header_style) $header_style = ' style=""';?>
<div data-href="<?php echo get_the_permalink(); ?>" data-target="_self">
	<?php if( has_post_thumbnail() ) : ?>
		<?php if( get_the_post_thumbnail() !== '' ) : ?>
	<dd <?php post_class('relative'); ?> data-background<?php echo $header_align; ?>>
		<img<?php echo $feature_style;?> src="<?php echo get_the_post_thumbnail_url($post, 'thumbnail');?>" srcset="<?php echo get_the_post_thumbnail_url($post, 'large');?> 2x, <?php echo get_the_post_thumbnail_url($post, 'fullsize');?> 3x" data-src-medium="<?php echo get_the_post_thumbnail_url($post, 'medium');?>" data-src-large="<?php echo get_the_post_thumbnail_url($post, 'large');?>" data-src-xlarge="<?php echo get_the_post_thumbnail_url($post, 'fullsize');?>" alt="">
	</dd>
		<?php endif; ?>
	<?php else: ?>
	<dd></dd>
	<?php endif; ?>
	<dt>
		<h6><?php the_title();?><?php edit_post_link(' <em class="lnr lnr-pencil"></em>'); ?></h6>
		<?php if ( has_excerpt() ) : ?>
		<?php // the_excerpt(); ?>
		<?php endif; ?>
	</dt>
</div>