<?php
/**
 * Lovers & Nerds functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Lovers_&_Nerds
 * @since 5.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lons_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/lons
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'lons' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'lons' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'lons-featured-image', 2000, 1200, true );

	add_image_size( 'lons-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'lons' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

}
add_action( 'after_setup_theme', 'lons_setup' );

/**
 * Enqueue scripts and styles.
 */
function lons_scripts() {
	// Theme stylesheet.
	wp_enqueue_style( 'lons-style',  get_stylesheet_uri() );
//Minified version	wp_enqueue_style( 'lons-style', get_template_directory_uri() . '/style.min.css' );
	
	// Theme js.
	wp_enqueue_script( 'lons-scripts', get_template_directory_uri() . '/assets/js/global.js', array('jquery'), 0.1, true );

}
add_action( 'wp_enqueue_scripts', 'lons_scripts' );