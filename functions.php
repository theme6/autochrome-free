<?php

// Add RSS links to <head> section
automatic_feed_links();

// Load jQuery
if ( !function_exists(core_mods) ) {
	function core_mods() {
		if ( !is_admin() ) {
			wp_deregister_script('jquery');
			wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"), false);
			/* wp_enqueue_script('jquery'); */ // let's add this manually in the footer
		}
	}
	core_mods();
}

// Clean up the <head>
function removeHeadLinks() {
	remove_action('wp_head', 'wp_generator'); // Generators
	/* remove_action('wp_head', 'wlwmanifest_link'); */ // for Windows Live Writer
	/* remove_action('wp_head', 'rsd_link'); */ // Blogging tools need this
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');

// Custom Image thumbnail
if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' ); 
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'menus' );
	set_post_thumbnail_size( 160, 100 ); // set the default thumbnail size
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'gallery-thumb', 160, 100, true );
}

// Theme support
register_nav_menus( array('primary' => __( 'Primary Menu', 'autochrome' ),));

// Filter wp_nav_menu() to add additional links and other output
function autochrome_feed_link($items) {
	// $homelink = '<li class="home"><a href="' . home_url( '/' ) . '">' . __('Home') . '</a></li>';
	$feedlink = '<li class="feed last"><a class="s24r icon-rss-24" href="' . get_bloginfo_rss('rss2_url') . '">' . __('Feed') . '</a></li>';
	$items = $items . $feedlink;
	return $items;
}
add_filter( 'wp_list_pages', 'autochrome_feed_link' );
add_filter( 'wp_nav_menu_items', 'autochrome_feed_link' );

/*
If a post has post_thumbnail, display it
else, get the first image from the post and display it,
else, give 'em a default image.

USAGE
<?php echo autochrome_image_display(); ?>
*/
function autochrome_image_display($size = 'full') {
	if (has_post_thumbnail()) {
		$image_id = get_post_thumbnail_id();
		$image_url = wp_get_attachment_image_src($image_id, $size);
		$image_url = $image_url[0];
	} else {
		global $post, $posts;
		$image_url = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$image_url = $matches [1] [0];
		
		//Defines a default image
		if(empty($image_url)){
			$image_url = get_bloginfo('template_url') . "/img/default.jpg";
		}
	}
	return $image_url;
}

/*
Random Redirect
Adapted from
http://wordpress.org/extend/plugins/random-redirect/
*/

function autochrome_random_redirect() {
	global $wpdb;
	$query = "SELECT ID FROM $wpdb->posts WHERE post_type = 'post' AND post_password = '' AND 	post_status = 'publish' ORDER BY RAND() LIMIT 1";
	if ( isset( $_GET['random_cat_id'] ) ) {
		$random_cat_id = (int) $_GET['random_cat_id'];
		$query = "SELECT DISTINCT ID FROM $wpdb->posts AS p INNER JOIN $wpdb->term_relationships AS tr ON (p.ID = tr.object_id AND tr.term_taxonomy_id = $random_cat_id) INNER JOIN  $wpdb->term_taxonomy AS tt ON(tr.term_taxonomy_id = tt.term_taxonomy_id AND taxonomy = 'category') WHERE post_type = 'post' AND post_password = '' AND 	post_status = 'publish' ORDER BY RAND() LIMIT 1";
	}
	if ( isset( $_GET['random_post_type'] ) ) {
		$post_type = preg_replace( '|[^a-z]|i', '', $_GET['random_post_type'] );
		$query = "SELECT ID FROM $wpdb->posts WHERE post_type = '$post_type' AND post_password = '' AND 	post_status = 'publish' ORDER BY RAND() LIMIT 1";
	}
	$random_id = $wpdb->get_var( $query );
	wp_redirect( get_permalink( $random_id ) );
	exit;
}

if ( isset( $_GET['random'] ) )
	add_action( 'template_redirect', 'autochrome_random_redirect' );
	
/*
Post Thumbnail in RSS Feed
The theme is about Photos, let's have in the RSS feed too

Display Format

<img src="" alt="" width="" height="" border="0" />
<p>View the full photo at &mdash; <a href="">Title of the Post</a></p>
*/
function thumbnail_rss($rss_content) {
    global $post;
    if ( function_exists( 'autochrome_image_display' ) ) {
        $rss_content =
        	'<p><img width="640" height="auto" border="0" src="' . autochrome_image_display('large') . '" /></p>
        	 <p><Strong>Tip: </strong><em>Visit the website to view the full photo.</em></p>';
    }
    return $rss_content;
}
add_filter('the_content_feed', 'thumbnail_rss');
add_filter('the_excerpt_rss', 'thumbnail_rss');

?>