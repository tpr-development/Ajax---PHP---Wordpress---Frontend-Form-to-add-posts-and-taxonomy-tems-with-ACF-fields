<?php
add_filter('show_admin_bar', '__return_false');
add_theme_support('menus');
include( get_template_directory() . '/foundation-topbar-menu-walker.php' );
/**
 * Register Menus
 * http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 */
// Register menus
register_nav_menus(
	array(
		'main-nav' => __( 'The Main Menu', 'jointswp' ),  // Main nav in header
        'secondary-nav' => __('Secondary Menu', 'jointswp'),   //Secondary nav in header
		'footer-links' => __( 'Footer Links', 'jointswp' ) // Secondary nav in footer
	)
);
/**
 * Left top bar
 * http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
//function foundation_top_bar_l() {
//    wp_nav_menu(array(
//        'container' => false,                           // Remove nav container
//        'menu_class' => 'vertical medium-horizontal menu',       // Adding custom nav class
//        'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion medium-dropdown">%3$s</ul>',
//        'theme_location' => 'primary',        			// Where it's located in the theme
//        'depth' => 5,                                   // Limit the depth of the nav
//        'fallback_cb' => false,                         // Fallback function (see below)
//        'walker' => new top_bar_walker()
//	));
//}
/**
 *
 * Offcanvas menu
 *
 *  */
function foundation_offcanvas_left() {
	 wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => 'vertical menu',       // Adding custom nav class
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'theme_location' => 'main-nav',        			// Where it's located in the theme
        //'depth' => 5,                                   // Limit the depth of the nav
        'fallback_cb' => false,                         // Fallback function (see below)
        'walker' => new F5_TOP_BAR_WALKER()
    ));
}
//To add a secondary menu to responsive sidebar un-comment this piece of code below
function foundation_offcanvas_right(){
    wp_nav_menu(array(
        'container' => false,                           // Remove nav container
        'menu_class' => 'vertical menu',       // Adding custom nav class
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'theme_location' => 'secondary-nav',        			// Where it's located in the theme
        //'depth' => 5,                                   // Limit the depth of the nav
        'fallback_cb' => false,                         // Fallback function (see below)
        'walker' => new F5_TOP_BAR_WALKER()
    ));
}

/**
 * Customize the output of menus for Foundation top bar
 */
//class top_bar_walker extends Walker_Nav_Menu {
//    function start_lvl(&$output, $depth = 0, $args = Array() ) {
//        $indent = str_repeat("\t", $depth);
//        $output .= "\n$indent<ul class=\"menu\">\n";
//    }
//
//}
//class Off_Canvas_Menu_Walker extends Walker_Nav_Menu {
//    function start_lvl(&$output, $depth = 0, $args = Array() ) {
//        $indent = str_repeat("\t", $depth);
//        $output .= "\n$indent<ul class=\"vertical nested menu\">\n";
//    }
//}
/*
* Enable featured image
*/
add_theme_support( 'post-thumbnails' );
/**
 *
 * Adding foundation files to the theme
 *
 *  */
function foundation_scripts_enqueue() {
    wp_register_script( 'jQuery-js', get_template_directory_uri() . '/js/vendor/jquery.js', array('jquery'), NULL, true );
    wp_register_script( 'foundation-js', get_template_directory_uri() . '/js/vendor/foundation.min.js', array('jquery'), NULL, true );
    wp_register_script( 'custom-js', get_template_directory_uri() . '/js/app.js', array('jquery'), NULL, true );
    wp_register_style( 'normalize-css', get_template_directory_uri() . '/css/normalize.css', false, NULL, 'all' );
    wp_register_style( 'matari-css', get_template_directory_uri() . '/css/foundation.min.css', false, NULL, 'all' );
    wp_register_style( 'basic-css', get_template_directory_uri() . '/css/basic.css', false, NULL, 'all' );
    wp_register_style( 'custom-css', get_template_directory_uri() . '/css/app.css', false, NULL, 'all' );
    wp_register_style( 'print-css', get_template_directory_uri() . '/css/print.css', false, NULL, 'all' );
    wp_register_style( 'fontawesome-css', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', false, NULL, 'all' );
    wp_enqueue_script( 'jQuery-js' );
    wp_enqueue_script( 'foundation-js' );
    wp_enqueue_script( 'custom-js' );
    wp_enqueue_style( 'normalize-css' );
    wp_enqueue_style( 'foundation-css' );
    wp_enqueue_style( 'basic-css' );
    wp_enqueue_style( 'custom-css' );
    wp_enqueue_style( 'print-css' );
    wp_enqueue_style( 'fontawesome-css' );
}
add_action( 'wp_enqueue_scripts', 'foundation_scripts_enqueue' );
/**
 *
 * Adding widget areas in sidebar
 *
  */
function default_sidebar_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'default' ),
		'id'            => 'sidebar1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'default_sidebar_widgets_init' );
/**
 *
 * Adding widget areas in footer left
 *
 *  */
function default_footer_left_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Left Footer Section', 'default' ),
		'id'            => 'sidebar-footer-left',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'default_footer_left_widgets_init' );
/**
 *
 * Adding widget areas in footer center
 *
 *  */
function default_footer_center_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Middle Footer Section', 'default' ),
		'id'            => 'sidebar-footer-center',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'default_footer_center_widgets_init' );
/**
 *
 * Adding widget areas in footer right
 *
 *  */
function default_footer_right_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Right Footer Section', 'default' ),
		'id'            => 'sidebar-footer-right',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'default_footer_right_widgets_init' );
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
        'audio'
    ) );

/**
 *
 * Gallery link to large
*/
function oikos_get_attachment_link_filter( $content, $post_id, $size, $permalink ) {

    // Only do this if we're getting the file URL
    if (! $permalink) {
        // This returns an array of (url, width, height)
        $image = wp_get_attachment_image_src( $post_id, 'large' );
        $new_content = preg_replace('/href=\'(.*?)\'/', 'href=\'' . $image[0] . '\'', $content );
        return $new_content;
    } else {
        return $content;
    }
}

add_filter('wp_get_attachment_link', 'oikos_get_attachment_link_filter', 10, 4);
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

add_filter( 'nav_menu_link_attributes', 'wpse121123_contact_menu_atts', 10, 3 );
function wpse121123_contact_menu_atts( $atts, $item, $args )
{
  // The ID of the target menu item
  $menu_target = 123;

  // inspect $item
  if ($item->ID == $menu_target) {
    $atts['data-toggle'] = 'modal';
  }
  return $atts;
}
