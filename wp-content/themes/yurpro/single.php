<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <header>

                <h1><?php the_title(); ?></h1>
                <p>
                    <?php echo get_the_date(); ?> 【<?php the_category(', '); ?>】
                </p>                
            </header>

            <main>
                <article class="clearfix">
                    <?php the_content(); ?>
                </article>
            </main>
<?php endwhile; else: ?>

    <p>記事はありません！</p>

<?php endif; ?>
<?php get_footer();