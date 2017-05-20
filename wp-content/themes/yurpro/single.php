<?php get_header(); ?>
<?php
if (have_posts()) :
    while (have_posts()) :
        the_post();
?>
            <header class="single">

                <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                <div class="post-meta">
                    <?php echo get_the_date(); ?> 【<?php the_category(', '); ?>】
                </div>                
            </header>
            

            <main class="single">
                <article>
                    <?php the_content(); ?>
                </article>
            </main>
<?php
    endwhile;
else:
?>

<p>記事はありません！</p>

<?php
endif;
?>
<?php get_footer(); ?>