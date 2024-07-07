<?php
	$query = new WP_Query(array(
		'post_type' => 'wedevs_post',
	));
?>
<ul>
	<?php
		while( $query->have_posts() ):
			$query->the_post();
	?>
	<li><?php the_title(); ?></li>
	<?php endwhile; ?>
</ul>
