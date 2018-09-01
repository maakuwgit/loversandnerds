<?php
/**
 * The template part for displaying the project footer navigation
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.3.5
 */
 global $first;
  
 $date_str = $client_str = '';
 $post_id 	= $post->ID;
 $slug 			= $post->post_name;

 $client 		= get_post_meta( $post_id, 'lons_project_client', true );
 $title   	= get_post_meta( $post_id, 'lons_project_title', true );
 $date   		= get_post_meta( $post_id, 'lons_project_year', true );
 $btn_href  = get_post_meta( $post_id, 'lons_project_btn_href', true );
 $btn_label = get_post_meta( $post_id, 'lons_project_btn_label', true ); 
 $git_href 	= get_post_meta( $post_id, 'lons_project_git_href', true );
 $bb_href 	= get_post_meta( $post_id, 'lons_project_repo_href', true );

 $gallery 	= get_post_meta( $post_id, 'lons_gallery', true);
?>
<footer class="entry-footer" id="<?php echo $slug; ?>-footer">
	<?php if( $client || $date ) : ?>
	<h4><?php if( $client ) echo $client; ?><?php if( $date ) echo '&nbsp;|&nbsp;' . $date; ?></h4>
	<?php endif; ?>
	<nav>
		<ul class="inline-list">
		<?php if ( has_excerpt() ) : ?>
			<li>
				<button class="ellipsis button" id="<?php echo $slug; ?>-more" data-show-id="<?php echo $slug;?>">&hellip;</button>
			</li>
		<?php endif; ?>
		<?php if ( $gallery && !has_excerpt() ) : ?>
			<li>
				<button class="button" id="<?php echo $slug; ?>-gallery" data-show-id="<?php echo $slug;?>"><em class="fa fa-photo"></em></button>
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
				<button class="button secondary" data-href="<?php echo $btn_href; ?>" title="<?php echo $btn_label; ?>"><em class="lnr lnr-link"></em></button>
			</li>
		<?php endif; ?>
		</ul>
	</nav>
</footer>