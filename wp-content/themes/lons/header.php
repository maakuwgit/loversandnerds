<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.2.6
 */
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
				<a href="#menu-open" data-toggle="colophon" class="hide">
					<span class="fa fa-bars"></span>
				</a>
				<?php if( is_category() ) echo '<a href="' . get_bloginfo('url') . '" class="home"><em class="fa fa-home"></em></a>';?>
				<figure class="title-bar-title">
					<figcaption>
					<?php if( is_single() ) : ?>
						<a href="<?php bloginfo('url');?>" class="logo"><?php bloginfo('name'); ?></a>
					<?php elseif( is_category() ) : 
							$cats = get_the_category();
							$href = home_url();
							if($cats) {
								$href .= '/' . get_option( 'category_base' ) . '/';
								foreach($cats as $cat){
									$href .= $cat->slug;
								}
							}
					?>
						<a href="<?php echo $href;?>" class="logo"><?php echo single_cat_title(); ?></a>
					<?php else: ?>
						<a href="#top" class="logo">
							<?php bloginfo('name'); ?>
						</a>
					<?php endif; ?>
					</figcaption>
				</figure>
			  <nav class="title-bar-right">
					<a href="<?php echo bloginfo('url') . '/wp-admin';?>">
						<em class="fa fa-cog"></em>
					</a>
					<a href="#twitter-feed">
						<em class="fa fa-twitter"></em>
					</a>
			  </nav>
			</header>
