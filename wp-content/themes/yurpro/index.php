<?php get_header(); ?>
            
<?php
    // 新着記事を取得
    $posts = EX::get_new_posts();
?>
<h2>新着記事</h2>
<div>
        
    <?php if(0 < count($posts)): ?>
        <dl>    
            <?php foreach($posts as $post): ?>
                <dt><a href="<?php the_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></dt>
                <dd>(<?php echo get_the_date("", $post->ID); ?>)【<?php the_category(', ', "", $post->ID); ?>】</dd>
            <?php endforeach; ?>
        </dl>
    <?php else: ?>
         <p>記事はありません。</p>
    <?php endif; ?>
</div>
   
<?php get_footer();