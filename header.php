<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.3.3
 */
	global $post;
	
	$href = home_url();
	$user = wp_get_current_user();
	$user_url = $admin_url = get_bloginfo('url') . '/wp-admin';
 
	if ( $post ) {
		if( current_user_can('publish_posts', $post->ID ) ) {
			$user_url = $admin_url . '/user-edit.php?user_id=' . $user->ID;
		}
	}
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <div class="site-inner off-canvas-wrapper">
    <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper data-sticky-container>
			<header id="masthead" class="site-header title-bar sticky" data-sticky data-stick-to="top">
				<a href="#menu-open" data-toggle="colophon">
					<span class="lnr lnr-menu"></span>
				</a>
				<?php if( is_archive() ) echo '<a href="' . get_bloginfo('url') . '" class="home"><em class="lnr lnr-home"></em></a>';?>
				<figure class="title-bar-title">
					<figcaption>
					<?php if( is_single() ) : ?>
						<a href="<?php bloginfo('url');?>" class="logo"><?php bloginfo('name'); ?></a>
					<?php elseif( is_category() ) : 
							$cats = get_the_category();
							if($cats) {
								$href .= '/' . get_option( 'category_base' ) . '/';
								foreach($cats as $cat){
									$href .= $cat->slug;
								}
							}
					?>
						<a href="<?php echo $href;?>" class="logo"><?php echo single_cat_title(); ?></a>
					<?php elseif( is_archive() ) :
							$user = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
							$username = get_the_author();
							if($username === 'maakuw') $username = '真ー久W';
					?>
						<a href="<?php echo $href;?>" class="logo"><?php echo $username; ?></a>
					<?php else: ?>
						<a href="#top" class="logo"><?php bloginfo('name'); ?></a>
					<?php endif; ?>
					</figcaption>
				</figure>
			  <nav class="title-bar-right">
				<?php if( is_user_logged_in() ) : ?>
					<a href="<?php echo $admin_url;?>">
						<em class="fa fa-cog"></em>
					</a>
				<?php endif; ?>
					<a href="<?php echo $user_url;?>">
						<em class="fa fa-user"></em>
					</a>
				<?php if ( shortcode_exists( 'nu_tweets' ) ) : ?>
					<a href="#twitter-feed">
						<em class="fa fa-twitter"></em>
					</a>
				<?php endif; ?>
			  </nav>
			</header>
