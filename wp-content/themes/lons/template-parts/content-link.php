<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.2.9
 */
 global $first;
  
 $feature_style = $date_str = $client_str = $bg_img = '';
 $header_style = false;
 $post_id 	= $post->ID;
 $slug 			= $post->post_name;
 $project 	= get_post_meta( $post_id, 'lons_is_project', true );

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
		<div id="<?php echo $slug; ?>" <?php post_class('entry-content' . ($project ? ' project ' : ' ') . $theme); ?> data-background<?php echo $feature_style; ?>>
		<?php
		 if( has_post_thumbnail() ) :?>
		 	<div class="feature">
				 <img src="<?php echo get_the_post_thumbnail_url($post, 'thumbnail');?>" srcset="<?php echo get_the_post_thumbnail_url($post, 'large');?> 2x, <?php echo get_the_post_thumbnail_url($post, 'fullsize');?> 3x" data-src-medium="<?php echo get_the_post_thumbnail_url($post, 'medium');?>" data-src-large="<?php echo get_the_post_thumbnail_url($post, 'large');?>" data-src-xlarge="<?php echo get_the_post_thumbnail_url($post, 'fullsize');?>" alt="">
			</div>
		 <?php endif; ?>
			<header class="entry-header"<?php echo $header_style;?> id="<?php echo $slug; ?>-header">
			<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
				<span class="sticky-post"><?php _e( 'Featured', 'twentysixteen' ); ?></span>
			<?php endif; ?>
			<?php if($first == true) :?>
				<h1 class="entry-title"><?php the_title();?><?php edit_post_link(' <em class="lnr lnr-pencil"></em>'); ?></h1>
			<?php else: ?>
				<h2 class="entry-title"><?php the_title();?><?php edit_post_link(' <em class="lnr lnr-pencil"></em>'); ?></h2>
			<?php endif; ?>
			</header>
		<?php if ( has_excerpt() ) : ?>
			<div id="<?php echo $slug; ?>-content" class="entry-body<?php if($project) echo ' project';?>">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>
		<?php if( '' !== $project ) get_template_part('template-parts/footer', 'project'); ?>
		</div>