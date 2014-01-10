<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>

<title><?php
  if (function_exists('is_tag') && is_tag()) {
     single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
  elseif (is_archive()) {
     wp_title(''); echo ' Archive - '; }
  elseif (is_search()) {
     echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
  elseif (!(is_404()) && (is_single()) || (is_page())) {
     wp_title(''); echo ' - '; }
  elseif (is_404()) {
     echo 'Not Found - '; }
  if (is_home()) {
     bloginfo('name'); echo ' - '; bloginfo('description'); }
  else {
      bloginfo('name'); }
  if ($paged>1) {
     echo ' - page '. $paged; }
?></title>

<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="<?php bloginfo('description'); ?>">

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<script src="<?php bloginfo('template_url'); ?>/js/modernizr.custom.11445.js"></script>

<?php
	wp_enqueue_script( 'comment-reply' );
	wp_deregister_script('jquery');
	wp_head();
?>
</head>

<body <?php body_class(); ?>>

<header id="header" class="grids">
	<div class="g1of3">
		<section id="logo">
			<a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a>
		</section>
	</div>
	<div class="g2of3 alignright">
		<?php get_search_form(); ?>
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'nav', 'container_id' => 'nav', 'fallback_cb' => 'wp_page_menu' )); ?>
	</div>
</header>