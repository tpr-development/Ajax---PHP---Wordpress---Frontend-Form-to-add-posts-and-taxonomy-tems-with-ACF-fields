<?php
/**
 * cdb functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package cdb
 */

if ( ! function_exists( 'cdb_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cdb_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on cdb, use a find and replace
	 * to change 'cdb' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'cdb', get_template_directory() . '/languages' );

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
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'cdb' ),
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
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'cdb_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // cdb_setup
add_action( 'after_setup_theme', 'cdb_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cdb_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cdb_content_width', 640 );
}
add_action( 'after_setup_theme', 'cdb_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cdb_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'cdb' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'cdb_widgets_init' );


function cdb_widgets_init1() {
	register_sidebar( array(
		'name'          => esc_html__( 'HomeWidget', 'cdb' ),
		'id'            => 'homeWidget',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'cdb_widgets_init1' );
/* material files */
function materialize_scripts_enqueue() {
		wp_register_style( 'normalize-css',  get_template_directory_uri().'/normalize.css', false, NULL, 'all' );
    wp_register_style( 'materialize-css', 'https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/css/materialize.min.css', false, NULL, 'all' );
		wp_register_style( 'selectSearch-css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css', false, NULL, 'all' );
		wp_register_style('custom-css', get_template_directory_uri().'/custom.css', false, NULL, 'all');
    wp_register_style( 'font-css', 'https://fonts.googleapis.com/icon?family=Material+Icons', false, NULL, 'all' );
    wp_enqueue_style( 'normalize-css' );
    wp_enqueue_style( 'materialize-css' );
		wp_enqueue_style( 'selectSearch-css' );
		wp_enqueue_style( 'custom-css' );
    wp_enqueue_style( 'font-css' );
}
add_action( 'wp_enqueue_scripts', 'materialize_scripts_enqueue' );

/*
 * Load Nav Walker
 */
require_once('wp_bootstrap_navwalker.php');
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
/*
 * Search Form
 */
add_theme_support( 'html5', array( 'search-form' ) );
/*
 * Delimit search results by 9
 */
add_action('pre_get_posts', 'change_search_limit');
function change_search_limit($query){
    $number_of_posts = -1;
    if ( $query->is_main_query() && is_search() )
        $query->set('posts_per_page', $number_of_posts);
}

// Remove Admin bar for non-admins
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}
/*
 *
 * Add class to wp_get_archive
 *
 * */
add_filter( 'get_archives_link', 'add_css_class_to_wp_get_archive_links'  );

function add_css_class_to_wp_get_archive_links( $link ) {
  $link = str_replace( 'href', 'class="waves-effect waves-teal white-text" href', $link );
  return $link;
}
/**
 *
 * Remove title text from archive page
 *
 * */
add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

            $title = single_cat_title( '', false );

        } elseif ( is_tag() ) {

            $title = single_tag_title( '', false );

        } elseif ( is_author() ) {

            $title = '<span class="vcard">' . get_the_author() . '</span>' ;

        }elseif (is_tax()) {
        $title = single_term_title( '', false );
    }

    return $title;

});

/*
* Excerpt function
*/

function custom_wp_trim_excerpt($text) {
$raw_excerpt = $text;
if ( '' == $text ) {
    $text = get_the_content('');

    $text = strip_shortcodes( $text );

    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);

    /***Add the allowed HTML tags separated by a comma.***/
    $allowed_tags = ''; // <p>,<a>,<em>,<strong>
    $text = strip_tags($text, $allowed_tags);

    /***Change the excerpt word count.***/
    $excerpt_word_count = 40;
    $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count);

    /*** Change the excerpt ending.***/
    $excerpt_end = '...';//' <a href="'. get_permalink($post->ID) . '">' . '&raquo; Continue Reading.' . '</a>';
    $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);

    $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
        array_pop($words);
        $text = implode(' ', $words);
        $text = $text . $excerpt_more;
    } else {
        $text = implode(' ', $words);
    }
}
return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'custom_wp_trim_excerpt');

// Function to change sender name
function wpb_sender_name( $original_email_from ) {
return 'Abhinandan';
}

// Hooking up our functions to WordPress filters
add_filter( 'wp_mail_from_name', 'wpb_sender_name' );
