<?php //$data = $wpdb->get_results( "SELECT post_title FROM $wpdb->posts where post_status = 'publish' and post_type = 'post' order by post_date desc limit 3" );
//foreach ($data as $value) {
// echo $value->post_title . "<br />";
// echo get_permalink($value->id);
//}

//$query = get_posts( array(
//	'orderby' => 'default_date',
//	'order' => 'DESC',
//        'posts_per_page' => "10"
//));
//foreach ($query as $value) {
// echo $value->post_title;
// echo get_permalink($value->ID);
// echo "<br />";
//}


global $wpdb;


?>

<table border="1" style="font-size:13px">
    <?php foreach($wpdb->queries as $key => $info): ?>
        <tr><th style="background:#abcdef">Query No <?php echo $key; ?></th></tr>
        <tr><td><?php echo $info[0]; ?></td></tr>
        <tr><td><?php echo $info[1]; ?></td></tr>
        <tr><td><?php echo $info[2]; ?></td></tr>
    <?php endforeach; ?>
</table>
