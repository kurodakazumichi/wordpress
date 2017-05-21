<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <header>
                <h1><?php the_title(); ?></h1>
            </header>

            <main>
                <article>
                    <?php print_r(get_post($post->post_parent)); ?>
                    <?php the_content(); ?>
                </article>
            </main>
<?php endwhile; else: ?>

    <p>記事はありません！</p>

<?php endif; ?>
<?php get_footer();