<?php 
/*
Plugin Name: Lovers&Nerds Instagram Feed
Description: Display beautifully clean, customizable, and responsive Instagram feeds
Author: MaakuW, based on Tim Whitlock's work
Version: 1.0.2
License: GPLv2 or later
Text Domain: lans-lans-instagram-api
*/

define( 'LANSINSTA', '0.1' );

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Include admin
include dirname( __FILE__ ) .'/lans-instagram-api-admin.php';

//Allows shortcodes in theme
add_filter('widget_text', 'do_shortcode');

// Add shortcodes
function lans_display_instagram($atts, $content = null) {


    /******************* SHORTCODE OPTIONS ********************/

    $options = get_option('lans_instagram_settings');
    
    //Pass in shortcode attrbutes
    $atts = shortcode_atts(
    array(
        'id' => isset($options[ 'lans_instagram_user_id' ]) ? $options[ 'lans_instagram_user_id' ] : '',
        'num' => isset($options[ 'lans_instagram_num' ]) ? $options[ 'lans_instagram_num' ] : '',
    ), $atts);


    /******************* VARS ********************/

    //User ID
    $lans_instagram_user_id = trim($atts['id']);

    /******************* CONTENT ********************/

    $lans_instagram_content = '<div id="lans_instagram" class="entry-content" data-id="' . $lans_instagram_user_id . '" data-num="' . trim($atts['num']) . '">';

    //Header
//    $lans_instagram_content .= '<header class="lans_instagram_header"></header>';

    //Images container
    $lans_instagram_content .= '<ul id="lans_images" class="no-bullet row expanded collapse small-up-1 medium-up-2 large-up-3">';

    //Error messages
    $lans_instagram_error = false;
    if( empty($lans_instagram_user_id) || !isset($lans_instagram_user_id) ){
        $lans_instagram_content .= '<div class="error"><p>Please enter a User ID on the Instagram Feed plugin Settings page</p></div>';
        $lans_instagram_error = true;
    }
    if( empty($options[ 'lans_instagram_at' ]) || !isset($options[ 'lans_instagram_at' ]) ){
        $lans_instagram_content .= '<div class="error"><p>Please enter an Access Token on the Instagram Feed plugin Settings page</p></div>';
        $lans_instagram_error = true;
    }
    
    $lans_instagram_content .= '</ul>';
    
    $lans_instagram_content .= '</div>'; //End #lans_instagram
 
    //Return our feed HTML to display
    return $lans_instagram_content;

}
add_shortcode('lans-instagram-api', 'lans_display_instagram');

#############################

function lans_instagram_scripts_enqueue() {
    $lans_instagram_settings = get_option('lans_instagram_settings');
    //Register the script to make it available
    wp_enqueue_script( 'lans_instagram_scripts', plugins_url( '/js/lans-instagram.js' , __FILE__ ), array('jquery'), LANSINSTA, true ); //http://www.minifier.org/

    //Access token
    isset($lans_instagram_settings[ 'lans_instagram_at' ]) ? $lans_instagram_at = trim($lans_instagram_settings['lans_instagram_at']) : $lans_instagram_at = '';

    $data = array(
        'lans_instagram_at' => $lans_instagram_at
    );

    //Pass option to JS file
    wp_localize_script('lans_instagram_scripts', 'lans_instagram_js_options', $data);
}
//Enqueue scripts
add_action( 'wp_enqueue_scripts', 'lans_instagram_scripts_enqueue' );

//Uninstall
function lans_instagram_uninstall() {
	if ( ! current_user_can( 'activate_plugins' ) )
        return;
}
register_uninstall_hook( __FILE__, 'lans_instagram_uninstall' );

?>