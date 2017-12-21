<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function lans_instagram_menu() {
    add_options_page(
        'Instagram API Authentication Settings',
        'Instagram API',
        'manage_options',
        'lans-lans-instagram-api',
        'lans_instagram_settings_page'
    );
}
add_action('admin_menu', 'lans_instagram_menu');

function lans_instagram_settings_page() {

    //Hidden fields
    $lans_instagram_settings_hidden_field = 'lans_instagram_settings_hidden_field';

    //Declare defaults
    $lans_instagram_settings_defaults = array(
        'lans_instagram_at'                   => '',
        'lans_instagram_user_id'              => '',
        'lans_instagram_num'                  => '18'
    );
    //Save defaults in an array
    $options = wp_parse_args(get_option('lans_instagram_settings'), $lans_instagram_settings_defaults);
    update_option( 'lans_instagram_settings', $options );

    //Set the page variables
    $lans_instagram_at = $options[ 'lans_instagram_at' ];
    $lans_instagram_user_id = $options[ 'lans_instagram_user_id' ];
    $lans_instagram_num = $options[ 'lans_instagram_num' ];


    //Check nonce before saving data
    if ( ! isset( $_POST['lans_instagram_settings_nonce'] ) || ! wp_verify_nonce( $_POST['lans_instagram_settings_nonce'], 'lans_instagram_saving_settings' ) ) {
        //Nonce did not verify
    } else {
        // See if the user has posted us some information. If they did, this hidden field will be set to 'Y'.
        if( isset($_POST[ $lans_instagram_settings_hidden_field ]) && $_POST[ $lans_instagram_settings_hidden_field ] == 'Y' ) {

            $lans_instagram_at = sanitize_text_field( $_POST[ 'lans_instagram_at' ] );
            $lans_instagram_user_id = sanitize_text_field( $_POST[ 'lans_instagram_user_id' ] );

            $options[ 'lans_instagram_at' ] = $lans_instagram_at;
            $options[ 'lans_instagram_user_id' ] = $lans_instagram_user_id;

            //Validate and sanitize number of photos field
            $safe_num = intval( sanitize_text_field( $_POST['lans_instagram_num'] ) );
            if ( ! $safe_num ) $safe_num = '';
            if ( strlen( $safe_num ) > 4 ) $safe_num = substr( $safe_num, 0, 4 );
            $lans_instagram_num = $safe_num;
            $options[ 'lans_instagram_num' ] = $lans_instagram_num;
            
            //Save the settings to the settings array
            update_option( 'lans_instagram_settings', $options );

        ?>
        <div class="updated"><p><strong><?php _e('Settings saved.', 'lans-instagram-api' ); ?></strong></p></div>
        <?php } ?>

    <?php } //End nonce check ?>


    <div id="lans_admin" class="wrap">

        <div id="header">
            <h1><?php _e('Instagram API', 'lans-instagram-api'); ?></h1>
        </div>
    
        <form name="form1" method="post" action="">
            <input type="hidden" name="<?php echo $lans_instagram_settings_hidden_field; ?>" value="Y">
            <?php wp_nonce_field( 'lans_instagram_saving_settings', 'lans_instagram_settings_nonce' ); ?>
            <table class="form-table">
                <tbody>
                    <h3><?php _e('Configure', 'lans-instagram-api'); ?></h3>

                    <div id="lans_config">
                        <!-- <a href="https://instagram.com/oauth/authorize/?client_id=1654d0c81ad04754a898d89315bec227&redirect_uri=https://smashballoon.com/lans-instagram-api/instagram-token-plugin/?return_uri=<?php echo admin_url('admin.php?page=lans-lans-instagram-api'); ?>&response_type=token" class="lans_admin_btn"><?php _e('Log in and get my Access Token and User ID', 'lans-instagram-api'); ?></a> -->
                        <a href="https://instagram.com/oauth/authorize/?client_id=3a81a9fa2a064751b8c31385b91cc25c&scope=basic+public_content&redirect_uri=https://smashballoon.com/lans-instagram-api/instagram-token-plugin/?return_uri=<?php echo admin_url('admin.php?page=lans-lans-instagram-api'); ?>&response_type=token" class="lans_admin_btn"><?php _e('Log in and get my Access Token and User ID', 'lans-instagram-api'); ?></a>
                        <a href="https://smashballoon.com/lans-instagram-api/token/" target="_blank" style="position: relative; top: 14px; left: 15px;"><?php _e('Button not working?', 'lans-instagram-api'); ?></a>
                    </div>
                    
                    <tr valign="top">
                        <th scope="row"><label><?php _e('Access Token', 'lans-instagram-api'); ?></label></th>
                        <td>
                            <input name="lans_instagram_at" id="lans_instagram_at" type="text" value="<?php esc_attr_e( $lans_instagram_at, 'lans-instagram-api' ); ?>" size="60" maxlength="60" placeholder="Click button above to get your Access Token" />
                            &nbsp;<a class="lans_tooltip_link" href="JavaScript:void(0);"><?php _e("What is this?", 'lans-instagram-api'); ?></a>
                            <p class="lans_tooltip"><?php _e("In order to display your photos you need an Access Token from Instagram. To get yours, simply click the button above and log into Instagram. You can also use the button on <a href='https://smashballoon.com/lans-instagram-api/token/' target='_blank'>this page</a>.", 'lans-instagram-api'); ?></p>
                        </td>
                    </tr>
                    


                    <tr valign="top">
                        <th scope="row"><label><?php _e('Show Photos From:', 'lans-instagram-api'); ?></label><code class="lans_shortcode"> type
                            Eg: type=user id=12986477
                        </code></th>
                        <td>
                            <span>
                                <?php $lans_instagram_type = 'user'; ?>
                                <input type="radio" name="lans_instagram_type" id="lans_instagram_type_user" value="user" <?php if($lans_instagram_type == "user") echo "checked"; ?> />
                                <label class="lans_radio_label" for="lans_instagram_type_user">User ID(s):</label>
                                <input name="lans_instagram_user_id" id="lans_instagram_user_id" type="text" value="<?php esc_attr_e( $lans_instagram_user_id, 'lans-instagram-api' ); ?>" size="25" />
                                &nbsp;<a class="lans_tooltip_link" href="JavaScript:void(0);"><?php _e("What is this?", 'lans-instagram-api'); ?></a>
                                <p class="lans_tooltip"><?php _e("These are the IDs of the Instagram accounts you want to display photos from. To get your ID simply click on the button above and log into Instagram.<br /><br />You can also display photos from other peoples Instagram accounts. To find their User ID you can use <a href='https://smashballoon.com/lans-instagram-api/find-instagram-user-id/' target='_blank'>this tool</a>. You can separate multiple IDs using commas.", 'lans-instagram-api'); ?></p><br />
                            </span>

                            <div class="lans_notice lans_user_id_error">
                                <?php _e("<p>Please be sure to enter your numeric <b>User ID</b> and not your Username. You can find your User ID by clicking the blue Instagram Login button above, or by entering your username into <a href='https://smashballoon.com/lans-instagram-api/find-instagram-user-id/' target='_blank'>this tool</a>.</p>", 'lans-instagram-api'); ?>
                            </div>
                           
                        </td>
                    </tr>
                    
	                <tr valign="top">
	                    <th scope="row"><label><?php _e('Number of Photos', 'lans-instagram-api'); ?></label><code class="lans_shortcode"> num
	                        Eg: num=6</code></th>
	                    <td>
	                        <input name="lans_instagram_num" type="text" value="<?php esc_attr_e( $lans_instagram_num, 'lans-instagram-api' ); ?>" size="4" maxlength="4" />
	                        <span class="lans_note"><?php _e('Number of photos to show initially. Maximum of 33.', 'lans-instagram-api'); ?></span>
	                        &nbsp;<a class="lans_tooltip_link" href="JavaScript:void(0);"><?php _e("Using multiple IDs or hashtags?", 'lans-instagram-api'); ?></a>
	                            <p class="lans_tooltip"><?php _e("If you're displaying photos from multiple User IDs or hashtags then this is the number of photos which will be displayed from each.", 'lans-instagram-api'); ?></p>
	                    </td>
	                </tr>

        <?php submit_button(); ?>

    </form>

        <h3><?php _e('Display your Feed', 'lans-instagram-api'); ?></h3>
        <p><?php _e("Copy and paste the following shortcode directly into the page, post or widget where you'd like the feed to show up:", 'lans-instagram-api'); ?></p>
        <input type="text" value="[lans-instagram-api]" size="16" readonly="readonly" style="text-align: center;" onclick="this.focus();this.select()" title="<?php _e('To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac).', 'lans-instagram-api'); ?>" />

        <table class="lans_shortcode_table">
            <tbody>

                <tr class="lans_table_header"><td colspan=3><?php _e("Configure Options", 'lans-instagram-api'); ?></td></tr>
                <tr>
                    <td>id</td>
                    <td><?php _e('An Instagram User ID. Separate multiple IDs by commas.', 'lans-instagram-api'); ?></td>
                    <td><code>[lans-instagram-api id="1234567"]</code></td>
                </tr>
                <tr>
                    <td>num</td>
                    <td><?php _e("The number of photos to display initially. Maximum is 33.", 'lans-instagram-api'); ?></td>
                    <td><code>[lans-instagram-api num=10]</code></td>
                </tr>
            </tbody>
        </table>
</div> <!-- end #lans_admin -->

<?php } //End Settings page

function lans_instagram_admin_style() {
        wp_register_style( 'lans_instagram_admin_css', plugins_url('css/lans-instagram-admin.css', __FILE__), array(), LANSINSTA );

        wp_enqueue_style( 'lans_instagram_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'lans_instagram_admin_style' );

function lans_instagram_admin_scripts() {
    wp_enqueue_script( '', plugins_url( 'js/lans-instagram-admin.js' , __FILE__ ), array(), LANSINSTA );

    if( !wp_script_is('jquery-ui-draggable') ) { 
        wp_enqueue_script(
            array(
            'jquery',
            'jquery-ui-core',
            'jquery-ui-draggable'
            )
        );
    }
    wp_enqueue_script(
        array(
        'hoverIntent',
        'wp-color-picker'
        )
    );
}
add_action( 'admin_enqueue_scripts', 'lans_instagram_admin_scripts' );

// Add a Settings link to the plugin on the Plugins page
$lans_plugin_file = 'lans-instagram-api/lans-instagram-api.php';
add_filter( "plugin_action_links_{$lans_plugin_file}", 'lans_add_settings_link', 10, 2 );
 
//modify the link by unshifting the array
function lans_add_settings_link( $links, $file ) {
    $lans_settings_link = '<a href="' . admin_url( 'admin.php?page=lans-lans-instagram-api' ) . '">' . __( 'Settings', 'lans-lans-instagram-api', 'lans-instagram-api' ) . '</a>';
    array_unshift( $links, $lans_settings_link );
 
    return $links;
}


?>