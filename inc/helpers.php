<?php /*
|--------------------------------------------------------------------------
| helpers.php
|--------------------------------------------------------------------------
|
| Common helpers
|
*/


/*
|--------------------------------------------------------------------------
| Tag for displaying images
|--------------------------------------------------------------------------
|
| Gets an <img> tag relative to the "img/". If a full URI is provided 
| (starts with http), then it will load from there.
|
|--------------------------------------------------------------------------
|
| [STR] $uri        - Location, relative to "img/". If the image starts with HTTP
| [ARR/STR] $atts   - Attributes or Alt Tag (if it's just a string)
|
|--------------------------------------------------------------------------
|
| RETURNS: [STR] The complete image tag
|
*/
function img($uri, $atts = ''){
    //- - - - - - - - - - - - - - - - - - - - - - - -
    // Relative vs Absolute
    //- - - - - - - - - - - - - - - - - - - - - - - -
    if(substr($uri, 0, 4) !== 'http')
        $uri = get_bloginfo('template_url') . '/img/' . $uri;

    //- - - - - - - - - - - - - - - - - - - - - - - -
    // Build attributes
    //- - - - - - - - - - - - - - - - - - - - - - - -
    if(is_array($atts)){
        if(!isset($atts['alt'])) $atts['alt'] = '';

        $str = '';
        foreach($atts as $key=>$att)
            $str .= $key . "='$att'";
        $atts = $str;
    } else {
        $atts = "alt='$atts'";
    }    

    return "<img src='$uri' $atts>";
}

/*
|--------------------------------------------------------------------------
| Tag for including javascript
|--------------------------------------------------------------------------
|
| !! DO NOT INCLUDE .js EXTENSION FOR RELATIVE URLS!!
|
| Enqueues a JS file relative to the "js/". If a full URI is provided 
| (starts with http), then it will load from there.
|
|--------------------------------------------------------------------------
|
| [STR] $uri        - Location, relative to "js/", this is also the handle to use for deps
| [STR] $deps       - The file dependencies (use the handle)
| 
|--------------------------------------------------------------------------
*/
function js($uri, $deps = false){
    $name = $uri;

    //- - - - - - - - - - - - - - - - - - - - - - - -
    // Relative vs Absolute
    //- - - - - - - - - - - - - - - - - - - - - - - -
    if(substr($uri, 0, 4) !== 'http')
        $uri = get_bloginfo('template_url') . '/js/' . $uri . '.js';

    wp_enqueue_script($name, $uri, $deps, null, true);
}