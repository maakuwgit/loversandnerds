<?php
/**
 * Lovers + Nerds functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.3.2
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own twentysixteen_setup() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
	 * If you're building a theme based on Twenty Sixteen, use a find and replace
	 * to change 'twentysixteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentysixteen' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
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
		'bike', 
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	//remove_filter( 'the_content', 'wpautop' );

}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Sixteen.
 *
 * Create your own twentysixteen_fonts_url() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentysixteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'lons' ) ) {
		$fonts[] = 'Roboto:400,400i,700,700i';
	}
	
	/* translators: If there are characters in your language that are not supported by Handlee, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto Slab font: on or off', 'lons' ) ) {
		$fonts[] = 'Roboto+Slab';
	}
	

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Lovers + Nerds 2.1.6.7
 */
function frontend_enqueue() {
	
	$server = $_SERVER['SERVER_NAME'];
	$template_dir = get_template_directory_uri();
	
	//Theme stylesheets.
	wp_enqueue_style( 'lons-style', $template_dir . '/style.min.css', array('core_styles'), '2.2.8' );
}
/**
 * Enqueues scripts and styles.
 *
 * @since Lovers + Nerds 2.1.6.7
 */
function global_enqueue() {
	
	$server = $_SERVER['SERVER_NAME'];
	$template_dir = get_template_directory_uri();
	
	wp_enqueue_style( 'core_styles', $template_dir . '/assets/css/base.min.css', array(), '2.2.5' );
	
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'roboto_slab', '//fonts.googleapis.com/css?family=Roboto+Slab', array(), null);
	wp_enqueue_style( 'roboto', '//fonts.googleapis.com/css?family=Roboto:400,400i,700,700i', array(), null);
	
	// Add Icon Fonts, used in the main stylesheet.
	wp_enqueue_style( 'font-awesome', $template_dir . '/assets/css/font-awesome.min.css', array(), '4.6.3' );
	wp_enqueue_style( 'linearicons', $template_dir . '/assets/css/linearicons.css', array(), '1.1.8' );

	//Libraries
	wp_enqueue_script( 'backgrounder', $template_dir . '/assets/js/backgrounder.js', array( 'jquery' ), '0.1', true );
	wp_enqueue_script( 'breakpoints', $template_dir . '/assets/js/breakpoints.js', array(), '0.1', true );

	wp_enqueue_script( 'scrollmagic', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js', array( 'jquery' ), '2.0.5', true );
	wp_enqueue_script( 'scrollmagic-indicators', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js', array( 'jquery', 'scrollmagic' ), '2.0.5', true );
	wp_enqueue_script( 'tweenmax', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/TweenMax.min.js', array( 'jquery' ), '1.18.0', true );
	wp_enqueue_script( 'scrollto', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.19.0/plugins/ScrollToPlugin.min.js', array( 'jquery' ), '1.8.1', true );
	
	wp_enqueue_script( 'cssplugin', $template_dir . '/assets/js/vendor/CSSPlugin.min.js', array( 'jquery' ), '1.18.0', true );
	
	//Core functions
	wp_enqueue_script( 'font-awesome', 'https://use.fontawesome.com/bac5c1e8d6.js', array(),'bac5c1e8d6', true );
	
	//Dev Note: Return here and make this today's date
	wp_enqueue_script( 'global_functions', $template_dir . '/assets/js/functions.js', array( 'jquery', 'backgrounder', 'breakpoints' ), '2.1.3', true );

}
add_action( 'wp_enqueue_scripts', 'frontend_enqueue' );
add_action( 'wp_enqueue_scripts', 'global_enqueue' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10 , 3 );

function lons_register_posttypes() {
	$labels = array(
		'name'               => _x( 'Bikes', 'bike type general name', 'lons' ),
		'singular_name'      => _x( 'Bike', 'bike type singular name', 'lons' ),
		'add_new'            => _x( 'Add New', 'bike item', 'lons' ),
		'add_new_item'       => __( 'Add New Bike', 'lons' ),
		'edit_item'          => __( 'Edit Bike', 'lons' ),
		'new_item'           => __( 'New Bike', 'lons' ),
		'all_items'          => __( 'All Bikes', 'lons' ),
		'view_item'          => __( 'View Bike', 'lons' ),
		'search_items'       => __( 'Search Bikes', 'lons' ),
		'not_found'          => __( 'Nothing found', 'lons' ),
		'not_found_in_trash' => __( 'Nothing found in Trash', 'lons' ),
		'parent_item_colon'  => '',
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => false,
		'can_export'         => true,
		'show_in_nav_menus'  => true,
		'query_var'          => true,
		'has_archive'        => false,
		'rewrite'            => apply_filters( 'bike_posttype_rewrite_args', array(
			'feeds'      => true,
			'slug'       => 'project',
			'with_front' => true,
		) ),
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revisions', 'custom-fields' ),
	);

	register_post_type( 'bike', apply_filters( 'bike_posttype_args', $args ) );
	
}
add_action( 'init', 'lons_register_posttypes', 0 );

function add_post_meta_box() {
	add_meta_box( 'theme_settings', __( 'Theme', 'lons' ), 'theme_settings_meta_box', 'post', 'side', 'high' );
	add_meta_box( 'project_settings', __( 'Project Options', 'lons' ), 'project_settings_meta_box', 'post', 'normal', 'high' );
	add_meta_box( 'image_settings', __( 'Image Format Options', 'lons' ), 'image_settings_meta_box', 'post', 'advanced', 'high' );
	add_meta_box( 'gallery_settings', __( 'Gallery Format Options', 'lons' ), 'gallery_settings_meta_box', 'post', 'advanced', 'high' );
	add_meta_box( 'bike_settings', __( 'Bike Stats', 'lons' ), 'bike_settings_meta_box', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'add_post_meta_box' );

if ( ! function_exists( 'project_settings_meta_box' ) ) :
function project_settings_meta_box( $post ) {
	
	$post_id = get_the_ID();
	$format = get_post_format( $post_id );
	
	wp_nonce_field( basename( __FILE__ ), 'lons_settings_nonce' );
	
		$href   		= get_post_meta( $post_id, 'lons_project_btn_href', true );
		$label   		= get_post_meta( $post_id, 'lons_project_btn_label', true );
		$images 		= get_post_meta( $post_id, 'lons_project_images', true );	
		$client 		= get_post_meta( $post_id, 'lons_project_client', true );
		$title   		= get_post_meta( $post_id, 'lons_project_title', true );
		$date   		= get_post_meta( $post_id, 'lons_project_year', true );
		$git_href 	= get_post_meta( $post_id, 'lons_project_git_href', true );
		$repo_href 	= get_post_meta( $post_id, 'lons_project_repo_href', true );
?>
<fieldset>
	<legend>A bit about the job</legend>
		<label for="lons_project_client"><?php esc_html_e( 'Client', 'lons' ); ?>:
			<input name="lons_project_client" type="text" value="<?php echo $client; ?>" style="width:100%;">
		</label>
		<label for="lons_project_title"><?php esc_html_e( 'Title', 'lons' ); ?>:
			<input name="lons_project_title" type="text" value="<?php echo $title; ?>" style="width:100%;">
		</label>
		<label for="lons_project_year"><?php esc_html_e( 'Launch Date', 'lons' ); ?>:
			<input name="lons_project_year" type="number" min="2000" max="2017" maxlength="4" placeholder="----" value="<?php echo $date; ?>" style="width:100%;">
		</label>
		<label rel="link" for="lons_project_btn_href"><?php esc_html_e( 'Link', 'lons' ); ?>:
			<input name="lons_project_btn_href" type="url" value="<?php echo $href; ?>" style="width:100%;">
		</label>
		<label rel="link" for="lons_project_btn_label"><?php esc_html_e( 'Button Text', 'lons' ); ?>:
			<input name="lons_project_btn_label" type="text" value="<?php echo $label; ?>" style="width:100%;">
		</label>
		<label for="lons_project_git_href"><?php esc_html_e( 'Git Repo', 'lons' ); ?>:
			<input name="lons_project_git_href" type="url" value="<?php echo $git_href; ?>" style="width:100%;">
		</label>
		<label for="lons_project_repo_href"><?php esc_html_e( 'BitBucket Repo', 'lons' ); ?>:
			<input name="lons_project_repo_href" type="url" value="<?php echo $repo_href; ?>" style="width:100%;">
		</label>
</fieldset>
<?php
}	
endif;

if ( ! function_exists( 'theme_settings_meta_box' ) ) :
function theme_settings_meta_box( $post ) {
	
	$post_id = get_the_ID();

	wp_nonce_field( basename( __FILE__ ), 'lons_settings_nonce' );
	
		$theme   		= get_post_meta( $post_id, 'lons_project_theme', true );
		$format   	= get_post_meta( $post_id, 'lons_is_bike', false );
		$color 			= get_post_meta( $post_id, 'lons_project_color', true );
		$align   		= get_post_meta( $post_id, 'lons_project_theme_align', true );
		$valign   		= get_post_meta( $post_id, 'lons_project_theme_valign', true );
		
		if($format) $format = $format[0];
		
		$project 		= get_post_meta( $post_id, 'lons_is_project', true );
?>
<fieldset class="themediv">
	<input type="hidden" name="lons_is_bike" id="lons_is_bike" value="<?php echo $format; ?>">
	<ul id="theme-tabs" class="category-tabs">
		<li class="tabs"><a href="#theme-visuals">Visuals</a></li>
		<li><a href="#theme-options">Options</a></li>
	</ul>
	<div id="theme-visuals" class="tabs-panel">
		<p>
			<label title="If there is a dark background image, use this option for lighter (more readable) text" for="lons_project_theme_light" style="margin-right:10px;">
				<input type="radio" id="lons_project_theme_light" name="lons_project_theme" value="light"<?php if( $theme == 'light' ) echo ' checked'; ?>><?php esc_html_e( 'Light', 'lons' ); ?>
			</label>
			<label type="radio" for="lons_project_theme_dark" title="If there is a light background image, use this option for darker (more readable) text">
				<input type="radio" id="lons_project_theme_dark" name="lons_project_theme" value="dark"<?php if( $theme == 'dark' ) echo ' checked'; ?>><?php esc_html_e( 'Dark', 'lons' ); ?>
			</label>
		</p>
		<p>
			<label for="lons_project_theme_align"><?php esc_html_e( 'X Alignment', 'lons' ); ?>:</label>
			<select id="lons_project_theme_align" name="lons_project_theme_align" style="width:auto;">
				<option default value="center" <?php  selected( $align, 'center' ); ?>>Center</option>
				<option value="right" <?php  selected( $align, 'right' ); ?>>Right</option>
				<option value="left" <?php selected( $align, 'left' ); ?>>Left</option>
			</select>
		</p>
		<p>
			<label for="lons_project_theme_valign"><?php esc_html_e( 'Y Alignment', 'lons' ); ?>:</label>
			<select id="lons_project_theme_valign" name="lons_project_theme_valign" style="width:auto;">
				<option default value="top" <?php  selected( $valign, 'top' ); ?>>Top</option>
				<option value="center" <?php  selected( $valign, 'center' ); ?>>Center</option>
				<option value="bottom" <?php selected( $valign, 'bottom' ); ?>>Bottom</option>
			</select>
		</p>
		<p>
			<label class="block" for="lons_project_color"><?php esc_html_e( 'Color', 'lons' ); ?>:</label>
			<input id="lons_project_color" name="lons_project_color" type="text" value="<?php echo $color; ?>">
		</p>
	</div>
	<div id="theme-options" class="tabs-panel" style="display:none;">
		<p>
			<label for="lons_is_project">
				<input type="checkbox" id="lons_is_project" name="lons_is_project"<?php if( $project == 'checked' ) echo ' checked'; ?>> <?php esc_html_e( 'This is a portfolio project', 'lons' ); ?>
			</label>
		</p>
	</div>
</fieldset>
<?php
}	
endif;

if ( ! function_exists( 'image_settings_meta_box' ) ) :
function image_settings_meta_box( $post ) {
	
	$post_id = get_the_ID();
	
	$template = get_post_meta( $post_id, '_wp_page_template', true );
	$format = get_post_format( $post_id );
	
	wp_nonce_field( basename( __FILE__ ), 'lons_settings_nonce' );
}	
endif;

if ( ! function_exists( 'gallery_settings_meta_box' ) ) :
function gallery_settings_meta_box( $post ) {
	
	$post_id = get_the_ID();
	
	$template = get_post_meta( $post_id, '_wp_page_template', true );
	$format = get_post_format( $post_id );
	$gallery = get_post_gallery_images( $post_id );

	$media_query = new WP_Query(
		array(
			'post_type' 		=> 'attachment',
			'post_status' 		=> 'inherit',
			'post_mime_type' 	=> 'image',
			'posts_per_page'	=> 15,
		)
	);
	
	$used_ids = [];
	$used_images = get_post_meta( $post_id, '_lons_used_images', true );
	
	wp_nonce_field( basename( __FILE__ ), 'lons_settings_nonce' );
?>
<fieldset>
	<legend<?php if ( !get_post_gallery() ) echo ' style="display:none;"';?>>These images will appear in your gallery</legend>
	<ul id="used_images" class="row small-up-2 medium-up-3 large-up-6">
	<?php
		if ( get_post_gallery() ) :
			$galleries = get_post_gallery( $post_id, false );
			$used_ids = $galleries['ids'];
			$used_ids = explode(',',$used_ids);

			foreach ( $used_ids as $ID ) :
				$base_url = wp_upload_dir();
				$base_url = $base_url['baseurl'] . '/';
				$attachment = wp_get_attachment_metadata ( $ID );
				$file = $attachment['sizes']['thumbnail'];
				$file = $file['file'];
				$title = get_the_title($ID); ?>
		<li class="column column-block">
			<figure data-background>
				<nav>
					<ul>
						<li>
							<button class="button-primary" data-add>+</button>
						</li>
						<li>
							<button class="button-secondary" data-remove>-</button>
						</li>
					</ul>
				</nav>
				<div class="feature">
					<a class="thumbnail" href="#<?php echo $ID;?>" data-href="<?php echo $ID;?>" title="<?php echo esc_attr( $title );?>">
						<img width="75" height="75" src="<?php echo $base_url . $file;?>" alt="<?php echo esc_attr( $title );?>">
					</a>
			</figure>
		</li>
		<?php endforeach; ?>
	<?php endif; ?>
	</ul>
</fieldset>
<fieldset>
	<legend>Any of the images below can be used in your gallery</legend>
	<ul id="available_images" class="row small-up-2 medium-up-3 large-up-6">
	<?php
		foreach ($media_query->posts as $attachment) :
			$ID = $attachment->ID;
			if ( !in_array( $ID, $used_ids ) ) :
				$guid = wp_get_attachment_image_src( $ID, [75,75] );
				if( $guid ) :
	?>
		<li class="column column-block">
			<figure data-background>
				<nav>
					<ul>
						<li>
							<button class="button-primary" data-add>+</button>
						</li>
						<li>
							<button class="button-secondary" data-remove>-</button>
						</li>
					</ul>
				</nav>
				<div class="feature">
					<a class="thumbnail" href="#<?php echo $ID;?>" data-href="<?php echo $ID;?>" title="<?php echo esc_attr( $attachment->post_title );?>">
						<img width="<?php echo $guid[1];?>" height="<?php echo $guid[2];?>" src="<?php echo $guid[0];?>" alt="<?php echo esc_attr( $attachment->post_title );?>">
					</a>
			</figure>
		</li>
			<?php endif; ?>
		<?php endif; ?>
	<?php endforeach; ?>
	</ul>
</fieldset>
<?php
}	
endif;

if ( ! function_exists( 'bike_settings_meta_box' ) ) :
function bike_settings_meta_box( $post ) {
	$post_id = get_the_ID();
	
	$components_array = array();


	$frame	 	= get_post_meta( $post_id, 'lons_component_frame', true );
	$f_tire 	= get_post_meta( $post_id, 'lons_component_f_tire', true );
	$r_tire 	= get_post_meta( $post_id, 'lons_component_r_tire', true );
	$f_wheel 	= get_post_meta( $post_id, 'lons_component_f_wheel', true );
	$r_wheel 	= get_post_meta( $post_id, 'lons_component_r_wheel', true );
	$chainring	= get_post_meta( $post_id, 'lons_component_chainring', true );
	$crank		= get_post_meta( $post_id, 'lons_component_crank', true );
	$pedals 	= get_post_meta( $post_id, 'lons_component_pedals', true );
	$chain 		= get_post_meta( $post_id, 'lons_component_chain', true );
	$saddle 	= get_post_meta( $post_id, 'lons_component_saddle', true );
	$seatpost	= get_post_meta( $post_id, 'lons_component_seatpost', true );
	$handlebars = get_post_meta( $post_id, 'lons_component_handlebars', true );
	$grips 		= get_post_meta( $post_id, 'lons_component_grips', true );
	$tape 		= get_post_meta( $post_id, 'lons_component_tape', true );
	$levers 	= get_post_meta( $post_id, 'lons_component_levers', true );
	$f_brake 	= get_post_meta( $post_id, 'lons_component_f_brake', true );
	$r_brake 	= get_post_meta( $post_id, 'lons_component_r_brake', true );
	$f_hub 		= get_post_meta( $post_id, 'lons_component_f_hub', true );
	$r_hub	 	= get_post_meta( $post_id, 'lons_component_r_hub', true );
	
?>
<fieldset class="form-fieldset">
	<div>
		<input name="cyc_component_f_wheel" type="text" value="<?php echo ( $f_wheel ? esc_attr( $f_wheel ) : 'Front Wheel'); ?>">
	</div>
	<div>
		<input name="cyc_component_f_tire" type="text" value="<?php echo ( $f_tire ? esc_attr( $f_tire ) : 'Front Tire'); ?>">
	</div>
	<div>
		<input name="cyc_component_r_wheel" type="text" value="<?php echo ( $r_wheel ? esc_attr( $r_wheel ) : 'Rear Wheel'); ?>">
	</div>
	<div>
		<input name="cyc_component_r_tire" type="text" value="<?php echo ( $r_tire ? esc_attr( $r_tire ) : 'Rear Tire'); ?>">
	</div>
	<div>
		<input name="cyc_component_f_hub" type="text" value="<?php echo ( $f_hub ? esc_attr( $f_hub ) : 'Front Hub'); ?>">
	</div>
	<div>
		<input name="cyc_component_r_hub" type="text" value="<?php echo ( $r_hub ? esc_attr( $r_hub ) : 'Front Hub'); ?>">
	</div>
	<div>
		<input name="cyc_component_crank" type="text" value="<?php echo ( $crank ? esc_attr( $crank ) : 'Crank'); ?>">
	</div>
	<div>
		<input name="cyc_component_chainring" type="text" value="<?php echo ( $chainring ? esc_attr( $chainring ) : 'Chainring'); ?>">
	</div>
	<div>
		<input name="cyc_component_chain" type="text" value="<?php echo ( $chain ? esc_attr( $chain ) : 'Chain'); ?>">
	</div>
	<div>
		<input name="cyc_component_pedals" type="text" value="<?php echo ( $pedals ? esc_attr( $pedals ) : 'Pedals'); ?>">
	</div>
	<div>
		<input name="cyc_component_saddle" type="text" value="<?php echo ( $saddle ? esc_attr( $saddle ) : 'Saddle'); ?>">
	</div>
	<div>
		<input name="cyc_component_seatpost" type="text" value="<?php echo ( $seatpost ? esc_attr( $seatpost ) : 'Seatpost'); ?>">
	</div>
	<div>
		<input name="cyc_component_handlebars" type="text" value="<?php echo ( $handlebars ? esc_attr( $handlebars ) : 'Handlebars'); ?>">
	</div>
	<div>
		<input name="cyc_component_grips" type="text" value="<?php echo ( $grips ? esc_attr( $grips ) : 'Grips/Tape'); ?>">
	</div>
	<div>
		<input name="cyc_component_f_brake" type="text" value="<?php echo ( $f_brake ? esc_attr( $f_brake ) : 'Front Brake'); ?>">
	</div>
	<div>
		<input name="cyc_component_r_brake" type="text" value="<?php echo ( $r_brake ? esc_attr( $r_brake ) : 'Rear Brake'); ?>">
	</div>
</fieldset>
<?php
}
endif;

if ( ! function_exists( 'lons_metabox_settings_save_details' ) ) :
/**
 * Save all metabox settings
 *
 * @since Lovers&Nerds 0.8
 * @author MaakuW
 *
 */
function lons_metabox_settings_save_details( $post_id, $post ){
	global $pagenow;

	if ( 'post.php' != $pagenow ) return $post_id;

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;

	$post_type = get_post_type_object( $post->post_type );
	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	if ( !isset( $_POST['lons_settings_nonce'] ) || ! wp_verify_nonce( $_POST['lons_settings_nonce'], basename( __FILE__ ) ) )
		return $post_id;
	
	if ( isset( $_POST['lons_is_project'] ) ) {
		update_post_meta( $post_id, 'lons_is_project', 'checked' );
	}else{
		delete_post_meta( $post_id, 'lons_is_project' );
	}
	
	if ( isset( $_POST['lons_is_bike'] ) ) {
		update_post_meta( $post_id, 'lons_is_bike', 'checked' );
	}else{
		delete_post_meta( $post_id, 'lons_is_bike' );
	}
	
	if ( isset( $_POST['lons_project_client'] ) ) {
		update_post_meta( $post_id, 'lons_project_client',  htmlentities( $_POST['lons_project_client'] ) );
	}else{
		delete_post_meta( $post_id, 'lons_project_client' );
	}
	
	if ( isset( $_POST['lons_project_title'] ) ) {
		update_post_meta( $post_id, 'lons_project_title',  htmlentities( $_POST['lons_project_title'] ) );
	}else{
		delete_post_meta( $post_id, 'lons_project_title' );
	}
	
	if ( isset( $_POST['lons_project_year'] ) ) {
		update_post_meta( $post_id, 'lons_project_year',  htmlentities( $_POST['lons_project_year'] ) );
	}else{
		delete_post_meta( $post_id, 'lons_project_year' );
	}
	
	if ( isset( $_POST['lons_project_btn_href'] ) ) {
		update_post_meta( $post_id, 'lons_project_btn_href',  htmlentities( $_POST['lons_project_btn_href'] ) );
	}else{
		delete_post_meta( $post_id, 'lons_project_btn_href' );
	}
	
	if ( isset( $_POST['lons_project_git_href'] ) ) {
		update_post_meta( $post_id, 'lons_project_git_href',  htmlentities( $_POST['lons_project_git_href'] ) );
	}else{
		delete_post_meta( $post_id, 'lons_project_git_href' );
	}
	
	if ( isset( $_POST['lons_project_repo_href'] ) ) {
		update_post_meta( $post_id, 'lons_project_repo_href',  htmlentities( $_POST['lons_project_repo_href'] ) );
	}else{
		delete_post_meta( $post_id, 'lons_project_repo_href' );
	}
	
	if ( isset( $_POST['lons_project_btn_label'] ) ) {
		update_post_meta( $post_id, 'lons_project_btn_label',  htmlentities( $_POST['lons_project_btn_label'] ) );
	}else{
		delete_post_meta( $post_id, 'lons_project_btn_label' );
	}
	
	if ( isset( $_POST['lons_project_theme'] ) ) {
		update_post_meta( $post_id, 'lons_project_theme',  htmlentities( $_POST['lons_project_theme'] ) );
	}else{
		delete_post_meta( $post_id, 'lons_project_theme' );
	}

	if ( isset( $_POST['lons_project_theme_align'] ) ) {
		update_post_meta( $post_id, 'lons_project_theme_align',  htmlentities( $_POST['lons_project_theme_align'] ) );
	}else{
		delete_post_meta( $post_id, 'lons_project_theme_align' );
	}

	if ( isset( $_POST['lons_project_theme_valign'] ) ) {
		update_post_meta( $post_id, 'lons_project_theme_valign',  htmlentities( $_POST['lons_project_theme_valign'] ) );
	}else{
		delete_post_meta( $post_id, 'lons_project_theme_valign' );
	}
	
	if ( isset( $_POST['lons_project_color'] ) ) {
		update_post_meta( $post_id, 'lons_project_color',  $_POST['lons_project_color'] );
	}else{
		delete_post_meta( $post_id, 'lons_project_color' );
	}

//Beof Attributes
	if ( isset( $_POST['lons_frame_type'] ) )
		update_post_meta( $post_id, 'lons_frame_type', $_POST['lons_frame_type']);
	else
		delete_post_meta( $post_id, 'lons_frame_type' );
		
	if ( isset( $_POST['lons_attr_condition'] ) )
		update_post_meta( $post_id, 'lons_attr_condition', sanitize_text_field( $_POST['lons_attr_condition'] ) );
	else
		delete_post_meta( $post_id, 'lons_attr_condition' );
		
	if ( isset( $_POST['lons_attr_speed'] ) )
		update_post_meta( $post_id, 'lons_attr_speed', sanitize_text_field( $_POST['lons_attr_speed'] ) );
	else
		delete_post_meta( $post_id, 'lons_attr_speed' );
		
	if ( isset( $_POST['lons_attr_handling'] ) )
		update_post_meta( $post_id, 'lons_attr_handling', sanitize_text_field( $_POST['lons_attr_handling'] ) );
	else
		delete_post_meta( $post_id, 'lons_attr_handling' );
		
	if ( isset( $_POST['lons_attr_traction'] ) )
		update_post_meta( $post_id, 'lons_attr_traction', sanitize_text_field( $_POST['lons_attr_traction'] ) );
	else
		delete_post_meta( $post_id, 'lons_attr_traction' );
		
	if ( isset( $_POST['lons_attr_comfort'] ) )
		update_post_meta( $post_id, 'lons_attr_comfort', sanitize_text_field( $_POST['lons_attr_comfort'] ) );
	else
		delete_post_meta( $post_id, 'lons_attr_comfort' );
		
	if ( isset( $_POST['lons_attr_durability'] ) )
		update_post_meta( $post_id, 'lons_attr_durability', sanitize_text_field( $_POST['lons_attr_durability'] ) );
	else
		delete_post_meta( $post_id, 'lons_attr_durability' );
		
	if ( isset( $_POST['lons_component_frame'] ) )
		update_post_meta( $post_id, 'lons_component_frame', sanitize_text_field( $_POST['lons_component_frame'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_frame' );
		
	if ( isset( $_POST['lons_component_f_tire'] ) )
		update_post_meta( $post_id, 'lons_component_f_tire', sanitize_text_field( $_POST['lons_component_f_tire'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_f_tire' );
		
	if ( isset( $_POST['lons_component_r_tire'] ) )
		update_post_meta( $post_id, 'lons_component_r_tire', sanitize_text_field( $_POST['lons_component_r_tire'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_r_tire' );
		
	if ( isset( $_POST['lons_component_f_wheel'] ) )
		update_post_meta( $post_id, 'lons_component_f_wheel', sanitize_text_field( $_POST['lons_component_f_wheel'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_f_wheel' );
		
	if ( isset( $_POST['lons_component_r_wheel'] ) )
		update_post_meta( $post_id, 'lons_component_r_wheel', sanitize_text_field( $_POST['lons_component_r_wheel'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_r_wheel' );
		
	if ( isset( $_POST['lons_component_crank'] ) )
		update_post_meta( $post_id, 'lons_component_crank', sanitize_text_field( $_POST['lons_component_crank'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_crank' );
		
	if ( isset( $_POST['lons_component_chainring'] ) )
		update_post_meta( $post_id, 'lons_component_chainring', sanitize_text_field( $_POST['lons_component_chainring'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_chainring' );
		
	if ( isset( $_POST['lons_component_pedals'] ) )
		update_post_meta( $post_id, 'lons_component_pedals', sanitize_text_field( $_POST['lons_component_pedals'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_pedals' );
		
	if ( isset( $_POST['lons_component_chain'] ) )
		update_post_meta( $post_id, 'lons_component_chain', sanitize_text_field( $_POST['lons_component_chain'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_chain' );
		
	if ( isset( $_POST['lons_component_saddle'] ) )
		update_post_meta( $post_id, 'lons_component_saddle', sanitize_text_field( $_POST['lons_component_saddle'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_saddle' );
		
	if ( isset( $_POST['lons_component_seatpost'] ) )
		update_post_meta( $post_id, 'lons_component_seatpost', sanitize_text_field( $_POST['lons_component_seatpost'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_seatpost' );
		
	if ( isset( $_POST['lons_component_handlebars'] ) )
		update_post_meta( $post_id, 'lons_component_handlebars', sanitize_text_field( $_POST['lons_component_handlebars'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_handlebars' );
		
	if ( isset( $_POST['lons_component_grips'] ) )
		update_post_meta( $post_id, 'lons_component_grips', sanitize_text_field( $_POST['lons_component_grips'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_grips' );
		
	if ( isset( $_POST['lons_component_tape'] ) )
		update_post_meta( $post_id, 'lons_component_tape', sanitize_text_field( $_POST['lons_component_tape'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_tape' );
		
	if ( isset( $_POST['lons_component_levers'] ) )
		update_post_meta( $post_id, 'lons_component_levers', sanitize_text_field( $_POST['lons_component_levers'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_levers' );
		
	if ( isset( $_POST['lons_component_f_brake'] ) )
		update_post_meta( $post_id, 'lons_component_f_brake', sanitize_text_field( $_POST['lons_component_f_brake'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_f_brake' );
		
	if ( isset( $_POST['lons_component_r_brake'] ) )
		update_post_meta( $post_id, 'lons_component_r_brake', sanitize_text_field( $_POST['lons_component_r_brake'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_r_brake' );	
		
	if ( isset( $_POST['lons_component_f_hub'] ) )
		update_post_meta( $post_id, 'lons_component_f_hub', sanitize_text_field( $_POST['lons_component_f_hub'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_f_hub' );
		
	if ( isset( $_POST['lons_component_r_hub'] ) )
		update_post_meta( $post_id, 'lons_component_r_hub', sanitize_text_field( $_POST['lons_component_r_hub'] ) );
	else
		delete_post_meta( $post_id, 'lons_component_r_hub' );	
}
add_action( 'save_post', 'lons_metabox_settings_save_details', 10, 2 );
endif;

if ( ! function_exists( 'lons_user_fields' ) ) :
/**
 * Create additional User fields
 *
 * @since Lovers&Nerds 2.3.2
 * @author MaakuW
 *
 */
  function lons_user_fields( $user ) { 
	
		$gender 		= esc_attr( get_the_author_meta( 'gender', $user->ID ) );
		$photo 			= esc_attr( get_the_author_meta( 'photo', $user->ID ) );
		$img_usage 	= esc_attr( get_the_author_meta( 'img_usage', $user->ID ) );
		$img_align 	= esc_attr( get_the_author_meta( 'img_align', $user->ID ) );
		
	?>
  <h4>Personal</h4>
  <table class="form-table">
  	<tr>
			<th scope="row"><label for="gender">Gender</label></th>
			<td><select class="regular-text ltr" name="gender" type="text" id="gender" cols="10">
				<option value="m" <?php selected( $gender, 'm' ); ?>>Male</option>
				<option value="f" <?php selected( $gender, 'f' ); ?>>Female</option>
			</td>
		</tr>
  </table>
  <h4>Imagery</h4>
  <table class="form-table">
  	<tr>
			<th scope="row"><label for="photo">Photo</label></th>
			<td>
			<?php 
				$args = array(
						'post_type' 		=> 'attachment',
						'post_mime_type' 	=> 'image',
						'numberposts'	=> -1,
				);
					
				$media = get_posts( $args );

				if( $media ) : ?>
				<select name="photo" id="photo">
					<?php foreach ( $media as $image ) :?>
						<?php setup_postdata($image);?>
					<option value="<?php echo $image->ID; ?>"<?php  selected( $photo, $image->ID ); ?>><?php echo $image->post_title; ?></option>
					<?php endforeach; ?>
				</select>
				<?php endif; ?>
			</td>
		</tr>
  	<tr class="form-required">
			<th scope="row"><label for="img_usage">Image Usage</label></th>
			<td>
				<select name="img_usage" id="img_usage" aria-required="false">
					<option value="background"<?php  selected( $img_usage, 'background' ); ?>>Fullsize</option>
					<option value="default"<?php  selected( $img_usage, 'default' ); ?>>Boxed</option>
				</select>
			</td>
		</tr>
  	<tr class="form-required">
			<th scope="row"><label for="img_usage">Image Alignment</label></th>
			<td>
				<label for="img_right">
					<input type="radio" id="img_left" name="img_align" value="left"<?php if( $img_align == 'left' ) echo ' checked'; ?>> <?php esc_html_e( 'Left', 'lons' ); ?>
				</label>
				<label type="radio" for="img_right">
					<input type="radio" id="img_right" name="img_align" value="right"<?php if( $img_align == 'right' ) echo ' checked'; ?>> <?php esc_html_e( 'Right', 'lons' ); ?>
				</label>
			</td>
  	</tr>
  </table>
  <h3>Occupation</h3>
  <table class="form-table">
  	<tr class="form-required">
			<th scope="row"><label for="job_title">Title</label></th>
			<td><input class="regular-text ltr" name="job_title" type="text" id="job_title" value="<?php echo esc_attr( get_the_author_meta( 'job_title', $user->ID ) ); ?>" aria-required="false" autocapitalize="none" autocorrect="off" maxlength="60"></td>
		</tr>
  	<tr>
			<th scope="row"><label for="job_description">Job Description</label></th>
			<td><textarea class="regular-text ltr" name="job_description" id="job_description" placeholder="<?php echo esc_attr( get_the_author_meta( 'job_description', $user->ID ) ); ?>" aria-required="true" autocapitalize="none" autocorrect="off" maxlength="180"></textarea></td>
		</tr>
  </table>
  <h4>Social</h4>
  <table class="form-table">
  	<tr class="form-required">
			<th scope="row"><label for="linkedin">LinkedIn</label></th>
			<td><input class="regular-text ltr" name="linkedin" type="text" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" aria-required="false" autocapitalize="none" autocorrect="off" maxlength="60"></td>
		</tr>
  	<tr class="form-required">
			<th scope="row"><label for="indeed">Indeed</label></th>
			<td><input class="regular-text ltr" name="indeed" type="text" id="indeed" value="<?php echo esc_attr( get_the_author_meta( 'indeed', $user->ID ) ); ?>" aria-required="false" autocapitalize="none" autocorrect="off" maxlength="60"></td>
		</tr>
  	<tr class="form-required">
			<th scope="row"><label for="medium">Medium</label></th>
			<td><input class="regular-text ltr" name="medium" type="text" id="medium" value="<?php echo esc_attr( get_the_author_meta( 'medium', $user->ID ) ); ?>" aria-required="false" autocapitalize="none" autocorrect="off" maxlength="60"></td>
		</tr>
  	<tr class="form-required">
			<th scope="row"><label for="bitbucket">BitBucket</label></th>
			<td><input class="regular-text ltr" name="bitbucket" type="text" id="bitbucket" value="<?php echo esc_attr( get_the_author_meta( 'bitbucket', $user->ID ) ); ?>" aria-required="false" autocapitalize="none" autocorrect="off" maxlength="60"></td>
		</tr>
  	<tr class="form-required">
			<th scope="row"><label for="github">Git</label></th>
			<td><input class="regular-text ltr" name="github" type="text" id="github" value="<?php echo esc_attr( get_the_author_meta( 'github', $user->ID ) ); ?>" aria-required="false" autocapitalize="none" autocorrect="off" maxlength="60"></td>
		</tr>
  	<tr class="form-required">
			<th scope="row"><label for="twitter">Twitter</label></th>
			<td><input class="regular-text ltr" name="twitter" type="text" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" aria-required="false" autocapitalize="none" autocorrect="off" maxlength="60"></td>
		</tr>
  	<tr class="form-required">
			<th scope="row"><label for="instagram">Instagram</label></th>
			<td><input class="regular-text ltr" name="instagram" type="text" id="instagram" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>" aria-required="false" autocapitalize="none" autocorrect="off" maxlength="60"></td>
		</tr>
  	<tr class="form-required">
			<th scope="row"><label for="facebook">Facebook</label></th>
			<td><input class="regular-text ltr" name="facebook" type="text" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" aria-required="false" autocapitalize="none" autocorrect="off" maxlength="60"></td>
		</tr>
  </table>
<?php
	}
  add_action( 'show_user_profile', 'lons_user_fields' );
  add_action( 'edit_user_profile', 'lons_user_fields' );
endif;

if ( ! function_exists( 'lons_save_user_fields' ) ) :

  function lons_save_user_fields( $user_id ) {
  	if ( !current_user_can( 'edit_user', $user_id ) )
      return false;

  	update_user_meta( $user_id, 'job_title', htmlentities( $_POST['job_title'] ) );
  	update_user_meta( $user_id, 'job_description', htmlentities( $_POST['job_description'] ) );
  	update_user_meta( $user_id, 'gender', $_POST['gender'] );
  	update_user_meta( $user_id, 'photo', $_POST['photo'] );
  	update_user_meta( $user_id, 'img_align', $_POST['img_align'] );
  	update_user_meta( $user_id, 'img_usage', $_POST['img_usage'] );
  	update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
  	update_user_meta( $user_id, 'medium', $_POST['medium'] );
  	update_user_meta( $user_id, 'github', $_POST['github'] );
  	update_user_meta( $user_id, 'bitbucket', $_POST['bitbucket'] );
  	update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
  	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
  	update_user_meta( $user_id, 'instagram', $_POST['instagram'] );
  }
	
	add_action( 'personal_options_update', 'lons_save_user_fields' );
  add_action( 'edit_user_profile_update', 'lons_save_user_fields' );
endif;

function admin_scripts_styles( $hook ) {
	global $typenow;

	$template_dir = get_template_directory_uri();
	
	// Admin Styles
	wp_enqueue_style( 'admin_styles', $template_dir . '/assets/css/admin.css' );

	if ( ! in_array( $hook, array( 'post-new.php', 'post.php' ) ) ) return;
	if ( isset( $typenow ) && in_array( $typenow, array( 'post') ) ) {
		
		// Admin Styles
    wp_enqueue_style('wp-color-picker');
	
		// Admin Functions
		wp_enqueue_script( 'post-settings', $template_dir . '/assets/js/post-settings.js', array( 'jquery' ), '0.1' );
		wp_enqueue_script( 'project-settings', $template_dir . '/assets/js/project-settings.js', array( 'jquery' ), '0.1' );
		wp_enqueue_script( 'theme-settings', $template_dir . '/assets/js/theme-settings.js', array( 'jquery' ), '0.1' );
		wp_enqueue_script( 'bike-settings', $template_dir . '/assets/js/bike-settings.js', array( 'jquery' ), '0.1' );
		
		wp_enqueue_script('colorpicker', $template_dir . '/colorpicker.js');
		
		//Core functions
		wp_enqueue_script( 'admin_functions', $template_dir . '/assets/js/admin.js', array(), '0.1', true );
		
    wp_enqueue_script('iris', admin_url('js/iris.min.js'),array('jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch'), false, 1);
    
    wp_enqueue_script('wp-color-picker', admin_url('js/color-picker.min.js'), array('iris'), false,1);
    
    $colorpicker_l10n = array('clear' => __('Clear'), 'defaultString' => __('Default'), 'pick' => __('Select Color'));
    wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n );
	}
}
add_action( 'admin_enqueue_scripts', 'global_enqueue' );
add_action( 'admin_enqueue_scripts', 'admin_scripts_styles' );

/**
 * Creates a shortcode for anchors that are relative to the server automatically
 *
 * @since Lovers&Nerds 1.6
 *
 * @param array $atts Attributes for the anchor.
 * @author MaakuW
 * @return array $content what the anchor tag wraps.
 */
function local_anchor( $atts, $content = "" ) {
	$atts = shortcode_atts( array(
		'id' 			=> '',
		'href' 		=> '#',
		'slug' 		=> '',
		'title' 	=> '',
		'class' 	=> '',
		'target' 	=> '',
		'rel' 		=> ''
	), $atts, 'local_anchor' );
	if ( $atts['id'] != '' ) $id = ' id="' . $atts['id'] . '"';
	if ( $atts['slug'] != '' ) $slug = $atts['slug'] . '/';
	if ( $atts['href'] != '#' ) $href = home_url($slug . $atts['href']);
	if ( $atts['title'] != '' ) $title = ' title="' . $atts['title'] . '"';
	if ( $atts['class'] != '' ) $class = ' class="' . $atts['class'] . '"';
	if ( $atts['target'] != '' ) $target = ' target="' . $atts['target'] . '"';
	if ( $atts['rel'] != '' ) $rel = ' rel="' . $atts['rel'] . '"';
	if($content){
		return '<a href="' . $href .'"' . $id . $class . $title . $target . $rel .'>' . $content . '</a>';
	}else{
		return $href;
	}
}
add_shortcode( 'local_anchor', 'local_anchor' );

/**
 * Creates a shortcode for anchors that are relative to the server automatically
 *
 * @since Lovers&Nerds 1.6
 *
 * @param array $atts Attributes for the anchor.
 * @author MaakuW
 * @return array $content what the anchor tag wraps.
 */
function local_img( $atts ) {
	$atts = shortcode_atts( array(
		'id' 			=> '',
		'alt' 		=> '',
		'src' 		=> '',  
		'title' 	=> '',
		'class' 	=> ''
	), $atts, 'local_img' );
	$id = $alt = $src = $title = $class = '';
	if ( $atts['id'] != '' ) $id = ' id="' . $atts['id'] . '"';
	if ( $atts['alt'] != '' ) $alt = ' alt="' . $atts['alt'] . '"';
	if ( $atts['src'] != '' ) $src = ' src="' . home_url($atts['src']) . '"';
	if ( $atts['title'] != '' ) $title = ' title="' . $atts['title'] . '"';
	if ( $atts['class'] != '' ) $class = ' class="' . $atts['class'] . '"';
	
	return '<img' . $alt . $src . $id . $class . $title .'>';
}
add_shortcode( 'local_img', 'local_img' );