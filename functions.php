<?php
/**
 * Theme functions and definitions
 *
 * @package Theme
 */

if ( ! isset( $content_width ) )
    $content_width = 640;

// ACF
if (!class_exists('ACF')) {
    define( 'ACF_LITE' , FALSE );
    require_once 'inc/advanced-custom-fields/acf.php';
}
require_once "inc/advanced-custom-fields/acf-fields.php";

if ( ! function_exists( 'theme_setup' ) ) :
    function theme_setup() {
        add_filter('show_admin_bar', '__return_false');
        load_theme_textdomain( 'wptheme', get_template_directory() . '/languages' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'wptheme' ),
        ) );
        add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
        remove_action( 'wp_head', 'rel_canonical' );
        remove_action( 'wp_head', 'index_rel_link' );
        remove_action( 'wp_head', 'start_post_rel_link' );
        remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
        remove_action( 'wp_head', 'rsd_link' );
        remove_action( 'wp_head', 'wlwmanifest_link' );
        remove_action( 'wp_head', 'wp_shortlink_wp_head' );
        remove_action( 'template_redirect', 'wp_shortlink_header' );
    }
endif;
add_action( 'after_setup_theme', 'theme_setup' );

require_once get_template_directory() . '/inc/template-data.php';

function theme_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'wptheme' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );
}
add_action( 'widgets_init', 'theme_widgets_init' );

function theme_scripts() {
    global $post;

    wp_enqueue_style( 'theme-style', get_stylesheet_uri() );
    wp_enqueue_style( 'theme-mainstyle', get_template_directory_uri() . '/css/theme.css' );

    wp_enqueue_script( 'response-js', get_template_directory_uri() . '/js/response-0.7.8.min.js', array(), "0.7.8", false );
    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), "2.6.2", false );
    wp_enqueue_script( 'theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), null, true );
    wp_enqueue_script( 'theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), null, true );
    wp_enqueue_script( 'theme-mainscript', get_template_directory_uri() . '/js/theme.js', array('jquery'), null, true );

    $post_id     = isset($post->ID)          ? $post->ID          : 0;
    $post_name   = isset($post->post_name)   ? $post->post_name   : null;
    $post_author = isset($post->post_author) ? $post->post_author : 0;
    $post_type   = isset($post->post_type)   ? $post->post_type   : null;
    $post_status = isset($post->post_status) ? $post->post_status : null;
    $post_date   = isset($post->post_date)   ? $post->post_date   : null;

    wp_localize_script( 'theme-mainscript', 'wptheme', array(
        'ajaxurl'     => admin_url( 'admin-ajax.php' ),
        'nonce'       => wp_create_nonce( 'theme-nonce' ),
        'post_id'     => $post_id,
        'post_name'   => $post_name,
        'post_author' => $post_author,
        'post_type'   => $post_type,
        'post_status' => $post_status,
        'post_date'   => $post_date,
    ));

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'theme-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), null, true );
    }
}
add_action( 'wp_enqueue_scripts', 'theme_scripts' );

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/ajax.php';
require get_template_directory() . '/inc/theme-api.php';
require get_template_directory() . '/inc/post-types.php';
require get_template_directory() . '/inc/taxonomies.php';

// Swiper
function mytheme_enqueue_scripts() {
    wp_enqueue_style( 'swiper-css', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', [], '11' );
    wp_enqueue_script( 'swiper-js', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', [], '11', true );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_scripts' );

// Custom logo
function mytheme_setup() {
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );
}
add_action( 'after_setup_theme', 'mytheme_setup' );

// WooCommerce — usuń tylko wrappery, nic więcej
//add_action( 'after_setup_theme', function () {
//    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
//    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
//    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
//} );