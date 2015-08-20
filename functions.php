<?php
/**
 * Popaganda 2015 functions and definitions
 *
 * @package Popaganda 2015
 */

if ( ! function_exists( 'popa15_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function popa15_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Popaganda 2015, use a find and replace
	 * to change 'popa15' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'popa15', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 350, 350, true ); // crop to square
	// strip hardcoded width and height from thumbnail img
	function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
			$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
			return $html;
	}
	add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'popa15' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'popa15_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

}
endif; // popa15_setup
add_action( 'after_setup_theme', 'popa15_setup' );

/**
 * Hide admin bar on non-admin sections of site
 */
add_filter('show_admin_bar', '__return_false');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function popa15_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'popa15_content_width', 640 );
}
add_action( 'after_setup_theme', 'popa15_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function popa15_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'popa15' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'popa15_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function popa15_scripts() {
	wp_enqueue_style( 'bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css', array(), '3.3.4' );
	wp_enqueue_style( 'popa15-style', get_stylesheet_uri(), array(), '20150820_3' );
	wp_enqueue_style( 'google-fonts-amaticsc', '//fonts.googleapis.com/css?family=Amatic+SC:400,700&subset=latin-ext');

	wp_deregister_script( 'jquery' );
  wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), array(), null, true );
  wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', array('jquery'), '3.3.4', true);

	//wp_enqueue_script( 'popa15-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	// theme custom js
	wp_enqueue_script( 'popa15-custom', get_template_directory_uri() . '/js/popa15.js', array(), '20150813_2', true );

	wp_enqueue_script( 'popa15-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'popa15_scripts' );

/*
Fetches all available social media meta-tags, if there are any. (for artist pages)
*/
function get_meta($id)
{
	$metas = array("web", "spotify", "myspace", "facebook", "soundcloud");
	$found = false;
	$content = '<ul id="meta">

			';
	for ($i = 0; $i < count($metas); $i++)
	{
		if ($meta = get_post_meta($id, $metas[$i], true))
		{
			$content .= '			<li class="'.strtolower($metas[$i]).'"><a href="'.$meta.'" title="'.ucwords($metas[$i]).'"></a></li>
			';
			$found = true;
		}
	}
	$content .= '
					</ul>
					';
	if ($found)
	{
		return $content;
	}
}


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Include custom walker for bootstrap nav.
 */
require_once('inc/wp_bootstrap_navwalker.php');

/**
 * Make nav links on first page internal (one-page)
 */
function popa15_onepage_nav_links( $atts, $item, $args ) {
	if ( is_front_page() && $item->type != "custom" ) {
		$link_page = get_post($item->object_id);
		$atts['href'] = '#' . $link_page->post_name;
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'popa15_onepage_nav_links', 10, 3 );

/**
 * For a certain set of pages, redirect to the corresponding section on front
 */
function popa15_redirect_pages_to_front() {
	// redirect the pages below to that section on the front page
	// (should maybe use get_nav_menu_items, but can't be bothered)
	$sections = Array( 'nyheter', 'program', 'biljetter', 'info', 'kontakt', 'english' );
	global $post;
	$postname = $post->post_name;
	if ( in_array( $postname, $sections ) ) {
		wp_redirect( home_url( '#' . $postname ), 301 ); exit;
	}
}
add_action( 'template_redirect', 'popa15_redirect_pages_to_front' );

/**
 * Redirect author archives to front page
 */
function author_archive_redirect() {
   if( is_author() ) {
       wp_redirect( home_url(), 301 );
       exit;
   }
}
add_action( 'template_redirect', 'author_archive_redirect' );
