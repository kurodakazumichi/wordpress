
<?php

add_theme_support('menus');

add_filter( 'show_admin_bar', '__return_false' );

add_theme_support('post-thumbnails');

/**
 * CSSを読み込むlinkタグを出力する関数
 */
function load_css($css, $timestamp = true){
    $url = get_template_directory_uri() . $css;
            
    if ($timestamp)
    {
        $url .= "?" . filemtime(get_stylesheet_directory() . $css);
    }
    
    echo '<link rel="stylesheet" type="text/css" href="' . $url . '">';
}