<?php get_header(); ?>

<?php foreach(get_tags() as $tag): ?>

<a href="<?php echo get_tag_link($tag); ?>" title="<?php echo $tag->description; ?>"><?php echo $tag->name; ?></a>
<span>(<?php echo $tag->count; ?>件)</span>

<?php endforeach; ?>
<?php get_footer();