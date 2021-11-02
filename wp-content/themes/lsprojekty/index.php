<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

 get_header();

 $page_for_posts = get_option( 'page_for_posts' );
 /*$new_bannner_pos = get_field('banner_position', $page_for_posts);
 if ( have_posts() && has_post_thumbnail($page_for_posts) && 'Top' == $new_bannner_pos ) :
 echo '<div class="innbaner">' .
     get_the_post_thumbnail($page_for_posts) .
  '</div>';
 endif;*/

 $postID = get_option('page_for_posts', true);

 echo '<div class="content">';
         echo '<div class="mid blog-listing position-relative">' .
             '<div class="wrapper">';
                 if (have_posts()) :
                     echo '<div class="post">';
                         echo '<h1 class="mb-0 position-relative">' . get_the_title($page_for_posts) . '</h1>';
                     echo '</div>';

                echo '<div class="d-flex justify-content-center">';
                 while ( have_posts()) : the_post();
                     echo '<div id="post-' . get_the_ID() . ' " class="single-post '. join( ' listing-single-post ', get_post_class() ) .'">' .
                      '<div class="inner-blog bg-white position-relative">'.
                         (
                             has_post_thumbnail()
                             ? '<div class="blog-image position-relative">' .
                                 wp_get_attachment_image( get_post_thumbnail_id(), 'full' ) .
                                 '<span class="date-with-svg position-absolute pin-t-20 pin-l-20">' .
                                     '<svg> <use xlink:href="#date-svg" /> </svg>' .
                                     '<span class="cal-month">' . get_the_time('M') . '</span>' .
                                     '<span class="cal-date transform-center">' . get_the_time('j') . '<sup>' . get_the_time('S') . '</sup> ' . '</span>' .
                                     '<span class="cal-year">' . get_the_time('Y') . '</span>' .
                                 '</span>' .
                             '</div>'
                             : ''
                         ) .
                         '<div class="blog-content p-20">'.
                           '<h2><a href=" ' . get_the_permalink() . ' " rel="bookmark" title="Permanent Link to '. get_the_title() .'">' . get_the_title() . '</a></h2>' .
                           '<div class="entry"><p>' .  get_the_excerpt() . '</p></div>' .
                           '<a class="read-more" href="'. get_the_permalink() .'">Read More</a>'.
                         '</div>'.
                       '</div>'.
                     '</div>';
                 endwhile;
                 twentynineteen_the_posts_navigation();
                 else :
                     echo '<h2 class="center">Not Found</h2>';
                     echo '<p class="center">Sorry, but you are looking for something that isnt here.</p>';
                 endif;
                 echo '</div>'.
               '</div>'.
           '</div>' .
 '</div>';

 get_footer();
