<?php
/**
 * The template part for displaying default post content
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.3
 */
 	global $user;
 
	$photo = get_user_meta($user->ID, 'photo', true);
 
	if(!$photo) $photo = 'http://placehold.it/2560x700';
	$xlphoto = wp_get_attachment_image_src($photo, 'fullsize' );
	$mphoto = wp_get_attachment_image_src($photo, 'medium' );
	$tphoto = wp_get_attachment_image_src($photo, 'thumbnail');
	$dphoto = wp_get_attachment_image_src($photo, 'large' );
 
?>
<figure class="cell small-6 medium-6 large-8 text-center" data-background>
	<div class="feature">
		<img alt="" src="<?php echo $tphoto[0]; ?>" data-src-medium="<?php echo $mphoto[0];?>" data-src-large="<?php echo $dphoto[0];?>" data-src-xlarge="<?php echo $xlphoto[0];?>">
	</div>
</figure>