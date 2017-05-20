<?php get_header(); ?>

<div id="index">
    <header>
        <div id="logo">
            <h1><?php bloginfo('name'); ?></h1>
            <p class="description"><?php bloginfo("description"); ?></p>            
        </div>
    </header>

    <main>
        <article>

            <h2>新着記事</h2>
            <div id="articles" class="clearfix">
                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                    <ul>
                        <li>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br>
                            <p style="font-size:14px; text-indent: 20px;">(<?php echo get_the_date(); ?>)【<?php the_category(', '); ?>】</p>
                        </li>
                    </ul>
                <?php endwhile; else: ?>
                    <p>記事はありません。</p>
                <?php endif; ?>
            </div>

        </article>
    </main>
</div>
<?php get_footer();