<?php get_header(); ?>

<div class="pages">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>		
	<article class="post" id="post-<?php the_ID(); ?>">
		<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
		<?php edit_post_link('Edit Entry &uarr;', '<p>', '</p>'); ?>
	</article>
<?php endwhile; endif; ?>
	
</div>

<?php get_footer(); ?>