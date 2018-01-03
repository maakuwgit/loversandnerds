<?php
/**
 * The template part for displaying default post content
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.3.2
 */
 global $first, $user;
 
 $feature_style = $date_str = $client_str = $bg_img = $header_align = '';
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
	 if($align) $feature_style .= 'background-position:'.$align.' '.$valign.';';
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
		<div id="<?php echo $slug; ?>" <?php post_class('entry-content active' . ($project ? ' project' : '') . $username . $theme); ?> data-background<?php echo $header_align; ?>>
		<?php if( has_post_thumbnail() ) :?>
		 	<div class="feature"<?php echo $feature_style;?>>
				 <img src="<?php echo get_the_post_thumbnail_url($post, 'thumbnail');?>" srcset="<?php echo get_the_post_thumbnail_url($post, 'large');?> 2x, <?php echo get_the_post_thumbnail_url($post, 'fullsize');?> 3x" data-src-medium="<?php echo get_the_post_thumbnail_url($post, 'medium');?>" data-src-large="<?php echo get_the_post_thumbnail_url($post, 'large');?>" data-src-xlarge="<?php echo get_the_post_thumbnail_url($post, 'fullsize');?>" alt="">
			</div>
		<?php endif; ?>
			<header class="entry-header"<?php echo $header_style;?> id="<?php echo $slug; ?>-header">
			<?php if($first == true) :?>
				<h1 class="entry-title"><?php the_title();?><?php edit_post_link(' <em class="lnr lnr-pencil"></em>'); ?></h1>
			<?php else: ?>
				<h2 class="entry-title"><?php the_title();?><?php edit_post_link(' <em class="lnr lnr-pencil"></em>'); ?></h2>
			<?php endif; ?>
			</header>
		<?php if ( has_excerpt() ) : ?>
			<div id="<?php echo $slug; ?>-content" class="entry-body<?php if($project) echo ' project';?>">
				<?php the_excerpt(); ?>
				<nav class="column small-12 text-center">
					<a class="button uppercase strong" href="<?php echo get_the_permalink(); ?>">More&nbsp;<em class="fa fa-angle-right"></em></a>
				</nav>
			</div>
		<?php endif; ?>
		</div>