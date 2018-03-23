<?php
/**
 * The template part for displaying single posts 
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers&Nerds 2.3.3.2
 */
 global $user;
  
 $feature_style = $bg_img = $header_align = '';
 $header_style = false;
 $post_id 	= $post->ID;
 $slug 			= $post->post_name;
 $project 	= get_post_meta( $post_id, 'lons_is_project', true );
 if ( $project ) { 
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
 
 if($header_style) $header_style = ' style=""';

	if( $user ){
		$username = ' ' . $user->user_nicename . ' ';
	}else {
		$user = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
		$username = ' ' . get_the_author() . ' ';
	}
?>
	<?php if( $project && has_post_thumbnail() ) : ?>
		<div <?php post_class('entry-content' . ($project ? ' project' : '') . $username . $theme); ?> data-background<?php echo $feature_style; ?>>
		 	<div class="feature">
				 <img src="<?php echo get_the_post_thumbnail_url($post, 'thumbnail');?>" srcset="<?php echo get_the_post_thumbnail_url($post, 'large');?> 2x, <?php echo get_the_post_thumbnail_url($post, 'fullsize');?> 3x" data-src-medium="<?php echo get_the_post_thumbnail_url($post, 'medium');?>" data-src-large="<?php echo get_the_post_thumbnail_url($post, 'large');?>" data-src-xlarge="<?php echo get_the_post_thumbnail_url($post, 'fullsize');?>" alt="">
			</div>
		 <?php get_template_part('template-parts/header', 'content'); ?>
		 <?php if( $client || $date ) : ?>
			<div class="entry-footer">
				<h4><?php if( $client ) echo $client; ?><?php if( $date ) echo '&nbsp;|&nbsp;' . $date; ?></h4>
				<?php
					$posttags = get_the_tags();
					if ($posttags) :
				?>
				<nav>
					<?php
					  foreach($posttags as $tag) {
					    echo '<a href="' . get_home_url() . '/tag/' . $tag->slug .'" rel="tag">' . $tag->name . '</a>'; 
					  }
					?>
				</nav>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
		<div id="<?php echo $slug; ?>" <?php post_class('entry-content active row expanded light' . ($project ? ' project' : '') . $username ); ?>>
		<?php if ( $gallery || '' !== get_the_content() || has_excerpt() ) : ?>
			<div id="<?php echo $slug; ?>-content" class="entry-body project">
			<?php 
				if( '' !== get_the_content() ) {
					the_content();
				}else{
					the_excerpt();
				}
				if ( $gallery ) echo do_shortcode('[gallery ids="'.$gallery.'"]');
			?>
			</div>
		<?php endif; ?>
		</div>
		<?php	include( locate_template('template-parts/nav-next.php') ); ?>
	<?php else : ?>
		<div id="<?php echo $slug; ?>" <?php post_class('entry-content active row expanded' . ($project ? ' project' : '') . $username . $theme ); ?>>
			<div class="entry-body">
				<h1 class="entry-title"><?php the_title();?>
			<?php if( current_user_can('edit_post', $post_id ) ) : ?>
						<a href="<?php echo get_edit_post_link($post_id);?>"><em class="lnr lnr-pencil"></em></a>
			<?php endif; ?></h1>
				<?php  the_content(); ?>
			</div>
		</div>
	<?php endif; ?>