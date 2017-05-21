<?php get_header(); ?>
            
<header>
    <div>
        <h1><?php bloginfo('name'); ?></h1>
        <p class="description"><?php bloginfo("description"); ?></p>            
    </div>
</header>

<main>
    <article>
        <h2>新着記事</h2>
        <div id="articles" class="clearfix">
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                <dl>
                    <dt><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dt>
                    <dd><p style="">(<?php echo get_the_date(); ?>)【<?php the_category(', '); ?>】</p></dd>
                </ul>
            <?php endwhile; else: ?>
                <p>記事はありません。</p>
            <?php endif; ?>
        </div>
    </article>
</main>
            
<?php get_footer();