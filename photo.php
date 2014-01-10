<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="_photo" style="background-image: url(<?php echo autochrome_image_display(); ?>);">
	<img src="<?php echo autochrome_image_display(); ?>" alt="<?php the_title(); ?>" />
</div>

<footer id="footer" class="grids">
	<div class="g1of2">
		<section id="info">
			<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
				<?php if (!is_home()) { ?><h1 class="title">&rsaquo; <?php the_title(); ?></h1><?php } ?>
				<?php if (is_home()) { ?><h1 class="title">&rsaquo; <a href="<?php the_permalink() ?>" title="Permaliink to <?php the_title(); ?>"><?php the_title(); ?></a></h1><?php } ?>
				<?php if (is_single()) { ?><p class="meta"><small>&rsaquo; <?php comments_popup_link('Add a Comment', '1 Comment', '% Comments', 'js_modal'); ?></small></p><?php } ?>
				<?php edit_post_link('Edit','<small>&rsaquo; ','</small>'); ?>
			</article>
		</section>
	</div>
	<div class="g1of2">
		<nav id="paginate">

			<?php /* To Remove this. Buy the PRO version at http://theme6.com/ */ ?>
			<small class="powered"><a href="http://theme6.com/autochrome/">Buy Autochrome (PRO) Theme</a></small>

			<?php previous_post_link('<span class="prev">&larr; %link &middot;</span>', 'Older'); ?>
			<span class="random"><a href="<?php echo get_option('home'); ?>/?random">Random</a></span>
			<?php next_post_link('<span class="next">&middot; %link &rarr;</span>', 'Newer'); ?>
		</nav>
	</div>
</footer>

<div class="_modal">
	<a href="javascript: void(0);" class="js_close close s16r icon-delete">Close</a>
	<div class="_mctn">
		<?php comments_template(); ?>
	</div>
</div>

<?php endwhile; ?>
<?php else : ?>

<div class="_photo _nophoto">
	<div class="not-found">
		<p class="title">Not Found</p>
		<p class="tagline"><?php _e('Nah! I didn\'t. There were no photos at all.'); ?></p>
	</div>
</div>

<?php endif; ?>