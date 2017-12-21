<?php
/**
 * The template part for displaying user callouts
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.2.9
 */
	$callout_header = get_option('lans_callout_header');
	$callout_copy = get_option('lans_callout_copy');
	
	$dir = home_url() . '/wp-content/uploads/';
	$cat = get_queried_object();
	$user = get_user_by('slug', $cat->slug);
	$photo = get_user_meta($user->ID, 'photo', true);
	
	wp_reset_query();
	
	if(!$photo) $photo = 'http://placehold.it/2560x700';
	$xlphoto = wp_get_attachment_image_src($photo, 'fullsize' );
	$mphoto = wp_get_attachment_image_src($photo, 'medium' );
	$tphoto = wp_get_attachment_image_src($photo);
	$dphoto = wp_get_attachment_image_src($photo, 'large' );
	$gender = get_user_meta($user->ID, 'gender', true);
	$nickname = get_user_meta($user->ID, 'nickname', true);
	$description = get_user_meta($user->ID, 'description', true);
	
	if( $user->ID === 3 ) :
?>
<article id="user" class="entry-content callout relative table <?php echo $cat->slug;?>" data-background>
	<div class="feature">
		<img alt="" src="<?php echo $tphoto[0]; ?>" data-src-medium="<?php echo $mphoto[0];?>" data-src-large="<?php echo $dphoto[0];?>" data-src-xlarge="<?php echo $xlphoto[0];?>">
	</div>
	<div class="cell small-6 medium-6 large-4 text-center">
		<h1><?php echo $nickname;?></h1>
		<p><?php echo $description;?></p>
	</div>
</article>
<?php else: ?>
<article id="user" class="entry-content callout relative table <?php echo $cat->slug;?>">
	<div class="cell small-6 medium-6 large-4 text-center">
		<h1><?php echo $nickname;?></h1>
		<p><?php echo $description;?></p>
	</div>
	<figure class="cell small-6 medium-6 large-8 text-center" data-background>
		<div class="feature">
			<img alt="" src="<?php echo $mphoto[0]; ?>" data-src-medium="<?php echo $mphoto[0];?>" data-src-large="<?php echo $dphoto[0];?>" data-src-xlarge="<?php echo $xlphoto[0];?>">
		</div>
	</figure>
</article>
<?php endif; ?>