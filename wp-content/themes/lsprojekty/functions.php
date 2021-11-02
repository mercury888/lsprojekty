<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/**
 * Twenty Nineteen only works in WordPress 4.7 or later.
 */
include ('svg-icons.php');

if ( version_compare( $GLOBALS['wp_version'], '5.2.4', '<' ) ) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}



/**
 * Fire on the initialization of WordPress.
 */
function wp_mobile_detection_function() {
	/** to detect mobile*/
	function my_wp_is_mobile() {
			if( wp_is_mobile() ){
			static $is_mobile;
			if ( isset($is_mobile) )
				return $is_mobile;
			if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
				$is_mobile = false;
			} elseif (
				strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false ) {
					$is_mobile = true;
			} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
					$is_mobile = true;
			} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
				$is_mobile = false;
			} else {
				if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
				$is_mobile = 'ie11';
			} else {
				$is_mobile = false;
			}
			}
			return $is_mobile;
		}
	}
}
add_action( 'init', 'wp_mobile_detection_function' );

function wp_IE_detection_function(){
	function my_wp_is_IE() {
		if( wp_is_mobile() ){
		} else {
			static $is_IE;
			if ( isset($is_IE) )
				return $is_IE;
			if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
				$is_IE = false;
			} elseif (
				strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false ) {
					$is_IE = false;
			} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
					$is_IE = false;
			} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
				$is_IE = false;
			} else {
				if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
				$is_IE = 'ie11';
			} else {
				$is_IE = false;
			}
			}
			return $is_IE;
		}
	}
}
add_action( 'init', 'wp_IE_detection_function' );


/** placeholder image function */
function placeholder_image($attr = ''){
	ob_start();
	echo '<img class="' . ( my_wp_is_IE() == 'ie11' ? ' skip-lazy ' : '' ) . '" src="' . get_template_directory_uri() .'/images/placeholder-image.jpg" alt="' . wp_strip_all_tags( $attr ) . '" />';
	return ob_get_clean();
}


/** wp image function */
function wp_image($imgID = '', $size = 'large', $classes = '' ){
	ob_start();
	$webPUrl = wp_get_attachment_image_url( $imgID, $size ) . '.webp';
	$uploadedfile=parse_url($webPUrl);
	$fileUrl =  $_SERVER['DOCUMENT_ROOT'] . $uploadedfile['path'];
    $path_info = pathinfo( wp_get_attachment_image_url( $imgID, $size ) );
    $imageExt = $path_info['extension'];
	echo '<picture class="cell-12 h-100 ">' .
        (
            file_exists($fileUrl)
            ? (
                $size == 'full'
                ? '<source type="image/webp" media="(min-width:320px)" srcset="'. wp_get_attachment_image_url( $imgID, $size ) . '.webp">'
                : ''
            ) .
            (
                $size == 'large'
                ? '<source type="image/webp" media="(min-width:320px)" srcset="'. wp_get_attachment_image_url( $imgID, 'large' ) . '.webp">'
                : ''
            ) .
            (
                $size == 'medium_large'
                ? '<source type="image/webp" media="(min-width:640px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium_large' ) . '.webp">' .
                '<source type="image/webp" media="(min-width:320px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium' ) . '.webp">'
                : ''
            ) .
            '<source type="image/webp" media="(min-width:320px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium' ) . '.webp">'
            : ''
        ) .
        (
            $size == 'full'
            ? '<source type="image/' . $imageExt . '" media="(min-width:320x)" srcset="'. wp_get_attachment_image_url( $imgID, $size ) . '">'
            : ''
        ) .
        (
            $size == 'large'
            ? '<source type="image/' . $imageExt . '" media="(min-width:320px)" srcset="'. wp_get_attachment_image_url( $imgID, 'large' ) . '">'
            : ''
        ) .
        (
            $size == 'medium_large'
            ? '<source type="image/' . $imageExt . '" media="(min-width:640px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium_large' ) . '">' .
            '<source type="image/' . $imageExt . '" media="(min-width:320px)" srcset="'. wp_get_attachment_image_url( $imgID, 'medium' ) . '">'
            : ''
        ) .
        '<source type="image/' . $imageExt . '" media="(min-width:650px)" srcset="'. wp_get_attachment_image_url( $imgID, $size ) . '">' .
        wp_get_attachment_image( $imgID, $size, '', array( "class" => "attachment-$size size-$size $classes" ) ) .
    '</picture>';

	return ob_get_clean();
}

/** wp icon function **/
function wp_icon( $wp_icon, $classes="" ){
	ob_start();
        $context = stream_context_create(
            array(
                "http" => array(
                    "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
                )
            )
        );
        $wp_iconSVG = file_get_contents( $wp_icon , false, $context);
        echo $wp_iconSVG;
	return ob_get_clean();
}


function new_excerpt_more($more) {
    return ' <p><a class="read-more" href="' . get_permalink(get_the_ID()) . '"><span>' . __('Read Full Post', 'your-text-domain') . '</span></a></p>';
}
add_filter('excerpt_more', 'new_excerpt_more');


if ( ! function_exists( 'twentynineteen_setup' ) ) :

function twentynineteen_setup() {

    load_theme_textdomain( 'twentynineteen', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1568, 9999 );

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(
        array(
            'main-navigation' => __( 'Primary', 'twentynineteen' ),
        )
    );


    /* Header logo*/
		function header_logo($wp_customize) {
		    // add a setting
		    $wp_customize->add_setting('header_logo');
		    // Add a control to upload the hover logo
		    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_logo', array(
		        'label' => 'Header Home Logo',
		        'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
		        'settings' => 'header_logo',
		        'priority' => 9 // show it just below the custom-logo
		    )));
		}
		add_action('customize_register', 'header_logo');

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        )
    );

    /**
		 * Add support for core custom logo.
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
        add_theme_support(
            'custom-logo',
            array(
                'flex-width'  => false,
                'flex-height' => false,
            )
        );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for Block Styles.
    add_theme_support( 'wp-block-styles' );

    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );

    // Add support for editor styles.
    add_theme_support( 'editor-styles' );

    // Enqueue editor styles.
    add_editor_style( 'style-editor.css' );

}
endif;
add_action( 'after_setup_theme', 'twentynineteen_setup' );

if (function_exists('add_image_size')) {
    add_image_size('staff-thumb', 400, 450, true);
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentynineteen_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Footer Menu', 'twentynineteen' ),
			'id'            => 'footer-menu',
			'description'   => __( 'Appears in the footer of the site.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);

}
add_action( 'widgets_init', 'twentynineteen_widgets_init' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function twentynineteen_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'twentynineteen_content_width', 640 );
}
add_action( 'after_setup_theme', 'twentynineteen_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function site_styles() {
    //wp_enqueue_style( 'twentynineteen-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

    if( is_front_page() ){
        wp_enqueue_style( 'ibistherapeutics-style', get_template_directory_uri() . '/assets/css/style.css' , array(), wp_get_theme()->get( 'Version' ) );
    } else {
        wp_enqueue_style( 'ibistherapeutics-style', get_template_directory_uri() . '/assets/css/inner-styles.css' , array(), wp_get_theme()->get( 'Version' ) );
    }
    wp_style_add_data( 'twentynineteen-style', 'rtl', 'replace' );

    if ( has_nav_menu( 'menu-1' ) ) {
        wp_enqueue_script( 'twentynineteen-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '1.0', true );
        wp_enqueue_script( 'twentynineteen-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '1.0', true );
    }

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

	wp_enqueue_style( 'all-default', get_theme_file_uri() . '/assets/css/all-default.css' );
  // wp_enqueue_style( 'multiselect-style', get_theme_file_uri() . '/assets/css/multiselect.css' );
  wp_enqueue_style( 'select2-style', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css' );
  wp_enqueue_style( 'font-awesome-style', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css' );

}
add_action( 'wp_enqueue_scripts', 'site_styles' );
//add_action( 'get_footer', 'site_styles' );

function site_script() {
    wp_enqueue_script('jquery');
    wp_script_add_data( 'jquery', 'rtl', 'replace' );
    wp_enqueue_script( 'slick-script', get_theme_file_uri() . '/js/slick.min.js', array(), wp_get_theme()->get( 'Version' ) , true );
    wp_enqueue_script( 'fancybox-script', get_theme_file_uri() . '/js/jquery.fancybox.min.js', array(), wp_get_theme()->get( 'Version' ) , true );
    wp_enqueue_script( 'general-script', get_theme_file_uri() . '/js/general.js', array(), wp_get_theme()->get( 'Version' ) , true );
    wp_register_script( 'home-banner-script', get_theme_file_uri() . '/js/home-banner-functions.js', array(), wp_get_theme()->get( 'Version' ) , true );
    // wp_enqueue_script( 'multiselect-script', get_theme_file_uri() . '/js/jquery.multiselect.js', array(), wp_get_theme()->get( 'Version' ) , true );
    wp_enqueue_script( 'select2-script', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array(), '4.1.0' , true );
}
add_action( 'wp_enqueue_scripts', 'site_script' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentynineteen_skip_link_focus_fix() {
    // The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
?>
<script>
    /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
</script>
<?php
}
add_action( 'wp_print_footer_scripts', 'twentynineteen_skip_link_focus_fix' );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-twentynineteen-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-twentynineteen-walker-comment.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/** ACF Options page Single choice */
/*if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}*/


/* ACF Options page Multiple choices */
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' 	=> 'Theme General Options',
        'menu_title'	=> 'Theme options',
        'menu_slug' 	=> 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Header Options',
        'menu_title'	=> 'Header',
        'parent_slug'	=> 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Footer Options',
        'menu_title'	=> 'Footer',
        'parent_slug'	=> 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme Social Options',
        'menu_title'	=> 'Social',
        'parent_slug'	=> 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme 404 Options',
        'menu_title'	=> '404',
        'parent_slug'	=> 'theme-general-options',
    ));
    acf_add_options_sub_page(array(
        'page_title' 	=> 'Theme General up',
        'menu_title'	=> 'General',
        'parent_slug'	=> 'theme-general-options',
    ));
	acf_add_options_sub_page(array(
        'page_title' 	=> 'Home Slider',
        'menu_title'	=> 'Home Slider',
        'parent_slug'	=> 'theme-general-options',
    ));
}

/* section wise css */
add_action( 'init', 'action__init' );


function action__init() {

    /* scripts */
    wp_register_script( 'isotop-lib', get_stylesheet_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), 'init' );
    wp_register_script( 'isotop-function', get_stylesheet_directory_uri() . '/js/isotop-function.js', array( 'isotop-lib' ), 'init' );

    wp_register_script( 'patient-intake-function', get_stylesheet_directory_uri() . '/js/patient-intake-function.js', array( 'jquery' ), 'init' );
}


/** svg file upload permission */
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Enqueue SVG javascript and stylesheet in admin
 * @author fadupla
 */

function fadupla_svg_enqueue_scripts( $hook ) {
    wp_enqueue_style( 'fadupla-svg-style', get_theme_file_uri( 'assets/css/svg.css' ) );
    wp_enqueue_script( 'fadupla-svg-script', get_theme_file_uri( '/js/svg.js' ), 'jquery' );
    wp_localize_script( 'fadupla-svg-script', 'script_vars',
                       array( 'AJAXurl' => admin_url( 'admin-ajax.php' ) ) );
}

add_action( 'admin_enqueue_scripts', 'fadupla_svg_enqueue_scripts' );


/**
 * Ajax get_attachment_url_media_library
 * @author fadupla
 */

/** Admin Logo */
function my_login_logo() { ?>
<style type="text/css">
    #login h1 a, .login h1 a {
        background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/admin-logo.png);
        height:100px;
        width:100%;
        background-size: contain;
        background-repeat: no-repeat;
    }
</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
add_filter( 'login_headerurl', 'custom_loginlogo_url' );
function custom_loginlogo_url($url) {
    return site_url();
}


/** Social Media Function Start */
function social_media_options(){
    ob_start();
    global $facebook;
    global $insta;
    global $twitter;
    global $youtube;
    global $linkedin;
    global $yelp;
    if( have_rows('social_media', 'options') ){
        echo '<div class="socialmedialinks"><ul class="justify-content-start">';
            while ( have_rows('social_media', 'options')) : the_row();
            $icon = get_sub_field('social_media_name', 'options');
            echo '<li class="p-0">' .
                    '<a href="' . get_sub_field('social_media_link', 'options') . '" target="_blank" class="' . get_sub_field('social_media_name', 'options') . '">';
                        if($icon == "facebook"){
                            echo $facebook;
                        } else if($icon == "insta") {
                            echo $insta;
                        } else if($icon == "twitter") {
                            echo $twitter;
                        } else if($icon == "youtube") {
                            echo $youtube;
                        } else if($icon == "linkedin") {
                            echo $linkedin;
                        } else if($icon == "yelp") {
                            echo $yelp;
                        }
                    echo '</a>' .
                '</li>';
            endwhile;
        echo '</ul></div>';
    }
    return ob_get_clean();
}
/** Social Media Function End */

/** stop autoupdate wp-scss plugin  */
function my_filter_plugin_updates( $value ) {
   if( isset( $value->response['WP-SCSS-1.2.4/wp-scss.php'] ) ) {
      unset( $value->response['WP-SCSS-1.2.4/wp-scss.php'] );
    }
    return $value;
 }
 add_filter( 'site_transient_update_plugins', 'my_filter_plugin_updates' );

/** main navigation */
function main_navigation() {
    ob_start();
    wp_nav_menu(
        array(
            'theme_location' => 'main-navigation',
            'menu_class' => 'nav_menu',
        )
    );
    return ob_get_clean();
}


/* site url for terms of use and privacy policy page */
function siteUrlFunction(){
	$siteUrlHtml = '<a class="link" href="' . site_url() . '">' . get_bloginfo( 'name' ) . '</a>';
	return $siteUrlHtml;
}
add_shortcode('site-url', 'siteUrlFunction');

/* site name for terms of use and privacy policy page */
function siteNameFunction(){
	$siteNameHTML = get_bloginfo( 'name' );
	return $siteNameHTML;
}
add_shortcode('site-name', 'siteNameFunction');



 /** Location Custom Title */
 function locationCustomTitle(){
		 ob_start();
				 $customTitle = get_field('location_title','options');
				 if( $customTitle ){
						 echo '<h5><a href="' . get_field('location_map_link','options') . '" target="_blank">' . $customTitle . '</a></h5>';
				 }
		 return ob_get_clean();
 }
 add_shortcode('location-custom-title', 'locationCustomTitle');

/** Location address */
function locationAddress(){
	 ob_start();
			 $locationAddress = get_field('location_address','options');
			 $locationMapLink = get_field('location_map_link','options');
			 if( $locationAddress ){
					 echo '<p class="d-block" data-match-height="loc-address" ><a href="'. $locationMapLink .'" target="_blank">' . $locationAddress . '</a></p>';
			 }
	 return ob_get_clean();
}
add_shortcode('location-address', 'locationAddress');

/** Location Phone Number */
function locationPhoneNumber(){
	 ob_start();
			 $locationPhoneNumber = get_field('location_phone','options');
			 if( $locationPhoneNumber ){
					 echo '<p class="call mb-0 d-block"><a href="tel:' . preg_replace('/[^0-9]/', '', $locationPhoneNumber ) . '">' . $locationPhoneNumber . '</a></p>';
			 }
	 return ob_get_clean();
}
add_shortcode('location-phone', 'locationPhoneNumber');


function locationHours() {
	 ob_start();
	 $locationWorkingHours = get_field('location_hours','options');
	 if( $locationWorkingHours ){
			 echo '<p class="mb-0 d-block">' . $locationWorkingHours . '</p>';
	 }
	 return ob_get_clean();
}
add_shortcode('location-hours', 'locationHours');


function locationEmail() {
	 ob_start();
	 $locationEmail = get_field('location_email','options');
	 if( $locationEmail ){
			 echo '<p class="mb-0 d-block"><a href="mailto:'.  $locationEmail.'">' . $locationEmail . '</a></p>';
	 }
	 return ob_get_clean();
}
add_shortcode('location-email', 'locationEmail');

function locationFax() {
	 ob_start();
	 $locationFax = get_field('location_fax','options');
	 if( $locationFax ){
			 echo '<p class="mb-0 d-block"><span>F: </span><a href="fax:' . preg_replace('/[^0-9]/', '', $locationFax ) . '">' . $locationFax . '</a></p>';
	 }
	 return ob_get_clean();
}
add_shortcode('location-fax', 'locationFax');

/** location map function will display map or custom map in footer, contact page, location single page */
function locationMap(){
    ob_start();

    echo '<div class="location-map cell-12">' .
        get_field( 'address_map_iframe' ,'options') .
    '</div>' ;

    return ob_get_clean();
}
add_shortcode('location-map', 'locationMap');


/** footer navigation */
function footer_navigation() {
    ob_start();

    if ( is_active_sidebar( 'footer-menu' ) ) {
        dynamic_sidebar( 'footer-menu' );
    }

    return ob_get_clean();
}
add_shortcode('footer-navigation', 'footer_navigation');


// // request button
// function request_button() {
// 	ob_start();
//
// 	$link = get_field('header_button','options');
// 	if( $link ) {
// 	    $link_url = $link['url'];
// 	    $link_title = $link['title'];
// 	    $link_target = $link['target'] ? $link['target'] : '_self';
//
// 	    echo '<a class="read-more hvr-push" href="'. esc_url( $link_url ) .'" target="'. esc_attr( $link_target ) .'"><span>'. esc_html( $link_title ) .'</span></a>';
// 		}
// 	return ob_get_clean();
// }

function call_header() {
  ob_start();

  $call_link = get_field('call_link', 'options');

  echo '<div class="call-header">'.
      (
        get_field('header_call', 'options')
        ? '<a href="'. $call_link .'">'. get_field('header_call', 'options') . '</a>'
        : ''
      ) .
  '</div>';

  return ob_get_clean();
}


// WordPress Breadcrumb Function
// Add this code into your theme function file.

function ah_breadcrumb() {
  ob_start();
  // Check if is front/home page, return
  if ( is_front_page() ) {
    return;
  }

  // Define
  global $post;
  $custom_taxonomy  = ''; // If you have custom taxonomy place it here

  $defaults = array(
    'seperator'   =>  '<span class="breadcrumb-space"><span>/</span></span>',
    'id'          =>  'ah-breadcrumb',
    'classes'     =>  'ah-breadcrumb',
    'home_title'  =>  esc_html__( 'Domov', '' )
  );

  $sep  = '<li class="seperator"><span class="breadcrumb-space"><span><img src="'. get_template_directory_uri() .'/images/arrow.webp" /></span></span></li>';

  // Start the breadcrumb with a link to your homepage
  echo '<ul id="'. esc_attr( $defaults['id'] ) .'" class="'. esc_attr( $defaults['classes'] ) .'">';

  // Creating home link
  echo '<li class="item"><a href="'. get_home_url() .'">'. esc_html( $defaults['home_title'] ) .'</a></li>' . $sep;

  if ( is_single() ) {

    // Get posts type
    $post_type = get_post_type();


    // If post type is not post
    // if( $post_type != 'post' ) {

      $post_type_object   = get_post_type_object( $post_type );
      $post_type_link     = get_post_type_archive_link( $post_type );

      echo '<li class="item item-cat"><a href="'. $post_type_link .'">'. ( $post_type == 'service' ? 'Služby' : $post_type ) . '</a></li>'. $sep;

    // If it's a custom post type within a custom taxonomy
    $taxonomy_exists = taxonomy_exists( $custom_taxonomy );

    if( empty( $get_last_category ) && !empty( $custom_taxonomy ) && $taxonomy_exists ) {

      $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
      $cat_id         = $taxonomy_terms[0]->term_id;
      $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
      $cat_name       = $taxonomy_terms[0]->name;

    }

    // Check if the post is in a category
    if( !empty( $get_last_category ) ) {

      echo $display_category;
      echo '<li class="item item-current">'. get_the_title() .'</li>';

    } else if( !empty( $cat_id ) ) {

      echo '<li class="item item-cat"><a href="'. $cat_link .'">'. $cat_name .'</a></li>' . $sep;
      echo '<li class="item-current item">'. get_the_title() .'</li>';

    } else {

      echo '<li class="item-current item">'. get_the_title() .'</li>';

    }

  }
  else if( is_archive() ) {

    if( is_tax() ) {
      // Get posts type
      $post_type = get_post_type();

      // If post type is not post
      if( $post_type != 'post' ) {

        $post_type_object   = get_post_type_object( $post_type );
        $post_type_link     = get_post_type_archive_link( $post_type );

        echo '<li class="item item-cat item-custom-post-type-' . $post_type . '"><a href="' . $post_type_link . '">' . $post_type_object->labels->name . '</a></li>' . $sep;

      }

      $custom_tax_name = get_queried_object()->name;
      echo '<li class="item item-current">'. $custom_tax_name .'</li>';

    } else if ( is_category() ) {

      $parent = get_queried_object()->category_parent;

      if ( $parent !== 0 ) {

        $parent_category = get_category( $parent );
        $category_link   = get_category_link( $parent );

        echo '<li class="item"><a href="'. esc_url( $category_link ) .'">'. $parent_category->name .'</a></li>' . $sep;

      }

      echo '<li class="item item-current">'. single_cat_title( '', false ) .'</li>';

    } else if ( is_tag() ) {

      // Get tag information
      $term_id        = get_query_var('tag_id');
      $taxonomy       = 'post_tag';
      $args           = 'include=' . $term_id;
      $terms          = get_terms( $taxonomy, $args );
      $get_term_name  = $terms[0]->name;

      // Display the tag name
      echo '<li class="item-current item">'. $get_term_name .'</li>';

    } else if( is_day() ) {

      // Day archive

      // Year link
      echo '<li class="item-year item"><a href="'. get_year_link( get_the_time('Y') ) .'">'. get_the_time('Y') . ' Archives</a></li>' . $sep;

      // Month link
      echo '<li class="item-month item"><a href="'. get_month_link( get_the_time('Y'), get_the_time('m') ) .'">'. get_the_time('M') .' Archives</a></li>' . $sep;

      // Day display
      echo '<li class="item-current item">'. get_the_time('jS') .' '. get_the_time('M'). ' Archives</li>';

    } else if( is_month() ) {

      // Month archive

      // Year link
      echo '<li class="item-year item"><a href="'. get_year_link( get_the_time('Y') ) .'">'. get_the_time('Y') . ' Archives</a></li>' . $sep;

      // Month Display
      echo '<li class="item-month item-current item">'. get_the_time('M') .' Archives</li>';

    } else if ( is_year() ) {

      // Year Display
      echo '<li class="item-year item-current item">'. get_the_time('Y') .' Archives</li>';

    } else if ( is_author() ) {

      // Auhor archive

      // Get the author information
      global $author;
      $userdata = get_userdata( $author );

      // Display author name
      echo '<li class="item-current item">'. 'Author: '. $userdata->display_name . '</li>';

    } else {

      echo '<li class="item item-current">'. post_type_archive_title() .'</li>';

    }

  }
   else if ( is_page() ) {

    // Standard page
    if( $post->post_parent ) {

      // If child page, get parents
      $anc = get_post_ancestors( $post->ID );

      // Get parents in the right order
      $anc = array_reverse( $anc );

      // Parent page loop
      if ( !isset( $parents ) ) $parents = null;
      foreach ( $anc as $ancestor ) {

        $parents .= '<li class="item-parent item"><a href="'. get_permalink( $ancestor ) .'">'. get_the_title( $ancestor ) .'</a></li>' . $sep;

      }

      // Display parent pages
      echo $parents;

      // Current page
      echo '<li class="item-current item">'. get_the_title() .'</li>';

    } else {

      // Just display current page if not parents
      echo '<li class="item-current item">'. get_the_title() .'</li>';

    }

  }
   else if(is_home()) {
     echo '<li class="item-current item">Blog</li>';
   }
  else if ( is_search() ) {

    // Search results page
    echo '<li class="item-current item">Search results for: '. get_search_query() .'</li>';

  } else if ( is_404() ) {

    // 404 page
    echo '<li class="item-current item">' . 'Error 404' . '</li>';

  }

  // End breadcrumb
  echo '</ul>';

  return ob_get_clean();
}



function register_custom_post_type_catalog() {
    $args = array(
        "label" => __( "Catalogs", "" ),
        "labels" => array(
            "name" => __( "Catalogs", "" ),
            "singular_name" => __( "Catalog", "" ),
            "featured_image" => __( "Property Image", "" ),
            "set_featured_image" => __( "Set Catalog Image", "" ),
            "remove_featured_image" => __( "Remove Catalog", "" ),
            "use_featured_image" => __( "Use Catalog", "" ),
        ),
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => false,
        "has_archive" => false,
        "show_in_menu" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "catalogs", "with_front" => true ),
        "query_var" => true,
        "supports" => array( "title", "editor", "thumbnail" ),
    );
    register_post_type( "catalogs", $args );


    /**
   * Post Type: Testimonials.
   */

    $labels = array(
        "name" => __( "Testimonials" ),
        "singular_name" => __( "Testimonia" ),
    );

    $args = array(
        "label" => __( "Testimonials" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "delete_with_user" => false,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "testimonial", "with_front" => true ),
        "query_var" => true,
        "supports" => array( "title", "editor", "thumbnail", "excerpt" ),
    );

    register_post_type( "testimonial", $args );


    /**
   * Post Type: Services.
   */

    $labels = array(
        "name" => __( "Services" ),
        "singular_name" => __( "Service" ),
    );

    $args = array(
        "label" => __( "Services" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "delete_with_user" => false,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "sluzby", "with_front" => true ),
        "query_var" => true,
        "supports" => array( "title", "editor", "thumbnail" ),
    );

    register_post_type( "service", $args );


    /**
   * Post Type: Referencie.
   */

    $labels = array(
        "name" => __( "Referencie" ),
        "singular_name" => __( "Referencie" ),
    );

    $args = array(
        "label" => __( "Referencie" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "delete_with_user" => false,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => array( "slug" => "referencie", "with_front" => true ),
        "query_var" => true,
        "supports" => array( "title", "editor", "thumbnail" ),
    );

    register_post_type( "referencie", $args );
}
add_action( 'init', 'register_custom_post_type_catalog' );


function register_custom_taxonomy() {

    $labels = array(
        'name'              => _x( 'Catalogs Category', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Catalog Category', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Catalogs Category', 'textdomain' ),
        'all_items'         => __( 'All Catalogs Category', 'textdomain' ),
        'view_item'         => __( 'View Catalog Category', 'textdomain' ),
        'parent_item'       => __( 'Parent Catalog Category', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Catalog:', 'textdomain' ),
        'edit_item'         => __( 'Edit Catalog Category', 'textdomain' ),
        'update_item'       => __( 'Update Catalog Category', 'textdomain' ),
        'add_new_item'      => __( 'Add New Catalog Category', 'textdomain' ),
        'new_item_name'     => __( 'New Catalog Name Category', 'textdomain' ),
        'not_found'         => __( 'No Catalogs Found', 'textdomain' ),
        'back_to_items'     => __( 'Back to Catalogs', 'textdomain' ),
        'menu_name'         => __( 'Catalogs Category', 'textdomain' ),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'catalog' ),
        'show_in_rest'      => true,
    );


    register_taxonomy( 'catalogs-cat', 'catalogs', $args );

}
add_action( 'init', 'register_custom_taxonomy' );


function my_ajax_filter_search_shortcode() {
    ob_start(); ?>
    <div class="mobile-filter-btn">
      <a href="javascript:;" class="for-mobile-filter read-more">
          <span><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.25 2C1.25 1.80109 1.32902 1.61032 1.46967 1.46967C1.61032 1.32902 1.80109 1.25 2 1.25H14C14.1989 1.25 14.3897 1.32902 14.5303 1.46967C14.671 1.61032 14.75 1.80109 14.75 2V3.9395C14.75 4.1384 14.6709 4.32913 14.5303 4.46975L9.71975 9.28025C9.57909 9.42087 9.50004 9.6116 9.5 9.8105V11.75L6.5 14.75V9.8105C6.49996 9.6116 6.42091 9.42087 6.28025 9.28025L1.46975 4.46975C1.32909 4.32913 1.25004 4.1384 1.25 3.9395V2Z" stroke="#081228" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>Filter projektov
      </a>
    </div>
    <?php if(my_wp_is_mobile()) { ?>

    <div id="my-ajax-filter-search" class="my-ajax-filter-search-cus">
      <a href="javascript:;" class="close-mobilefilter">
        <svg enable-background="new 0 0 100 100" id="Layer_1" version="1.1" viewBox="0 0 100 100" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><polygon fill="#010101" points="77.6,21.1 49.6,49.2 21.5,21.1 19.6,23 47.6,51.1 19.6,79.2 21.5,81.1 49.6,53 77.6,81.1 79.6,79.2   51.5,51.1 79.6,23 "/></svg>
      </a>
      <div class="mob-logo">
        <img src="<?php echo get_template_directory_uri() . '/images/filter-logo.svg'; ?>" />
      </div>
  		<form action="" method="post" >
          <button type="reset" id="rpf-btn">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6.83207 3.81005C7.48457 3.61505 8.20457 3.48755 8.99957 3.48755C12.5921 3.48755 15.5021 6.39755 15.5021 9.99005C15.5021 13.5825 12.5921 16.4925 8.99957 16.4925C5.40707 16.4925 2.49707 13.5825 2.49707 9.99005C2.49707 8.65505 2.90207 7.41005 3.59207 6.37505" stroke="#081228" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M5.90234 3.99L8.06984 1.5" stroke="#081228" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M5.90234 3.98999L8.42984 5.83499" stroke="#081228" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          vynulovať filter</button>
        <div class="dropdown">
          <button class="dropbtn">
            <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M13.2293 5.3958C12.936 5.14628 12.5829 4.99436 12.2109 4.9252C12.018 3.42087 10.7434 2.25 9.18751 2.25H4.81249C3.25645 2.25 1.98176 3.42112 1.78907 4.92567C1.41741 4.99483 1.06405 5.1465 0.770737 5.3958C0.281135 5.81236 0 6.41991 0 7.06249C0 7.61706 0.210641 8.14597 0.593013 8.55145C0.775023 8.74458 0.874986 9.03851 0.874986 9.37945V11.4375C0.874986 11.6793 1.07066 11.875 1.31248 11.875H2.62499V12.75H3.49998V11.875H10.5V12.75H11.375V11.875H12.6875C12.9293 11.875 13.125 11.6793 13.125 11.4375V9.37945C13.125 9.03851 13.2249 8.74458 13.407 8.55145C13.7893 8.146 14 7.61706 14 7.06249C14 6.41991 13.7189 5.81236 13.2293 5.3958ZM4.81252 3.12499H9.18751C10.264 3.12499 11.1563 3.9083 11.3367 4.93393C10.3549 5.15321 9.62501 6.08294 9.62501 7.15605V8.375H4.37499V7.15605C4.37499 6.08313 3.64525 5.15355 2.66328 4.93406C2.84371 3.90846 3.73596 3.12499 4.81252 3.12499ZM12.7704 7.9516C12.435 8.30749 12.25 8.81463 12.25 9.37945V11H1.75V9.37945C1.75 8.81463 1.56501 8.30749 1.22963 7.9516C1.00104 7.70891 0.875018 7.39319 0.875018 7.06252C0.875018 6.67713 1.04377 6.31228 1.33773 6.06232C1.63638 5.80855 2.01918 5.706 2.41096 5.76836C3.03174 5.86919 3.50001 6.46606 3.50001 7.15605V8.375V9.24998H10.5V8.375V7.15605C10.5 6.46606 10.9683 5.86919 11.5886 5.76836C11.9834 5.70343 12.3632 5.80768 12.6623 6.06232C12.9563 6.31225 13.125 6.67713 13.125 7.06252C13.125 7.39319 12.999 7.70891 12.7704 7.9516Z" fill="#081228"/>
              <path d="M12.5242 6.96894C12.6951 7.1398 12.6951 7.41681 12.5242 7.58767C12.3534 7.75853 12.0764 7.75853 11.9055 7.58767C11.7346 7.41681 11.7346 7.1398 11.9055 6.96894C12.0764 6.79811 12.3534 6.79811 12.5242 6.96894Z" fill="#081228"/>
              <path d="M2.55754 6.96894C2.7284 7.1398 2.7284 7.41681 2.55754 7.58767C2.38668 7.75853 2.10968 7.75853 1.93881 7.58767C1.76795 7.41681 1.76795 7.1398 1.93881 6.96894C2.10968 6.79811 2.38668 6.79811 2.55754 6.96894Z" fill="#081228"/>
            </svg>
            <p>Počet izieb</p>
            <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M7.00005 2.6001C7.18568 2.60014 7.3637 2.67391 7.49495 2.8052L9.59495 4.9052C9.72246 5.03722 9.79301 5.21404 9.79142 5.39758C9.78982 5.58112 9.7162 5.75668 9.58642 5.88647C9.45663 6.01626 9.28106 6.08987 9.09753 6.09147C8.91399 6.09306 8.73717 6.02251 8.60515 5.895L7.00005 4.2899L5.39495 5.895C5.26292 6.02251 5.0861 6.09306 4.90256 6.09147C4.71903 6.08987 4.54346 6.01626 4.41367 5.88647C4.28389 5.75668 4.21027 5.58112 4.20867 5.39758C4.20708 5.21404 4.27764 5.03722 4.40515 4.9052L6.50515 2.8052C6.63639 2.67391 6.81441 2.60014 7.00005 2.6001ZM4.40515 9.1052C4.53642 8.97397 4.71443 8.90025 4.90005 8.90025C5.08566 8.90025 5.26368 8.97397 5.39495 9.1052L7.00005 10.7103L8.60515 9.1052C8.73717 8.97769 8.91399 8.90713 9.09753 8.90873C9.28106 8.91032 9.45663 8.98394 9.58642 9.11372C9.7162 9.24351 9.78982 9.41908 9.79142 9.60262C9.79301 9.78615 9.72246 9.96298 9.59495 10.095L7.49495 12.195C7.36368 12.3262 7.18566 12.3999 7.00005 12.3999C6.81443 12.3999 6.63642 12.3262 6.50515 12.195L4.40515 10.095C4.27392 9.96373 4.2002 9.78571 4.2002 9.6001C4.2002 9.41448 4.27392 9.23647 4.40515 9.1052Z" fill="#081228"/>
            </svg>
          </button>
          <div class="pt-0">
				<select name="rooms[]" id="rooms" class="dropdown-content" multiple>
					<option value=""></option>
                    <option value="2"> 2 izby</option>
					<option value="3"> 3 izby</option>
					<option value="4"> 4 izby</option>
					<option value="5"> 5 a viac izieb</option>
				</select>
                <!-- Mobile Property Filter Checkbok List -->
                <div class="mpfcl" data-relate="#rooms" >
                  <ul>
                    <li><input type="checkbox" value="2" id="room-2" > <label for="room-2" > 2 izby  </label> </li>
                    <li><input type="checkbox" value="3" id="room-3" > <label for="room-3" > 3 izby  </label> </li>
                    <li><input type="checkbox" value="4" id="room-4" > <label for="room-4" > 4 izby  </label> </li>
                    <li><input type="checkbox" value="5" id="room-5" > <label for="room-5" > 5 a viac izieb </label> </li>
                  </ul>
                </div>
          </div>
        </div>

        <div class="dropdown nth2 white">
         <button class="dropbtn">
           <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path fill-rule="evenodd" clip-rule="evenodd" d="M3.49267 2.77083H10.5073L7 6.27817L3.49267 2.77083ZM2.77083 3.49268V10.5073L6.27816 7.00001L2.77083 3.49268ZM7 7.72185L3.48906 11.2328H10.5109L7 7.72185ZM11.2328 10.511V3.48906L7.72184 7.00001L11.2328 10.511ZM1.75 1.75V12.2536H12.2536V1.75H1.75Z" fill="#9CA3AF"/>
           </svg>
           <p>Úžitková plocha</p>
           <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path fill-rule="evenodd" clip-rule="evenodd" d="M7.00005 2.6001C7.18568 2.60014 7.3637 2.67391 7.49495 2.8052L9.59495 4.9052C9.72246 5.03722 9.79301 5.21404 9.79142 5.39758C9.78982 5.58112 9.7162 5.75668 9.58642 5.88647C9.45663 6.01626 9.28106 6.08987 9.09753 6.09147C8.91399 6.09306 8.73717 6.02251 8.60515 5.895L7.00005 4.2899L5.39495 5.895C5.26292 6.02251 5.0861 6.09306 4.90256 6.09147C4.71903 6.08987 4.54346 6.01626 4.41367 5.88647C4.28389 5.75668 4.21027 5.58112 4.20867 5.39758C4.20708 5.21404 4.27764 5.03722 4.40515 4.9052L6.50515 2.8052C6.63639 2.67391 6.81441 2.60014 7.00005 2.6001ZM4.40515 9.1052C4.53642 8.97397 4.71443 8.90025 4.90005 8.90025C5.08566 8.90025 5.26368 8.97397 5.39495 9.1052L7.00005 10.7103L8.60515 9.1052C8.73717 8.97769 8.91399 8.90713 9.09753 8.90873C9.28106 8.91032 9.45663 8.98394 9.58642 9.11372C9.7162 9.24351 9.78982 9.41908 9.79142 9.60262C9.79301 9.78615 9.72246 9.96298 9.59495 10.095L7.49495 12.195C7.36368 12.3262 7.18566 12.3999 7.00005 12.3999C6.81443 12.3999 6.63642 12.3262 6.50515 12.195L4.40515 10.095C4.27392 9.96373 4.2002 9.78571 4.2002 9.6001C4.2002 9.41448 4.27392 9.23647 4.40515 9.1052Z" fill="#081228"/>
           </svg>
         </button>

         <div class="pt-0">
           <select name="area[]" id="area" class="dropdown-content" multiple>
              <!-- <option>Úžitková plocha</option> -->
		          <option value=""></option>
              <option value="100"> do 100 &#x33A1; </option>
       				<option value="100_200"> 100&#x33A1; - 200&#x33A1;</option>
       				<option value="200"> Od 200&#x33A1;</option>

           </select>
           <div class="mpfcl" data-relate="#area" >
              <ul>
                <li><div class="single-checkbox">
                  <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="1" y="14" width="13" height="13" stroke="#081228" stroke-width="2"/>
                    <rect x="1" y="1" width="26" height="26" stroke="#081228" stroke-width="2" stroke-dasharray="2 2"/>
                  </svg>
                  <input type="checkbox" value="100" id="area-100" ></div> <label for="area-100" > do 100 &#x33A1; </label> </li>
                <li><div class="single-checkbox">
                  <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="1" y="14" width="13" height="13" stroke="#081228" stroke-width="2"/>
                    <rect x="1" y="1" width="26" height="26" stroke="#081228" stroke-width="2" stroke-dasharray="2 2"/>
                  </svg><input type="checkbox" value="100_200" id="area-100_200" ></div> <label for="area-100_200" > 100&#x33A1; - 200&#x33A1; </label> </li>
                <li><div class="single-checkbox">
                  <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="1" y="14" width="13" height="13" stroke="#081228" stroke-width="2"/>
                    <rect x="1" y="1" width="26" height="26" stroke="#081228" stroke-width="2" stroke-dasharray="2 2"/>
                  </svg><input type="checkbox" value="200" id="area-200" ></div> <label for="area-200" > Od 200&#x33A1; </label> </li>
              </ul>
            </div>
         </div>
        </div>


        <div class="dropdown nth3 white">
         <button class="dropbtn">
           <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path d="M13.8717 1.87816C13.7897 1.79612 13.6786 1.75 13.5624 1.75H10.0624C9.82055 1.75 9.62488 1.94567 9.62488 2.18749V4.37498H6.56237C6.32099 4.37498 6.12488 4.57066 6.12488 4.81248V7.00084L3.93739 6.99997C3.82162 6.99997 3.7101 7.04611 3.62805 7.12813C3.54601 7.21017 3.49989 7.32126 3.49989 7.43746V9.62495H1.31324C1.19747 9.62495 1.08595 9.67023 1.00391 9.75228C0.921863 9.83432 0.875747 9.9454 0.875747 10.0616L0.874878 13.5624C0.874878 13.6782 0.921025 13.7897 1.00304 13.8718C1.08508 13.9538 1.19617 13.9999 1.31237 13.9999L13.5615 13.9991C13.8033 13.9991 13.999 13.8034 13.999 13.5616L13.9998 2.18749C13.9999 2.07132 13.9537 1.96024 13.8717 1.87816ZM13.1249 13.125H1.74989V10.4991L3.93739 10.5C4.05316 10.5 4.16467 10.4538 4.24672 10.3718C4.32876 10.2898 4.37488 10.1787 4.37488 10.0625V7.87498H6.56153C6.6773 7.87498 6.78882 7.82971 6.87086 7.74766C6.95291 7.66562 6.99902 7.55454 6.99902 7.43833L6.99989 5.24997H10.0624C10.3042 5.24997 10.4999 5.0543 10.4999 4.81248V2.62498H13.1249V13.125Z" fill="#9CA3AF"/>
             <path d="M5.25058 2.47487V0H2.77571L3.7038 0.928087L0.000610352 4.64037L0.610236 5.25L4.32252 1.54678L5.25058 2.47487Z" fill="#9CA3AF"/>
           </svg>
           <p>Poschodia</p>
           <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path fill-rule="evenodd" clip-rule="evenodd" d="M7.00005 2.6001C7.18568 2.60014 7.3637 2.67391 7.49495 2.8052L9.59495 4.9052C9.72246 5.03722 9.79301 5.21404 9.79142 5.39758C9.78982 5.58112 9.7162 5.75668 9.58642 5.88647C9.45663 6.01626 9.28106 6.08987 9.09753 6.09147C8.91399 6.09306 8.73717 6.02251 8.60515 5.895L7.00005 4.2899L5.39495 5.895C5.26292 6.02251 5.0861 6.09306 4.90256 6.09147C4.71903 6.08987 4.54346 6.01626 4.41367 5.88647C4.28389 5.75668 4.21027 5.58112 4.20867 5.39758C4.20708 5.21404 4.27764 5.03722 4.40515 4.9052L6.50515 2.8052C6.63639 2.67391 6.81441 2.60014 7.00005 2.6001ZM4.40515 9.1052C4.53642 8.97397 4.71443 8.90025 4.90005 8.90025C5.08566 8.90025 5.26368 8.97397 5.39495 9.1052L7.00005 10.7103L8.60515 9.1052C8.73717 8.97769 8.91399 8.90713 9.09753 8.90873C9.28106 8.91032 9.45663 8.98394 9.58642 9.11372C9.7162 9.24351 9.78982 9.41908 9.79142 9.60262C9.79301 9.78615 9.72246 9.96298 9.59495 10.095L7.49495 12.195C7.36368 12.3262 7.18566 12.3999 7.00005 12.3999C6.81443 12.3999 6.63642 12.3262 6.50515 12.195L4.40515 10.095C4.27392 9.96373 4.2002 9.78571 4.2002 9.6001C4.2002 9.41448 4.27392 9.23647 4.40515 9.1052Z" fill="#081228"/>
           </svg>
         </button>

         <div class="pt-0">
            <select name="floors[]" id="floors" class="dropdown-content" multiple>
              <!-- <option>Poschodia</option>-->
				<option value=""></option>
                <option value="bungalov"> Bungalov</option>
  				<option value="poschodovy"> Poschodovy</option>
  				<option value="podkrovny"> Podkrovný</option>
  				<option value="sgarazou"> S garažou</option>
  				<option value="dosvahu"> Do svahu</option>
            </select>
            <div class="mpfcl" data-relate="#floors" >
                <ul>
                    <li><div class="single-checkbox">
                      <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect x="7" y="14" width="21" height="18" stroke="#081228" stroke-width="2"/>
                      <path d="M1 18.4187L17.4187 2.00004L33.8373 18.4187" stroke="#081228" stroke-width="2"/>
                      <path d="M6.5 23H28" stroke="#081228" stroke-width="2"/>
                      </svg><input type="checkbox" value="bungalov" id="floors-bungalov" ></div> <label for="floors-bungalov" > Bungalov </label> </li>
                    <li><div class="single-checkbox">
                      <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect x="7" y="14" width="21" height="18" stroke="#081228" stroke-width="2"/>
                      <path d="M1 18.4187L17.4187 2.00004L33.8373 18.4187" stroke="#081228" stroke-width="2"/>
                      <path d="M6.5 23H28" stroke="#081228" stroke-width="2"/>
                      </svg>
                        <input type="checkbox" value="poschodovy" id="floors-poschodovy" ></div>
                        <label for="floors-poschodovy" > Dvojposchodový </label> </li>
                    <!-- <li><div class="single-checkbox">
                      <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect x="7" y="14" width="21" height="18" stroke="#081228" stroke-width="2"/>
                      <path d="M1 18.4187L17.4187 2.00004L33.8373 18.4187" stroke="#081228" stroke-width="2"/>
                      <path d="M6.5 23H28" stroke="#081228" stroke-width="2"/>
                      </svg>
                        <input type="checkbox" value="podkrovny" id="floors-podkrovny" ></div> <label for="floors-podkrovny" > Podkrovný </label> </li> -->

                    <!-- <li><div class="single-checkbox">
                      <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect x="7" y="14" width="21" height="18" stroke="#081228" stroke-width="2"/>
                      <path d="M1 18.4187L17.4187 2.00004L33.8373 18.4187" stroke="#081228" stroke-width="2"/>
                      <path d="M6.5 23H28" stroke="#081228" stroke-width="2"/>
                      </svg>
                        <input type="checkbox" value="sgarazou" id="floors-sgarazou" ></div> <label for="floors-sgarazou" > S garažou </label> </li> -->

                    <!-- <li><div class="single-checkbox">
                      <svg width="35" height="35" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect x="7" y="14" width="21" height="18" stroke="#081228" stroke-width="2"/>
                      <path d="M1 18.4187L17.4187 2.00004L33.8373 18.4187" stroke="#081228" stroke-width="2"/>
                      <path d="M6.5 23H28" stroke="#081228" stroke-width="2"/>
                      </svg>
                        <input type="checkbox" value="dosvahu" id="floors-dosvahu" ></div> <label for="floors-dosvahu" > Do svahu </label> </li> -->

                </ul>
            </div>
         </div>
       </div>

        <div class="checkedbox-block">
  		    <label>
            <input type="checkbox" name="garage" id="garage" value="" class="select_garage" /><?php echo "Garage"; ?>
            <div class="wpcf7-list-item-label">
              <span class="checkmark"></span>
            </div>
            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M4.99996 1.61466C4.10209 1.61466 3.241 1.97134 2.60611 2.60623C1.97122 3.24112 1.61454 4.10221 1.61454 5.00008C1.61454 5.44466 1.70211 5.88489 1.87224 6.29562C2.04238 6.70636 2.29174 7.07957 2.60611 7.39393C2.92047 7.7083 3.29368 7.95767 3.70442 8.1278C4.11515 8.29793 4.55538 8.3855 4.99996 8.3855C5.44454 8.3855 5.88476 8.29793 6.2955 8.1278C6.70624 7.95767 7.07944 7.7083 7.39381 7.39393C7.70817 7.07957 7.95754 6.70636 8.12768 6.29562C8.29781 5.88489 8.38538 5.44466 8.38538 5.00008C8.38538 4.10221 8.0287 3.24112 7.39381 2.60623C6.75892 1.97134 5.89783 1.61466 4.99996 1.61466ZM2.09051 2.09063C2.86214 1.319 3.9087 0.885498 4.99996 0.885498C6.09121 0.885498 7.13777 1.319 7.90941 2.09063C8.68104 2.86227 9.11454 3.90883 9.11454 5.00008C9.11454 5.54042 9.00812 6.07546 8.80134 6.57466C8.59456 7.07387 8.29148 7.52746 7.90941 7.90953C7.52733 8.2916 7.07375 8.59468 6.57454 8.80146C6.07534 9.00824 5.54029 9.11466 4.99996 9.11466C4.45962 9.11466 3.92458 9.00824 3.42538 8.80146C2.92617 8.59468 2.47258 8.2916 2.09051 7.90953C1.70844 7.52746 1.40536 7.07387 1.19858 6.57466C0.991803 6.07546 0.885376 5.54042 0.885376 5.00008C0.885376 3.90883 1.31888 2.86227 2.09051 2.09063ZM4.63538 3.33341C4.63538 3.13206 4.79861 2.96883 4.99996 2.96883H5.00413C5.20548 2.96883 5.36871 3.13206 5.36871 3.33341C5.36871 3.53477 5.20548 3.698 5.00413 3.698H4.99996C4.79861 3.698 4.63538 3.53477 4.63538 3.33341ZM4.21871 5.00008C4.21871 4.79873 4.38194 4.6355 4.58329 4.6355H4.99996C5.20131 4.6355 5.36454 4.79873 5.36454 5.00008V6.30216H5.41663C5.61798 6.30216 5.78121 6.46539 5.78121 6.66675C5.78121 6.8681 5.61798 7.03133 5.41663 7.03133H4.99996C4.79861 7.03133 4.63538 6.8681 4.63538 6.66675V5.36466H4.58329C4.38194 5.36466 4.21871 5.20143 4.21871 5.00008Z" fill="#081228"/>
            </svg>
          </label>
       </div>

        <div class="submit-block">
          <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M2.75 3C2.75 2.80109 2.82902 2.61032 2.96967 2.46967C3.11032 2.32902 3.30109 2.25 3.5 2.25H15.5C15.6989 2.25 15.8897 2.32902 16.0303 2.46967C16.171 2.61032 16.25 2.80109 16.25 3V4.9395C16.25 5.1384 16.1709 5.32913 16.0303 5.46975L11.2198 10.2802C11.0791 10.4209 11 10.6116 11 10.8105V12.75L8 15.75V10.8105C7.99996 10.6116 7.92091 10.4209 7.78025 10.2802L2.96975 5.46975C2.82909 5.32913 2.75004 5.1384 2.75 4.9395V3Z" stroke="#081228" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
    			<input type="submit" id="submit" name="submit" value="Filter Property">
        <div class="pt-15"></div>
        </div>

  		</form>
  		<!--<ul id="ajax_filter_search_results"></ul> -->
  	</div>
  <?php } ?>

  <?php if(!(my_wp_is_mobile())) { ?>
    <div id="my-ajax-filter-search" class="my-ajax-filter-search-cus">
  		<form action="" method="post">
        <div class="dropdown">
          <button class="dropbtn">
            <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M13.2293 5.3958C12.936 5.14628 12.5829 4.99436 12.2109 4.9252C12.018 3.42087 10.7434 2.25 9.18751 2.25H4.81249C3.25645 2.25 1.98176 3.42112 1.78907 4.92567C1.41741 4.99483 1.06405 5.1465 0.770737 5.3958C0.281135 5.81236 0 6.41991 0 7.06249C0 7.61706 0.210641 8.14597 0.593013 8.55145C0.775023 8.74458 0.874986 9.03851 0.874986 9.37945V11.4375C0.874986 11.6793 1.07066 11.875 1.31248 11.875H2.62499V12.75H3.49998V11.875H10.5V12.75H11.375V11.875H12.6875C12.9293 11.875 13.125 11.6793 13.125 11.4375V9.37945C13.125 9.03851 13.2249 8.74458 13.407 8.55145C13.7893 8.146 14 7.61706 14 7.06249C14 6.41991 13.7189 5.81236 13.2293 5.3958ZM4.81252 3.12499H9.18751C10.264 3.12499 11.1563 3.9083 11.3367 4.93393C10.3549 5.15321 9.62501 6.08294 9.62501 7.15605V8.375H4.37499V7.15605C4.37499 6.08313 3.64525 5.15355 2.66328 4.93406C2.84371 3.90846 3.73596 3.12499 4.81252 3.12499ZM12.7704 7.9516C12.435 8.30749 12.25 8.81463 12.25 9.37945V11H1.75V9.37945C1.75 8.81463 1.56501 8.30749 1.22963 7.9516C1.00104 7.70891 0.875018 7.39319 0.875018 7.06252C0.875018 6.67713 1.04377 6.31228 1.33773 6.06232C1.63638 5.80855 2.01918 5.706 2.41096 5.76836C3.03174 5.86919 3.50001 6.46606 3.50001 7.15605V8.375V9.24998H10.5V8.375V7.15605C10.5 6.46606 10.9683 5.86919 11.5886 5.76836C11.9834 5.70343 12.3632 5.80768 12.6623 6.06232C12.9563 6.31225 13.125 6.67713 13.125 7.06252C13.125 7.39319 12.999 7.70891 12.7704 7.9516Z" fill="#081228"/>
              <path d="M12.5242 6.96894C12.6951 7.1398 12.6951 7.41681 12.5242 7.58767C12.3534 7.75853 12.0764 7.75853 11.9055 7.58767C11.7346 7.41681 11.7346 7.1398 11.9055 6.96894C12.0764 6.79811 12.3534 6.79811 12.5242 6.96894Z" fill="#081228"/>
              <path d="M2.55754 6.96894C2.7284 7.1398 2.7284 7.41681 2.55754 7.58767C2.38668 7.75853 2.10968 7.75853 1.93881 7.58767C1.76795 7.41681 1.76795 7.1398 1.93881 6.96894C2.10968 6.79811 2.38668 6.79811 2.55754 6.96894Z" fill="#081228"/>
            </svg>
            <p>Počet izieb</p>
            <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M7.00005 2.6001C7.18568 2.60014 7.3637 2.67391 7.49495 2.8052L9.59495 4.9052C9.72246 5.03722 9.79301 5.21404 9.79142 5.39758C9.78982 5.58112 9.7162 5.75668 9.58642 5.88647C9.45663 6.01626 9.28106 6.08987 9.09753 6.09147C8.91399 6.09306 8.73717 6.02251 8.60515 5.895L7.00005 4.2899L5.39495 5.895C5.26292 6.02251 5.0861 6.09306 4.90256 6.09147C4.71903 6.08987 4.54346 6.01626 4.41367 5.88647C4.28389 5.75668 4.21027 5.58112 4.20867 5.39758C4.20708 5.21404 4.27764 5.03722 4.40515 4.9052L6.50515 2.8052C6.63639 2.67391 6.81441 2.60014 7.00005 2.6001ZM4.40515 9.1052C4.53642 8.97397 4.71443 8.90025 4.90005 8.90025C5.08566 8.90025 5.26368 8.97397 5.39495 9.1052L7.00005 10.7103L8.60515 9.1052C8.73717 8.97769 8.91399 8.90713 9.09753 8.90873C9.28106 8.91032 9.45663 8.98394 9.58642 9.11372C9.7162 9.24351 9.78982 9.41908 9.79142 9.60262C9.79301 9.78615 9.72246 9.96298 9.59495 10.095L7.49495 12.195C7.36368 12.3262 7.18566 12.3999 7.00005 12.3999C6.81443 12.3999 6.63642 12.3262 6.50515 12.195L4.40515 10.095C4.27392 9.96373 4.2002 9.78571 4.2002 9.6001C4.2002 9.41448 4.27392 9.23647 4.40515 9.1052Z" fill="#081228"/>
            </svg>
          </button>

          <div class="pt-15">
    				<select name="rooms[]" id="rooms" class="dropdown-content" multiple>
              <!-- <option>Počet izieb</option> -->
    					<option value=""> </option>
                        <option value="2"> 2 izby</option>
    					<option value="3"> 3 izby</option>
    					<option value="4"> 4 izby</option>
    					<option value="5"> 5 a viac izieb</option>
    				</select>
          </div>
        </div>

        <div class="dropdown nth2 white">
         <button class="dropbtn">
           <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path fill-rule="evenodd" clip-rule="evenodd" d="M3.49267 2.77083H10.5073L7 6.27817L3.49267 2.77083ZM2.77083 3.49268V10.5073L6.27816 7.00001L2.77083 3.49268ZM7 7.72185L3.48906 11.2328H10.5109L7 7.72185ZM11.2328 10.511V3.48906L7.72184 7.00001L11.2328 10.511ZM1.75 1.75V12.2536H12.2536V1.75H1.75Z" fill="#9CA3AF"/>
           </svg>
           <p>Úžitková plocha</p>
           <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path fill-rule="evenodd" clip-rule="evenodd" d="M7.00005 2.6001C7.18568 2.60014 7.3637 2.67391 7.49495 2.8052L9.59495 4.9052C9.72246 5.03722 9.79301 5.21404 9.79142 5.39758C9.78982 5.58112 9.7162 5.75668 9.58642 5.88647C9.45663 6.01626 9.28106 6.08987 9.09753 6.09147C8.91399 6.09306 8.73717 6.02251 8.60515 5.895L7.00005 4.2899L5.39495 5.895C5.26292 6.02251 5.0861 6.09306 4.90256 6.09147C4.71903 6.08987 4.54346 6.01626 4.41367 5.88647C4.28389 5.75668 4.21027 5.58112 4.20867 5.39758C4.20708 5.21404 4.27764 5.03722 4.40515 4.9052L6.50515 2.8052C6.63639 2.67391 6.81441 2.60014 7.00005 2.6001ZM4.40515 9.1052C4.53642 8.97397 4.71443 8.90025 4.90005 8.90025C5.08566 8.90025 5.26368 8.97397 5.39495 9.1052L7.00005 10.7103L8.60515 9.1052C8.73717 8.97769 8.91399 8.90713 9.09753 8.90873C9.28106 8.91032 9.45663 8.98394 9.58642 9.11372C9.7162 9.24351 9.78982 9.41908 9.79142 9.60262C9.79301 9.78615 9.72246 9.96298 9.59495 10.095L7.49495 12.195C7.36368 12.3262 7.18566 12.3999 7.00005 12.3999C6.81443 12.3999 6.63642 12.3262 6.50515 12.195L4.40515 10.095C4.27392 9.96373 4.2002 9.78571 4.2002 9.6001C4.2002 9.41448 4.27392 9.23647 4.40515 9.1052Z" fill="#081228"/>
           </svg>
         </button>

         <div class="pt-15">
           <select name="area[]" id="area" class="dropdown-content" multiple>
              <!-- <option>Úžitková plocha</option> -->
					<option value=""></option>
                    <option value="100"> do 100 &#x33A1; </option>
       				<option value="100_200"> 100&#x33A1; - 200&#x33A1;</option>
       				<option value="200"> Od 200&#x33A1;</option>

           </select>
         </div>
        </div>


        <div class="dropdown white">
         <button class="dropbtn">
           <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path d="M13.8717 1.87816C13.7897 1.79612 13.6786 1.75 13.5624 1.75H10.0624C9.82055 1.75 9.62488 1.94567 9.62488 2.18749V4.37498H6.56237C6.32099 4.37498 6.12488 4.57066 6.12488 4.81248V7.00084L3.93739 6.99997C3.82162 6.99997 3.7101 7.04611 3.62805 7.12813C3.54601 7.21017 3.49989 7.32126 3.49989 7.43746V9.62495H1.31324C1.19747 9.62495 1.08595 9.67023 1.00391 9.75228C0.921863 9.83432 0.875747 9.9454 0.875747 10.0616L0.874878 13.5624C0.874878 13.6782 0.921025 13.7897 1.00304 13.8718C1.08508 13.9538 1.19617 13.9999 1.31237 13.9999L13.5615 13.9991C13.8033 13.9991 13.999 13.8034 13.999 13.5616L13.9998 2.18749C13.9999 2.07132 13.9537 1.96024 13.8717 1.87816ZM13.1249 13.125H1.74989V10.4991L3.93739 10.5C4.05316 10.5 4.16467 10.4538 4.24672 10.3718C4.32876 10.2898 4.37488 10.1787 4.37488 10.0625V7.87498H6.56153C6.6773 7.87498 6.78882 7.82971 6.87086 7.74766C6.95291 7.66562 6.99902 7.55454 6.99902 7.43833L6.99989 5.24997H10.0624C10.3042 5.24997 10.4999 5.0543 10.4999 4.81248V2.62498H13.1249V13.125Z" fill="#9CA3AF"/>
             <path d="M5.25058 2.47487V0H2.77571L3.7038 0.928087L0.000610352 4.64037L0.610236 5.25L4.32252 1.54678L5.25058 2.47487Z" fill="#9CA3AF"/>
           </svg>
           <p>Poschodia</p>
           <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
             <path fill-rule="evenodd" clip-rule="evenodd" d="M7.00005 2.6001C7.18568 2.60014 7.3637 2.67391 7.49495 2.8052L9.59495 4.9052C9.72246 5.03722 9.79301 5.21404 9.79142 5.39758C9.78982 5.58112 9.7162 5.75668 9.58642 5.88647C9.45663 6.01626 9.28106 6.08987 9.09753 6.09147C8.91399 6.09306 8.73717 6.02251 8.60515 5.895L7.00005 4.2899L5.39495 5.895C5.26292 6.02251 5.0861 6.09306 4.90256 6.09147C4.71903 6.08987 4.54346 6.01626 4.41367 5.88647C4.28389 5.75668 4.21027 5.58112 4.20867 5.39758C4.20708 5.21404 4.27764 5.03722 4.40515 4.9052L6.50515 2.8052C6.63639 2.67391 6.81441 2.60014 7.00005 2.6001ZM4.40515 9.1052C4.53642 8.97397 4.71443 8.90025 4.90005 8.90025C5.08566 8.90025 5.26368 8.97397 5.39495 9.1052L7.00005 10.7103L8.60515 9.1052C8.73717 8.97769 8.91399 8.90713 9.09753 8.90873C9.28106 8.91032 9.45663 8.98394 9.58642 9.11372C9.7162 9.24351 9.78982 9.41908 9.79142 9.60262C9.79301 9.78615 9.72246 9.96298 9.59495 10.095L7.49495 12.195C7.36368 12.3262 7.18566 12.3999 7.00005 12.3999C6.81443 12.3999 6.63642 12.3262 6.50515 12.195L4.40515 10.095C4.27392 9.96373 4.2002 9.78571 4.2002 9.6001C4.2002 9.41448 4.27392 9.23647 4.40515 9.1052Z" fill="#081228"/>
           </svg>
         </button>

         <div class="pt-15">
           <select name="floors[]" id="floors" class="dropdown-content" multiple>
              <!-- <option>Poschodia</option>-->
					<option value=""> </option>
                    <option value="bungalov"> Bungalov</option>
      				<option value="poschodovy"> Poschodovy</option>
      				<option value="podkrovny"> Podkrovný</option>
      				<option value="sgarazou"> S garažou</option>
      				<option value="dosvahu"> Do svahu</option>
           </select>
         </div>
       </div>

        <div class="checkedbox-block">
  		    <label>
            <input type="checkbox" name="garage" id="garage" value="" class="select_garage" /><?php echo "Garage"; ?>
            <div class="wpcf7-list-item-label">
              <span class="checkmark"></span>
            </div>
            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M4.99996 1.61466C4.10209 1.61466 3.241 1.97134 2.60611 2.60623C1.97122 3.24112 1.61454 4.10221 1.61454 5.00008C1.61454 5.44466 1.70211 5.88489 1.87224 6.29562C2.04238 6.70636 2.29174 7.07957 2.60611 7.39393C2.92047 7.7083 3.29368 7.95767 3.70442 8.1278C4.11515 8.29793 4.55538 8.3855 4.99996 8.3855C5.44454 8.3855 5.88476 8.29793 6.2955 8.1278C6.70624 7.95767 7.07944 7.7083 7.39381 7.39393C7.70817 7.07957 7.95754 6.70636 8.12768 6.29562C8.29781 5.88489 8.38538 5.44466 8.38538 5.00008C8.38538 4.10221 8.0287 3.24112 7.39381 2.60623C6.75892 1.97134 5.89783 1.61466 4.99996 1.61466ZM2.09051 2.09063C2.86214 1.319 3.9087 0.885498 4.99996 0.885498C6.09121 0.885498 7.13777 1.319 7.90941 2.09063C8.68104 2.86227 9.11454 3.90883 9.11454 5.00008C9.11454 5.54042 9.00812 6.07546 8.80134 6.57466C8.59456 7.07387 8.29148 7.52746 7.90941 7.90953C7.52733 8.2916 7.07375 8.59468 6.57454 8.80146C6.07534 9.00824 5.54029 9.11466 4.99996 9.11466C4.45962 9.11466 3.92458 9.00824 3.42538 8.80146C2.92617 8.59468 2.47258 8.2916 2.09051 7.90953C1.70844 7.52746 1.40536 7.07387 1.19858 6.57466C0.991803 6.07546 0.885376 5.54042 0.885376 5.00008C0.885376 3.90883 1.31888 2.86227 2.09051 2.09063ZM4.63538 3.33341C4.63538 3.13206 4.79861 2.96883 4.99996 2.96883H5.00413C5.20548 2.96883 5.36871 3.13206 5.36871 3.33341C5.36871 3.53477 5.20548 3.698 5.00413 3.698H4.99996C4.79861 3.698 4.63538 3.53477 4.63538 3.33341ZM4.21871 5.00008C4.21871 4.79873 4.38194 4.6355 4.58329 4.6355H4.99996C5.20131 4.6355 5.36454 4.79873 5.36454 5.00008V6.30216H5.41663C5.61798 6.30216 5.78121 6.46539 5.78121 6.66675C5.78121 6.8681 5.61798 7.03133 5.41663 7.03133H4.99996C4.79861 7.03133 4.63538 6.8681 4.63538 6.66675V5.36466H4.58329C4.38194 5.36466 4.21871 5.20143 4.21871 5.00008Z" fill="#081228"/>
            </svg>
          </label>
          <div class="pt-15"></div>
       </div>

        <div class="submit-block">
    			<input type="submit" id="submit" name="submit" value="Filter Property">
        <div class="pt-15"></div>
        </div>

  		</form>
  		<!--<ul id="ajax_filter_search_results"></ul> -->
  	</div>
  <?php } ?>


    <!-- <div id="my-ajax-filter-search">
		<form action="" method="post">
			 <?php // echo "Select Rooms"; ?>
				<select name="rooms[]" id="rooms" multiple>
					<option value="2"> 2 Rooms</option>
					<option value="3"> 3 Rooms</option>
					<option value="4"> 4 Rooms</option>
					<option value="5"> 5 Rooms</option>
					<option value="6"> 6 Rooms</option>
					<option value="7"> 7 Rooms</option>
				</select>

			<?php // echo "Usable Area"; ?>
			<select name="area[]" id="area" multiple>
				<option value="25"> 25m³</option>
				<option value="50"> 50m³</option>
				<option value="100"> 100m³</option>
				<option value="150"> 150m³</option>
				<option value="200"> 200m³</option>
				<option value="250"> 250m³</option>
			</select>

			<?php // echo "Floors"; ?>
			<select name="floors[]" id="floors" multiple>
				<option value="2"> 1 Floors</option>
				<option value="2"> 2 Floors</option>
				<option value="3"> 3 Floors</option>
				<option value="4"> 4 Floors</option>
				<option value="2"> 5 Floors</option>
				<option value="3"> 6 Floors</option>
				<option value="4"> 7 Floors</option>
			</select>

			<input type="checkbox" name="garage" id="garage" value="" class="select_garage" /><?php // echo "Garage"; ?>

			<input type="submit" id="submit" name="submit" value="Filter Property">

		</form>
		<!<ul id="ajax_filter_search_results"></ul> -->
	<!-- </div> -->
	<?php
    return ob_get_clean();
}

add_shortcode ('my_ajax_filter_search', 'my_ajax_filter_search_shortcode');


function wpb_adding_styles() {
	wp_enqueue_script( 'my_ajax_filter_search', get_stylesheet_directory_uri(). '/js/script.js', array(), '1.0', true );
	wp_enqueue_script( 'loadingoverlay', get_stylesheet_directory_uri(). '/js/loadingoverlay.min.js', array(), '1.0', true );

    wp_localize_script( 'my_ajax_filter_search', 'ajax_url', admin_url('admin-ajax.php') );
}
add_action( 'wp_enqueue_scripts', 'wpb_adding_styles' );




add_action('wp_ajax_loadmore_property_res', 'loadmore_property_res');
add_action('wp_ajax_nopriv_loadmore_property_res', 'loadmore_property_res');
function loadmore_property_res() {
	header("Content-Type: application/json");

	$args = array(
        'post_type' => 'catalogs',
		'paged' => $_REQUEST['page_no'],
		'post_status' => 'publish'
    );
	$search_query = new WP_Query( $args );

	if ( $search_query->have_posts() ) {

		 $result = array();

        while ( $search_query->have_posts() ) {
            $search_query->the_post();

				if(has_post_thumbnail()) {
					$image = wp_get_attachment_url(get_post_thumbnail_id($post->ID),'full');
				}else{
					$image = "";
				}

				$result[] = array(
					"id" => get_the_ID(),
					"title" => get_the_title(),
					"content" => get_the_content(),
					"permalink" => get_permalink(),
					"poster" => $image,
					"property_living_area" => get_field('property_living_area',get_the_ID()),
					"property_usable_area" => get_field('property_usable_area',get_the_ID()),
					"property_built_up_area" => get_field('property_built_up_area',get_the_ID()),
					"number_of_people" => get_field('number_of_people',get_the_ID()),
					"property_number_of_rooms" => get_field('property_number_of_rooms',get_the_ID()),
				);
		}
		wp_reset_query();
		echo json_encode($result);

	}else{
		echo 0;
	}

	wp_die();
}

// Ajax Callback

add_action('wp_ajax_my_ajax_filter_search', 'my_ajax_filter_search_callback');
add_action('wp_ajax_nopriv_my_ajax_filter_search', 'my_ajax_filter_search_callback');

function my_ajax_filter_search_callback() {

    header("Content-Type: application/json");

    $meta_query = array('relation' => 'AND');

    if(isset($_REQUEST['rooms'])) {
        $rooms =  $_REQUEST['rooms'];

		$meta_query_rooms = array('relation' => 'OR');
		foreach( $rooms as $value ) {
			$meta_query_rooms[] = array(
				'key' => 'property_number_of_rooms', // our new added custom field for the checkboxes
				'value' => $value,
				'compare' => '='
			);
		}

		$meta_query[] = $meta_query_rooms;
    }

	if(isset($_REQUEST['area'])) {
        $area =  $_REQUEST['area'];

		$meta_query_area = array('relation' => 'OR');
		foreach( $area as $value ) {
			$meta_query_area[] = array(
				'key' => 'property_usable_area', // our new added custom field for the checkboxes
				'value' => $value,
				'compare' => '='
			);
		}

		$meta_query[] = $meta_query_area;
    }

    if(isset($_REQUEST['floors'])) {
        $typ_domu = $_REQUEST['floors'];

		$meta_query_typ_domu = array('relation' => 'OR');

		foreach( $typ_domu as $value ) {
			$meta_query_typ_domu[] = array(
				'key' => 'property_typ_domu', // our new added custom field for the checkboxes
				'value' => $value,
				'compare' => '='
			);
		}

		$meta_query[] = $meta_query_typ_domu;
    }


    if(isset($_REQUEST['garage'])) {
        $garage =  $_REQUEST['garage'];
        $meta_query[] = array(
			'key' => 'garage', // our new added custom field for the checkboxes
			'value' => $garage,
			'compare' => '='
		);
    }

	//echo "<pre>";print_r($meta_query);exit;
    $args = array(
        'post_type' => 'catalogs',
        'meta_query' => $meta_query,
		'paged' => $_REQUEST['page_no'],
        //'tax_query' => $tax_query
    );

    /*if(isset($_GET['search'])) {
        $search = sanitize_text_field( $_GET['search'] );
        $search_query = new WP_Query( array(
            'post_type' => 'catalogs',

            'posts_per_page' => -1,
            'meta_query' => $meta_query,
            'tax_query' => $tax_query,
        ) );
    } else {
        $search_query = new WP_Query( $args );
    }*/
	$search_query = new WP_Query( $args );

    if ( $search_query->have_posts() ) {

        $result = array();

        while ( $search_query->have_posts() ) {
            $search_query->the_post();


			if(has_post_thumbnail()) {
				$image = wp_get_attachment_url(get_post_thumbnail_id($post->ID),'full');
			}else{
				$image = "";
			}
            $result[] = array(
                "id" => get_the_ID(),
				"title" => get_the_title(),
				"content" => get_the_content(),
				"permalink" => get_permalink(),
				"poster" => $image,
				"property_living_area" => get_field('property_living_area',get_the_ID()),
				"property_usable_area" => get_field('property_usable_area',get_the_ID()),
				"property_built_up_area" => get_field('property_built_up_area',get_the_ID()),
				"number_of_people" => get_field('number_of_people',get_the_ID()),
				"property_number_of_rooms" => get_field('property_number_of_rooms',get_the_ID()),
            );
        }
        wp_reset_query();
		$update_res = array('page_count'=> $search_query->max_num_pages, 'res' => $result);
        echo json_encode($update_res);

    } else {
        echo 0;
    }
    wp_die();
}



/** Header Logo Function Start */
function header_logo_top(){
    ob_start();
        if( has_custom_logo() ){
            $headerLogoID = attachment_url_to_postid( get_theme_mod( 'header_logo' ) ) ; // Header Logo ID
            $headerLogoImage = wp_get_attachment_image( $headerLogoID ,'large', '', ["class" => "header-logo transition"] ); //Header Logo Image

            echo '<div class="header-logo position-relative transition twidth white-logo">' .
                '<a href="' . get_option('home') . '" class="d-block transition position-relative">' .
                    ( $headerLogoID ? $headerLogoImage : '' ) .
                '</a>' .
            '</div>';
        }
    return ob_get_clean();
}
