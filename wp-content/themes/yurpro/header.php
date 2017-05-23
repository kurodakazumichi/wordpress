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
    </head>
    <body>
        
        <div id="wrapper">
           
            <nav class="clearfix">
                <p class="logo"><a href="<?php echo home_url('/');?>"><?php bloginfo('name'); ?></a><?php edit_post_link(); ?></p>
                <div style="float:left; margin:10px;"><?php get_search_form(); ?></div>
                <?php wp_nav_menu(""); ?>
            </nav>
            
            <header>
                <div>
                    <div id="head-title" class="<?php echo EX::get_page_type(); ?>">
                        <h1><?php echo EX::get_page_title(); ?></h1>
                    </div>

                    <div class="description">
                        <?php if(is_front_page() || is_home()): ?>
                           <?php bloginfo("description"); ?>
                        <?php else: ?>
                            <?php if(is_single()): ?>
                               <span class="date"><?php echo get_the_date(); ?></span>
                            <?php endif; ?>
                            <?php if(has_category() && (is_single() || is_category())): ?>
                                <span class="category"><?php the_category(" "); ?></span>
                            <?php endif; ?>
                            <?php if(has_tag()): ?>
                                <span class="tag"><?php the_tags("", " "); ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>                        

                </div>
            </header>
            <main>
                <article>
       

