<?php
/**
 * The template part for displaying user callouts
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.3.3
 */
 	global $user, $first;
 	
 	$slug = '';
	$cat = get_queried_object();
	
	if( $cat ) {
		if( $cat->slug) {
			$username = ' ' . $cat->slug;
			$user = get_user_by('slug', $cat->slug);
		}else{
			$user = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
			$username = ' ' . get_query_var('author_name');
		}
	}else if( $user ){
		$username = ' ' . $user->user_nicename;
	}else {
		$user = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
		$username = ' ' . get_the_author();
	}
	
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