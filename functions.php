<?php /*
|--------------------------------------------------------------------------
| functions.php
|--------------------------------------------------------------------------
|
| Global functions and includes
|
*/
add_action('admin_head', function(){echo '<link rel="shortcut icon" href="',get_template_directory_uri(),'/favicon.ico" />',"\n";});
require 'inc/helpers.php';

/*
|--------------------------------------------------------------------------
| Change default admin color scheme
|--------------------------------------------------------------------------
|
| Also displays the scheme on the front end
*/
add_action('user_register', function($user_id){
    $args = array(  
        'ID' => $user_id,  
        'admin_color' => 'coffee'
    );  
    wp_update_user( $args );
});
add_action('wp_before_admin_bar_render', function(){
    global $_wp_admin_css_colors;
    if ( count( $_wp_admin_css_colors ) > 1 && has_action( 'admin_color_scheme_picker' ) )
        update_option( 'wp_admin_color_schemes', $_wp_admin_css_colors );
});
add_action('wp_enqueue_scripts', function(){
    if ( ! is_admin_bar_showing() )
        return;

    $user_color = get_user_option( 'admin_color' );
    if ( isset( $user_color ) ) {
        $wp_admin_color_schemes = get_option( 'wp_admin_color_schemes' );
        wp_enqueue_style( $user_color, $wp_admin_color_schemes[$user_color]->url );
    }    
});



/*
|--------------------------------------------------------------------------
| Remove Default image sizes
|--------------------------------------------------------------------------
*/
function remove_default_sizes( $sizes) {
    unset( $sizes['thumbnail']);
    unset( $sizes['medium']);
    unset( $sizes['large']);
     
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'remove_default_sizes');