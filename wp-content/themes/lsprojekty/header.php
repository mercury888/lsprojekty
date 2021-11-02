<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>  >
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link rel="profile" href="https://gmpg.org/xfn/11" />
        <?php wp_head(); ?>
        <style type="text/css">
        /* @media (max-width: 767px) {
          .dropdown-content {
              position: relative !important;
              width: 100% !important;
              clip-path: none !important;
              height: auto !important;
              display: block !important;
              min-height: auto !important;
            }
          } */
            /*Checkbox for select2*/
            .select2-results__options[aria-multiselectable="true"] li {
                padding-left: 30px;
                position: relative
            }
            .select2-results__options[aria-multiselectable="true"] li:before {
                position: absolute;
                left: 8px;
                opacity: .6;
                top: 6px;
                font-family: "FontAwesome";
                content: "\f0c8";
            }
            .select2-results__options[aria-multiselectable="true"] li[aria-selected="true"]:before {
                content: "\f14a";
            }
        </style>
    </head>
    <body <?php echo (is_page('98') ? ' id="home-page"' : ''); ?> >

      <!-- SVG files for Icons and Quotes -->
		<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
			<symbol id="date-svg" viewBox="0 0 32.8 32.8">
				<path d="M29.4,1.2h-1.1c0-0.1,0.1-0.2,0.1-0.3c0-0.5-0.4-1-1-1s-1,0.4-1,1c0,0.1,0,0.2,0.1,0.3h-3.7c0-0.1,0.1-0.2,0.1-0.3
					c0-0.5-0.4-1-1-1c-0.5,0-1,0.4-1,1c0,0.1,0,0.2,0.1,0.3h-3.7c0-0.1,0.1-0.2,0.1-0.3c0-0.5-0.4-1-1-1s-1,0.4-1,1c0,0.1,0,0.2,0.1,0.3
					h-3.7c0-0.1,0.1-0.2,0.1-0.3c0-0.5-0.4-1-1-1s-1,0.4-1,1c0,0.1,0,0.2,0.1,0.3H6.3c0-0.1,0.1-0.2,0.1-0.3c0-0.5-0.4-1-1-1s-1,0.4-1,1
					c0,0.1,0,0.2,0.1,0.3H3.4C1.9,1.2,0.6,2.5,0.6,4v26c0,1.5,1.2,2.8,2.8,2.8h22.9l5.9-5.9V4C32.1,2.5,30.9,1.2,29.4,1.2z M30.6,26.3
					l-0.3,0.3H28c-1.1,0-2,0.9-2,2v2.4l-0.3,0.3H3.4c-0.7,0-1.3-0.6-1.3-1.3V11h28.5V26.3z"/>
			</symbol>
	  </svg>

        <?php
            /** mobile navigation */
            echo '<div class="mobile_menu d-none visible-mobile">' .
                '<a href="#" class="close-btn"></a>' .
                '<div class="mob-appntmtn">' .
                  '<div class="header-logo position-relative transition twidth">' .
                      header_logo_top() .
                  '</div>'.
                '</div>' .
                '<div class="inner">' .
                    main_navigation() .
                '</div>' .
                '<div class="mob-other">'.
                '</div>'.
           '</div>';
        ?>

        <div id="wrapper" class="sticky-header <?php echo (!is_front_page() ? 'bg-color' : ''); ?>">

            <?php
                /** Brand Logo Function Start */
                function brand_logo(){
                    ob_start();
                    if( has_custom_logo() ){
                        $desktopBrandLogoID = get_theme_mod( 'custom_logo' ); //Desktop Main brand Logo ID
                        $desktopBrandLogoImage = wp_get_attachment_image( $desktopBrandLogoID , 'full', '', ["class" => "transition"] ); //Desktop Main brand Logo Image
                        echo '<div class="header-logo position-relative transition twidth black-logo">' .
                            '<a href="' . get_option('home') . '" class="cell-12 transition position-relative">' .
                                ( $desktopBrandLogoID ? $desktopBrandLogoImage : '' ) .
                                // '<img src="'. get_template_directory_uri() .'/images/header-white.png" class="white-logo" />'.
                            '</a>' .
                        '</div>'.
                        header_logo_top();
                    }
                    return ob_get_clean();
                }
                /** Brand Logo Function End */

                echo '<header id="myHeader" class=" d-block cell-12 transition '. ( is_user_logged_in() ? 'logged_in' : '' ) .'">' .
                '<div class="wrapper d-flex align-items-center justify-content-between">' .
                   brand_logo() .
                    '<div class="quick-links d-flex justify-content-end cell-12 height-auto">'.
                       '<a class="navbar-toggle" href="javascript:void(0)"><span class="navbar-toggle__icon-bar"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </span> </a>'.
                    '</div>' .
                    (
                        my_wp_is_mobile() == 1
                        ? ''
                        : '<div class="main-navigation cell-12 height-auto d-flex justify-content-center position-relative pt-30 transition">' .
                            (
                                has_nav_menu( 'main-navigation' )
                                ? '<nav id="site-navigation" class="" aria-label="' . esc_attr( 'Top Menu', 'twentynineteen' ) . '">' .
                                  main_navigation() .
                               '</nav>'
                                : ''
                            ) .
                        '</div>'
                    ) .
                    call_header() .
                '</div>' .
            '</header>' .

                '<div id="content-area" class="">';
