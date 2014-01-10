<?php
/*
Template Name: Gallery
*/
?>

<?php get_header(); ?>

<div class="gallery">
	<?php
		$posts = get_posts('numberposts=-1');
		foreach($posts as $post) : setup_postdata($post);
	?>	
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		<img src="<?php echo autochrome_image_display('gallery-thumb'); ?>" alt="<?php the_title(); ?>" />
		<time class="meta" datetime="<?php echo date(DATE_W3C); ?>" pubdate class="updated"><?php the_time('M j, Y') ?></time>
	</a>
	<?php endforeach; ?>
</div>

<?php get_footer(); ?>