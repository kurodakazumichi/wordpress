<?php get_header(); ?>
            
<h2>該当記事(<?php echo $wp_query->found_posts; ?>件)</h2>
<div>
    <?php if(have_posts()): ?>
        <?php if(is_category()): ?>
            <ol>
                <?php while(have_posts()) : the_post(); ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                <?php endwhile; ?>                    
            </ol>
        <?php else: ?>
            <dl>        
                <?php while(have_posts()) : the_post(); ?>
                        <dt><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dt>
                        <dd>
                            (<?php echo get_the_date(); ?>)
                            <?php if(has_category()): ?>
                                【<?php the_category(', '); ?>】
                            <?php endif; ?>                
                        </dd>
                <?php endwhile; ?>
            </dl>    
        <?php endif; ?>

    <?php else: ?>
        <p>記事はありません。</p>
    <?php endif; ?>
</div>
    
<?php previous_posts_link( "前へ" ); ?>
<?php next_posts_link( "次へ" ); ?>
<?php get_footer();
