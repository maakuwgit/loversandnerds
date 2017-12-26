<?php
/**
 * The template part for displaying user callouts
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.3.1
 */
 	global $user, $first;
 	
 	$slug = '';
	
	$dir = home_url() . '/wp-content/uploads/';
	$cat = get_queried_object();
	
	if( $cat ) {
		$username = ' ' . $cat->slug;
		$user = get_user_by('slug', $cat->slug);
	}else if( $user ){
		$username = ' ' . $user->user_nicename;
	}else {
		return false;
	}
	
	wp_reset_query();
	
?>
<article class="entry-content callout relative table user<?php echo $username;?>">
<?php
	if( $user->ID === 3 ) {
		get_template_part( 'template-parts/thumbnail', 'user' );
		get_template_part( 'template-parts/header', 'user' );
	}else{
		get_template_part( 'template-parts/header', 'user' );
		get_template_part( 'template-parts/thumbnail', 'user' );
	}
?>
</article>