<?php
/**
 * PV PP Announcement Webcast functions and definitions
 *
 * @package PV PP Announcement Webcast
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'pvppannouce_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pvppannouce_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on PV PP Announcement Webcast, use a find and replace
	 * to change 'pvppannouce' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'pvppannouce', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'logged-in' => __( 'Primary Menu (Logged In)', 'pvppannouce' ),
		'logged-out' => __( 'Primary Menu (Logged Out)', 'pvppannouce' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
}
endif; // pvppannouce_setup
add_action( 'after_setup_theme', 'pvppannouce_setup' );

/**
 * Enqueue scripts and styles.
 */
function pvppannouce_scripts() {
	if ( is_admin() ) {
		wp_enqueue_style( 'pvppannouce-style', get_stylesheet_uri() );		
	} else {
		wp_enqueue_style( 'pvppannouce-style', get_stylesheet_directory_uri() . '/css/style.css', array('pvppannouce-fonts') );
		wp_register_style( 'pvppannouce-fonts', '//fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700|Open+Sans:400italic,700italic,400,700&subset=latin,latin-ext' );
	}

	wp_register_script( 'history.js', get_template_directory_uri() . '/bower_components/history.js/scripts/bundled/html4+html5/jquery.history.js', array('jquery'), '1.8.0', true );
	wp_enqueue_script( 'pvppannouce-js', get_template_directory_uri() . '/js/min/pvppannounce.min.js', array('jquery', 'history.js') );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pvppannouce_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/custom-fields.php';


add_filter( 'gform_encrypt_password', '__return_true' );

/**
 * Only show the admin bar for people that can edit posts
 */
function launch_hide_admin_bar( $show_admin_bar ) {
    if ( !current_user_can( 'edit_posts' ) ) {
        return false;
    }
    return $show_admin_bar;
}
add_filter( 'show_admin_bar', 'launch_hide_admin_bar' );

/**
 * Redirect subscribers to the homepage if they try to access the dashboard
 */
function launch_hide_dashboard() {
    if ( is_admin() && !current_user_can( 'edit_posts' ) && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
        wp_safe_redirect( home_url( '/' ) );
    }
}
add_action( 'admin_init', 'launch_hide_dashboard' );

// add_action('init','custom_login');

// function custom_login(){
//  global $pagenow;
//  if( 'wp-login.php' == $pagenow && $_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['action']) ) {
//   wp_redirect(home_url('/#login'));
//   exit();
//  }
// }

add_filter( 'gform_encrypt_password', '__return_true' );

/**
 * Add Google Analytics code to the footer
 */
function planview_announce_google_analytics () {
    $trackingCode = "\n";
	$trackingCode .= "<script> \n";
	$trackingCode .= "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ \n";
	$trackingCode .= "(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), \n";
	$trackingCode .= "m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) \n";
	$trackingCode .= "})(window,document,'script','//www.google-analytics.com/analytics.js','ga'); \n";
	$trackingCode .= "ga('create', 'UA-16646450-11', 'auto'); \n";
	$trackingCode .= "ga('send', 'pageview'); \n";	
	$trackingCode .= "ga('create', 'UA-16646450-1', 'auto', {'name': 'newTracker', 'allowLinker': true}); \n";
	$trackingCode .= "ga('newTracker.require', 'linker'); \n";
	$trackingCode .= "ga('newTracker.linker:autoLink', ['www.planview.com', 'www.planview.de', 'www.planview.fr'] ); \n";
	$trackingCode .= "ga('newTracker.send', 'pageview'); \n";
	$trackingCode .= "</script> \n";

    return print $trackingCode;
}
add_action( 'wp_footer', 'planview_announce_google_analytics' );

function pvppannouce_munchkin_logged_in() {
	if (is_user_logged_in() && is_page()) : ?>
	<script>
	jQuery(document).ready(function ($) {
		if (typeof Munchkin !== 'undefined') {
			Munchkin.munchkinFunction('visitWebPage', {
			     url: '<?php the_permalink(); ?>', params: 'loggedin=true'
			});
		}
	});
	</script>
	<?php endif;
}
add_action( 'wp_footer', 'pvppannouce_munchkin_logged_in', 200 );
