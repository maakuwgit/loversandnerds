<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.3.4
 */
 global $first, $user;
 
 $feature_style = $date_str = $client_str = $bg_img = $header_align = '';
 $post_id 	= $post->ID;
 $slug 			= $post->post_name;
 $project 	= get_post_meta( $post_id, 'lons_is_project', true );

 $color   	= get_post_meta( $post_id, 'lons_project_color', true );
 $theme   	= get_post_meta( $post_id, 'lons_project_theme', true );
 $align   	= get_post_meta( $post_id, 'lons_project_theme_align', true );
 $valign   	= get_post_meta( $post_id, 'lons_project_theme_valign', true );

 $gallery 	= get_post_meta( $post_id, 'lons_gallery', true);

 if($align || $color){
	 $feature_style = ' style="';
	 if($color) $feature_style .= 'background-color:'.$color.';';
	 if($align){
		 $header_align = 'data-align="'.$align.'"';
		 $feature_style .= 'background-position:'.$align.' '.$valign.';';
	 }
	 $feature_style .= '"';
 }

	if( $user ){
		$username = ' ' . $user->user_nicename . ' ';
	}else {
		$user = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
		$username = ' ' . get_the_author() . ' ';
	}
?>
		<div id="<?php echo $slug; ?>" <?php post_class('entry-content' . ($project ? ' project' : '') . $username . $theme); ?> data-background<?php echo $feature_style . $header_align; ?>>
		<?php
		 if( has_post_thumbnail() ) :?>
		 	<div class="feature">
				 <img src="<?php echo get_the_post_thumbnail_url($post, 'medium');?>" srcset="<?php echo get_the_post_thumbnail_url($post, 'large');?> 2x, <?php echo get_the_post_thumbnail_url($post, 'fullsize');?> 3x" data-src-large="<?php echo get_the_post_thumbnail_url($post, 'large');?>" data-src-xlarge="<?php echo get_the_post_thumbnail_url($post, 'fullsize');?>" alt="">
			</div>
		 <?php endif; ?>
		 <?php get_template_part('template-parts/header', 'content'); ?>
		<?php if ( $gallery || has_excerpt() ) : ?>
			<div id="<?php echo $slug; ?>-content" class="entry-body<?php if($project) echo ' project';?>">
			<?php 
				if( has_excerpt() ) the_excerpt();
				if ( $gallery ) echo do_shortcode('[gallery ids="'.$gallery.'"]');
			?>
			</div>
		<?php endif; ?>
		<?php if( '' !== $project ) get_template_part('template-parts/footer', 'project'); ?>
		</div>