<?php
/**
 * The template part for displaying single posts 
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.1.6.6
 */
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
		 $header_align = 'data-align="'.$align.'"';
		 $feature_style .= 'background-position:'.$align.' '.$valign.';';
	 }
	 $feature_style .= '"';
 }
 if($header_style) $header_style = ' style=""';
?>	
		<div id="post-<?php the_ID(); ?>" <?php post_class('entry-content active row expanded'); ?>>
			<div class="entry-body">
				<h1 class="entry-title"><?php the_title();?>
			<?php if( current_user_can('edit_post', $post_id ) ) : ?>
						<a href="<?php echo get_edit_post_link($post_id);?>"><em class="lnr lnr-pencil"></em></a>
			<?php endif; ?></h1>
				<?php the_content(); ?>
			</div>
		</div>