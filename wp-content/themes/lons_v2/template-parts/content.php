<?php
/**
 * The template part for displaying default post content
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 1.4
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
		 $header_style = ' style="background-position:';
		 if($align) $header_style .= $align;
		 if($align & $valign){
			 $header_style .= ' ' .$valign.';"';
		 }else{
			 $header_style .= $valign . ';"';
			}
	 }
	 $feature_style .= '"';
 }?>
<div>
<?php if( has_post_thumbnail() ) : ?>
	<?php if( get_the_post_thumbnail() !== '' ) : ?>
 	<figure <?php post_class('entry-content active'); ?> data-background<?php echo $header_align . $header_style; ?>>
 		<div class="feature"<?php echo $feature_style;?>>
			 <img src="<?php echo get_the_post_thumbnail_url($post, 'thumbnail');?>" srcset="<?php echo get_the_post_thumbnail_url($post, 'large');?> 2x, <?php echo get_the_post_thumbnail_url($post, 'fullsize');?> 3x" data-src-medium="<?php echo get_the_post_thumbnail_url($post, 'medium');?>" data-src-large="<?php echo get_the_post_thumbnail_url($post, 'large');?>" data-src-xlarge="<?php echo get_the_post_thumbnail_url($post, 'fullsize');?>" alt="">
 		</div>
	 	<figcaption>
			<?php if($first == true) :?>
				<h1><?php the_title();?><?php edit_post_link(' <em class="fa fa-pencil"></em>'); ?></h1>
			<?php else: ?>
				<h2 class="entry-title"><?php the_title();?><?php edit_post_link(' <em class="fa fa-pencil"></em>'); ?></h2>
			<?php endif; ?>
			<?php if ( has_excerpt() ) : ?>
			<h3><?php the_excerpt(); ?></h3>
			<?php endif; ?>
		</figcaption>
	</figure>
	<?php else : ?>
	<section>
		<?php if($first == true) :?>
			<h1><?php the_title();?><?php edit_post_link(' <em class="fa fa-pencil"></em>'); ?></h1>
		<?php else: ?>
			<h2 class="entry-title"><?php the_title();?><?php edit_post_link(' <em class="fa fa-pencil"></em>'); ?></h2>
		<?php endif; ?>
		<?php if ( has_excerpt() ) : ?>
		<h3><?php the_excerpt(); ?></h3>
		<?php endif; ?>
	</section>
	<?php endif; ?>
<?php endif; ?>
</div>