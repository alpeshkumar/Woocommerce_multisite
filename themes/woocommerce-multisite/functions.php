<?php
/**
 * Woocommerce Multisite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package multisite_Ab
 */
 
include_once 'custom_function.php';

if ( ! function_exists( 'ecommerce_gem_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ecommerce_gem_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Woocommerce Multisite, use a find and replace
	 * to change 'woocommerce-multisite' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'woocommerce-multisite', get_template_directory() . '/languages' );

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
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo', array(
                'height'      => 60,
                'width'       => 400,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('woocommerce-multisite-common', 370, 260, true);

	// Register navigation menu locations.
	register_nav_menus( array(
		'top' 		=> esc_html__( 'Top Header', 'woocommerce-multisite' ),
		'primary' 	=> esc_html__( 'Primary Header', 'woocommerce-multisite' ),
		'social'  	=> esc_html__( 'Social Links', 'woocommerce-multisite' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ecommerce_gem_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add woocommerce support, gallery zoom, lightbox and thumbnail slider.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	$gallery_zoom = ecommerce_gem_get_option( 'enable_gallery_zoom' );

	if( 1 == $gallery_zoom ){
		add_theme_support( 'wc-product-gallery-zoom' );
	}
}
endif;
add_action( 'after_setup_theme', 'ecommerce_gem_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ecommerce_gem_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ecommerce_gem_content_width', 810 );
}
add_action( 'after_setup_theme', 'ecommerce_gem_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ecommerce_gem_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'woocommerce-multisite' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in Sidebar.', 'woocommerce-multisite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	if( class_exists( 'WooCommerce' ) ){

		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'woocommerce-multisite' ),
			'id'            => 'shop-sidebar',
			'description'   => esc_html__( 'Widgets added here will appear in sidebar of shop pages only.', 'woocommerce-multisite' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

	}

	register_sidebar( array(
		'name'          => esc_html__( 'Advertisements Below Slider', 'woocommerce-multisite' ),
		'id'            => 'advertisement-area',
		'description'   => esc_html__( 'Add widgets here to appear in advertisement area below main slider of home page', 'woocommerce-multisite' ),
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Home Page Widget Area', 'woocommerce-multisite' ),
		'id'            => 'home-page-widget-area',
		'description'   => esc_html__( 'Add widgets here to appear in Home Page Widget Area.', 'woocommerce-multisite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="container">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'woocommerce-multisite' ), 1 ),
		'id'            => 'footer-1',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'woocommerce-multisite' ), 2 ),
		'id'            => 'footer-2',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'woocommerce-multisite' ), 3 ),
		'id'            => 'footer-3',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Footer %d', 'woocommerce-multisite' ), 4 ),
		'id'            => 'footer-4',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Shop & Category page banner', 'woocommerce-multisite' ), 4 ),
		'id'            => 'shop-category-banner',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => sprintf( esc_html__( 'Single Product page', 'woocommerce-multisite' ), 4 ),
		'id'            => 'single-product-page',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'ecommerce_gem_widgets_init' );

/**
* Enqueue scripts and styles.
*/
function ecommerce_gem_scripts() {

	wp_enqueue_style( 'woocommerce-multisite-fonts', ecommerce_gem_fonts_url(), array(), null );

	wp_enqueue_style( 'jquery-meanmenu', get_template_directory_uri() . '/assets/third-party/meanmenu/meanmenu.css' );

	wp_enqueue_style( 'jquery-slick', get_template_directory_uri() . '/assets/third-party/slick/slick.css', '', '1.6.0' );

	wp_enqueue_style( 'woocommerce-multisite-icons', get_template_directory_uri() . '/assets/third-party/et-line/css/icons.css', '', '1.0.0' );

	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/third-party/font-awesome/css/font-awesome.min.css', '', '4.7.0' );

	wp_enqueue_style( 'woocommerce-multisite-style', get_template_directory_uri().'/style.css' );

	wp_enqueue_script( 'woocommerce-multisite-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'woocommerce-multisite-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'jquery-meanmenu', get_template_directory_uri() . '/assets/third-party/meanmenu/jquery.meanmenu.js', array('jquery'), '2.0.2', true );

	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/assets/third-party/slick/slick.js', array('jquery'), '1.6.0', true );

	// Add script for sticky sidebar.
	$sticky_sidebar = ecommerce_gem_get_option( 'enable_sticky_sidebar' );

	if( 1 == $sticky_sidebar ){

		wp_enqueue_script( 'jquery-theia-sticky-sidebar', get_template_directory_uri() . '/assets/third-party/theia-sticky-sidebar/theia-sticky-sidebar.min.js', array('jquery'), '1.0.7', true );

	}

	wp_enqueue_script( 'woocommerce-multisite-custom', get_template_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), '2.1.3', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
        
        $enable_sticky = ecommerce_gem_get_option('enable_sticky');

        if (true === $enable_sticky) {

            wp_enqueue_script('jquery-sticky', get_template_directory_uri() . '/assets/third-party/sticky/jquery.sticky.js', array('jquery'), '1.0.4', true);

            wp_enqueue_script('pt-magazine-custom-sticky', get_template_directory_uri() . '/assets/third-party/sticky/custom-sticky.js', array('jquery-sticky'), '1.0.4', true);
        }
}
add_action( 'wp_enqueue_scripts', 'ecommerce_gem_scripts' );

/**
* Enqueue scripts and styles for admin >> widget page only.
*/
function ecommerce_gem_admin_scripts( $hook ) {

	if( 'widgets.php' === $hook ){

		wp_enqueue_style( 'woocommerce-multisite-admin', get_template_directory_uri() . '/includes/widgets/css/admin.css', array(), '2.1.3' );

		wp_enqueue_media();

		wp_enqueue_script( 'woocommerce-multisite-admin', get_template_directory_uri() . '/includes/widgets/js/admin.js', array( 'jquery' ), '2.1.3' );

	}

	if( is_admin() ) { 
	    wp_enqueue_style( 'wp-color-picker' ); 
	    wp_enqueue_script( 'wp-color-picker' );
	}

}

add_action( 'admin_enqueue_scripts', 'ecommerce_gem_admin_scripts' );

// Load main file.
require_once trailingslashit( get_template_directory() ) . '/includes/main.php';

/* Turn on wide images */
add_theme_support( 'align-wide' );