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
	wp_enqueue_style( 'popa15-style', get_stylesheet_uri() );

	wp_deregister_script( 'jquery' );
  wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), array(), null, true );
  wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', array('jquery'), '3.3.4', true);

	//wp_enqueue_script( 'popa15-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	// theme custom js
	wp_enqueue_script( 'popa15-custom', get_template_directory_uri() . '/js/popa15.js', array(), '20150621', true );

	wp_enqueue_script( 'popa15-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'popa15_scripts' );

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
	if (is_front_page()) {
		$link_page = get_post($item->object_id);
		$atts['href'] = '#' . $link_page->post_name;
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'popa15_onepage_nav_links', 10, 3 );
