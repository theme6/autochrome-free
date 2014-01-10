<?php get_header(); ?>

<?php if (have_posts()) : ?>
	<div class="gallery">
		<?php while (have_posts()) : the_post(); ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<img src="<?php echo autochrome_image_display('gallery-thumb'); ?>" alt="<?php the_title(); ?>" />
				<time class="meta" datetime="<?php echo date(DATE_W3C); ?>" pubdate class="updated"><?php the_time('M j, Y') ?></time>
			</a>
		<?php endwhile; ?>
	</div>
<?php else : ?>
	<div class="_photo _nophoto">
		<div class="not-found">
			<p class="title">Not Found</p>
			<p class="tagline"><?php _e('No matching photos! Please, search something else.'); ?></p>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>
