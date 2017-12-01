<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.1.6.7
 */
 global $first;
 
 $feature_style = $date_str = $client_str = $bg_img = '';
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
 $git_href 	= get_post_meta( $post_id, 'lons_project_git_href', true );
 $bb_href 	= get_post_meta( $post_id, 'lons_project_repo_href', true );
}

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
				 <img src="<?php echo get_the_post_thumbnail_url($post, 'medium');?>" srcset="<?php echo get_the_post_thumbnail_url($post, 'large');?> 2x, <?php echo get_the_post_thumbnail_url($post, 'fullsize');?> 3x" data-src-medium="<?php echo get_the_post_thumbnail_url($post, 'medium');?>" data-src-large="<?php echo get_the_post_thumbnail_url($post, 'large');?>" data-src-xlarge="<?php echo get_the_post_thumbnail_url($post, 'fullsize');?>" alt="">
			</div>
		 <?php endif; ?>
			<header class="entry-header"<?php echo $header_style;?> id="<?php echo $slug; ?>-header">
			<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
				<span class="sticky-post"><?php _e( 'Featured', 'twentysixteen' ); ?></span>
			<?php endif; ?>
			<?php if($first == true) :?>
				<h1 class="entry-title"><?php the_title();?></h1>
			<?php else: ?>
				<h2 class="entry-title"><?php the_title();?></h2>
			<?php endif; ?>
			</header>
		<?php if ( has_excerpt() ) : ?>
			<div id="<?php echo $slug; ?>-content" class="entry-body">
				<?php the_excerpt(); ?>
			</div>
		<?php endif; ?>
		<?php if( '' !== $project ): ?>
			<footer class="entry-footer" id="<?php echo $slug; ?>-footer">
				<ul class="inline-list">
				<?php if( $client || $date ) : ?>
					<li>
						<h3>
						<?php if( $client ) echo $client; ?>
						<?php if( $date ) echo '&nbsp;|&nbsp;' . $date; ?>
						</h3>
					</li>
				<?php endif; ?>
				<?php if ( has_excerpt() ) : ?>
					<li>
						<button class="ellipsis button" id="<?php echo $slug; ?>-more" data-show-id="<?php echo $slug;?>">&bull;&bull;&bull;</button>
					</li>
				<?php endif; ?>
				<?php if( $bb_href ) : ?>
					<li>
						<button class="button" data-href="<?php echo $bb_href; ?>"><em class="fa fa-bitbucket"></em></button>
					</li>
				<?php endif; ?>
				<?php if( $git_href ) : ?>
					<li>
						<button class="button" data-href="<?php echo $git_href; ?>"><em class="fa fa-github"></em></button>
					</li>
				<?php endif; ?>
				<?php if( $btn_href ) : ?>
					<li>
						<button class="button secondary" data-href="<?php echo $btn_href; ?>" title="<?php echo $btn_label; ?>"><em class="fa fa-external-link"></em></button>
					</li>
				<?php endif; ?>
				<?php if( is_admin() ) : ?>
					<li>
						<a class="button" href="<?php echo get_edit_post_link($post_id);?>"><em class="fa fa-pencil"></em></a>
					</li>
				<?php endif; ?>
				</ul>
			</footer>
			<?php endif; ?>
		</div>