<?php /*
|--------------------------------------------------------------------------
| The Maps CPT
|--------------------------------------------------------------------------
*/
global $oz;
$oz->cpt([
    'id'        => 'maps',
    'singular'  => 'Map',
    'menu_icon' => 'dashicons-admin-site',
    'supports'  => ['title']
]);

add_action('acf/register_fields', function(){
    require 'acf.php';
});