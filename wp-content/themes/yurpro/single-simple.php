<?php
$meta = get_post_meta($post->ID);
$date = date("Ymdhis");

?><!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
        <?php EX::the_load_meta_css($post, "css"); ?>
        <?php EX::the_load_meta_js($post, "js"); ?>
        <?php EX::the_load_meta_script($post, "script"); ?>
    </head>
    <body>
        
        <?php echo $post->post_content; ?>
        <?php EX::the_load_meta_js($post, "after_js"); ?>
        <?php EX::the_load_meta_script($post, "after_script"); ?>
    </body>
</html>