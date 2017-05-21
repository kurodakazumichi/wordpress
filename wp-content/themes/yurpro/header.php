<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
        <?php wp_head(); ?>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/earlyaccess/roundedmplus1c.css">
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.9.1/build/cssreset/cssreset-min.css">
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); echo '?' . filemtime( get_stylesheet_directory() . '/style.css'); ?>">
        
        <?php if(is_single()): ?>
            <?php load_css("/css/style-single.css"); ?>
            <?php if(in_category('summary')){ load_css("/css/style-category-summary.css"); } ?>
        
        <?php else: ?>
            <?php load_css("/css/style-index.css"); ?>
        <?php endif; ?>
    </head>
    <body>
        
        <div id="wrapper">
           
            <nav class="clearfix">
                <p class="logo"><a href="<?php echo home_url('/');?>"><?php bloginfo('name'); ?></a><?php edit_post_link(); ?></p>
                <?php wp_nav_menu(); ?>
            </nav>

