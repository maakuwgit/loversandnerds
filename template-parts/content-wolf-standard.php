<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 1.6
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
	 if($align) $feature_style .= 'background-position:'.$align;
	 if($valign) {
		 $feature_style .= ' ' . $valign.';';
	 }else{
		 $feature_style .= ' top;';
	 }
	 $feature_style .= '"';
 }
 if($header_style) $header_style = ' style=""';
?>
		<div id="<?php echo $slug; ?>" <?php post_class('entry-content'); ?>  data-background<?php echo $header_align; ?>>
		<?php
		 if( has_post_thumbnail() ) :?>
		 	<div class="feature"<?php echo $feature_style;?>>
				 <img src="<?php echo get_the_post_thumbnail_url($post, 'medium');?>" srcset="<?php echo get_the_post_thumbnail_url($post, 'large');?> 2x, <?php echo get_the_post_thumbnail_url($post, 'fullsize');?> 3x" data-src-large="<?php echo get_the_post_thumbnail_url($post, 'large');?>" data-src-xlarge="<?php echo get_the_post_thumbnail_url($post, 'fullsize');?>" alt="">
			</div>
		 <?php endif; ?>
		 <?php get_template_part('template-parts/header', 'content'); ?>
		<?php if ( has_excerpt() ) : ?>
			<div id="<?php echo $slug; ?>-content" class="entry-body<?php if($project) echo ' project';?>">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>
		</div>