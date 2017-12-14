<?php
/**
 * The template part for displaying default post content
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.2
 */
 global $first;

 $cat = get_queried_object();
 $user = get_user_by('slug', $cat->slug);
 $nickname = get_user_meta($user->ID, 'nickname', true);
 
 $post_id 	= $post->ID;
 $slug 			= $post->post_name;
 $color   	= get_post_meta( $post_id, 'lons_project_color', true );
 $theme   	= get_post_meta( $post_id, 'lons_project_theme', true );
 $align   	= get_post_meta( $post_id, 'lons_project_theme_align', true );
 $valign   	= get_post_meta( $post_id, 'lons_project_theme_valign', true );

 if($align || $color){
	 $feature_style = $content_style = ' style="';
	 if($color){
		 $content_style .= 'background-color:'.$color.';"';
		 $feature_style .= 'background-color:'.$color.';';
	 }
	 if($align){
		 $header_align = 'data-align="'.$align.'"';
		 $feature_style .= 'background-position:'.$align.' '.$valign.';';
	 }
	 $feature_style .= '"';
 }

?>
<article id="<?php echo $slug; ?>" <?php post_class('entry-content active light'); ?>>
	<div class="table row">
	<?php if( has_post_thumbnail() ) :?>
		 	<figure class="th small-12 medium-4 large-3 cell">
				<div class="hero" data-background<?php echo $feature_style . $header_align; ?>>
					<img src="<?php echo get_the_post_thumbnail_url($post, 'thumbnail');?>" srcset="<?php echo get_the_post_thumbnail_url($post, 'large');?> 2x, <?php echo get_the_post_thumbnail_url($post, 'fullsize');?> 3x" data-src-medium="<?php echo get_the_post_thumbnail_url($post, 'medium');?>" data-src-large="<?php echo get_the_post_thumbnail_url($post, 'large');?>" data-src-xlarge="<?php echo get_the_post_thumbnail_url($post, 'fullsize');?>" alt="">
				</div>
			</figure>
	<?php endif; ?>
	<?php if ( has_excerpt() ) : ?>
			<div id="<?php echo $slug; ?>-content" class="entry-body small-12 medium-8 large-9 cell">
				<h2 class="entry-title"><a href="<?php echo get_the_permalink(); ?>"><?php the_title();?></a><?php edit_post_link(' <em class="fa fa-pencil"></em>'); ?></h2>
				<h4 class="text-light"><?php echo $nickname;?> | <?php the_date(); ?></h4>
				<p><?php echo get_the_excerpt(); ?></p>
				<p><small><?php the_tags(false); ?></small></p>
			</div>
	<?php endif; ?>
</article>