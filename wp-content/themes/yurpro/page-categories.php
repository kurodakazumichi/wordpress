<?php get_header(); ?>

<?php
    $categories = get_categories(array("parent" => 0, "hide_empty" => false, "exclude" => "1"));
?>

<div class="clearfix">
<?php foreach ($categories as $key => $cate): ?>


    

    <div class="category">
        <div class="header"><?php echo $cate->name; ?></div>
        <div class="body">
            <?php wp_list_categories(array(
                "use_desc_for_title" => true,
                "show_count" => true,
                "title_li" => "",
                "pad_counts" => true,
                "child_of" => $cate->cat_ID,
                "hide_empty" => false,
            )); ?>
        </div>
        <div class="footer">&nbsp;</div>
    </div>

    <?php if((($key + 1) % 3) == 0): ?>
    
</div><div class="clearfix">
    <?php endif; ?>
    
<?php endforeach; ?>
</div>
<?php get_footer();