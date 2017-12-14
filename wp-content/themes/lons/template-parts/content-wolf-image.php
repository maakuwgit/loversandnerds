<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.1.1
 */

 $cat = get_queried_object();
 $user = get_user_by('slug', $cat->slug);
 $nickname = get_user_meta($user->ID, 'nickname', true);
 
 $feature_style = $date_str = $client_str = $bg_img = $header_align = $content_style = '';
 $header_style = false;
 $post_id 	= $post->ID;
 $slug 			= $post->post_name;
 $project 	= get_post_meta( $post_id, 'lons_is_project', true );
 
if( '' !== $project ) {
 $client 		= get_post_meta( $post_id, 'lons_project_client', true );
 $title   	= get_post_meta( $post_id, 'lons_project_title', true );
 $date   		= get_post_meta( $post_id, 'lons_project_year', true );
 $btn_href  = get_post_meta( $post_id, 'lons_project_btn_href', true );
 $btn_label = get_post_meta( $post_id, 'lons_project_btn_label', true ); 
 $repo_href = get_post_meta( $post_id, 'lons_project_repo_href', true );
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
 if($header_style) $header_style = ' style=""';
}
?>
		<div id="<?php echo $slug; ?>" <?php post_class('entry-content light active' . ($project ? ' project' : ''));?>>
		<?php
		 if( has_post_thumbnail() ) :?>
		 	<div class="feature" data-background<?php echo $feature_style . $header_align; ?>>
				 <img src="<?php echo get_the_post_thumbnail_url($post, 'thumbnail');?>" srcset="<?php echo get_the_post_thumbnail_url($post, 'large');?> 2x, <?php echo get_the_post_thumbnail_url($post, 'fullsize');?> 3x" data-src-medium="<?php echo get_the_post_thumbnail_url($post, 'medium');?>" data-src-large="<?php echo get_the_post_thumbnail_url($post, 'large');?>" data-src-xlarge="<?php echo get_the_post_thumbnail_url($post, 'fullsize');?>" alt="">
			</div>
		 <?php endif; ?>
			<header class="entry-header"<?php echo $header_style;?> id="<?php echo $slug; ?>-header">
				<div class="row">
				<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
					<span class="sticky-post"><?php _e( 'Featured', 'twentysixteen' ); ?></span>
				<?php endif; ?>
					<h2 class="entry-title"><?php the_title();?>
					<?php if( current_user_can('edit_post', $post_id ) ) : ?>
						<a href="<?php echo get_edit_post_link($post_id);?>"><em class="fa fa-pencil"></em></a>
					<?php endif; ?>
					</h2>
					<h4 class="text-light">
					<?php if( $client || $date ) : ?>
						<?php echo $nickname; ?>
						<?php if( $client ) echo ' for ' . $client; ?>
						<?php if( $date ) echo '&nbsp;|&nbsp;' . $date; ?>
					<?php endif; ?>
					</h4>
				</div>
			</header>
		<?php if ( has_excerpt() ) : ?>
			<div id="<?php echo $slug; ?>-content" class="entry-body<?php if($project) echo ' project';?>">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>
		<?php if( '' !== $btn_href ): ?>
			<footer class="entry-footer" id="<?php echo $slug; ?>-footer">
				<ul class="inline-list">
					<li>
						<button class="button secondary" data-href="<?php echo $btn_href; ?>" title="<?php echo $btn_label; ?>"><em class="fa fa-external-link"></em></button>
					</li>
				</ul>
			</footer>
			<?php endif; ?>
		</div>