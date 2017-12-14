<?php
/**
 * The template part for displaying user callouts
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.2.7
 */
	$callout_header = get_option('lans_callout_header');
	$callout_copy = get_option('lans_callout_copy');
	
	$dir = home_url() . '/wp-content/uploads/';
	$cat = get_queried_object();
	$user = get_user_by('slug', $cat->slug);
	$photo = get_user_meta($user->ID, 'photo', true);
	$mphoto = $tphoto = $dphoto = substr($photo,0, strpos($photo, '.'));
	$dphoto = $dphoto . '-1920x525' . substr($photo, strpos($photo, '.'));
	$mphoto = $mphoto . '-640x175' . substr($photo, strpos($photo, '.'));
	$tphoto = $tphoto . '-1024x280' . substr($photo, strpos($photo, '.'));
	if(!$photo) $photo = 'http://placehold.it/2560x700';
	$photo = $dir . $photo;
	$mphoto = $dir . $mphoto;
	$tphoto = $dir . $tphoto;
	$dphoto = $dir . $dphoto;
	$gender = get_user_meta($user->ID, 'gender', true);
	$nickname = get_user_meta($user->ID, 'nickname', true);
	$description = get_user_meta($user->ID, 'description', true);
?>
<article id="user" class="entry-content callout relative table <?php echo $cat->slug;?>" data-background>
	<div class="feature">
		<img alt="" src="<?php echo $mphoto; ?>" data-src-medium="<?php echo $tphoto;?>" data-src-large="<?php echo $dphoto;?>" data-src-xlarge="<?php echo $photo;?>">
	</div>
	<div class="cell small-6 medium-6 large-4 text-center">
		<h1><?php echo $nickname;?></h1>
		<p><?php echo $description;?></p>
	</div>
</article>