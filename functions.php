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

//- - - - - - - - - - - - - - - - - - - - - - - -
// Libraries
//- - - - - - - - - - - - - - - - - - - - - - - -
require 'lib/labofoz/framework-of-oz/init.php';

//- - - - - - - - - - - - - - - - - - - - - - - -
// CPT's
//- - - - - - - - - - - - - - - - - - - - - - - -
require 'inc/cpt/maps/maps.php';


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