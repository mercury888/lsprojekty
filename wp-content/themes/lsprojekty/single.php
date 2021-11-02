<?php
/**
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?>

<?php
get_header();
echo '<div class="content">';
	   echo '<div class="mid blog-details position-relative text-767-center">' .
	        '<div class="wrapper">';
	       		if (have_posts()) :
	            while (have_posts()) : the_post(); ?>
	             	<div <?php post_class(); ?> id="post-<?php echo get_the_ID(); ?>'">
	             		<?php echo '<h1>' . get_the_title() . '</h1>';
                        echo
                        (
                            has_post_thumbnail()
                            ? '<div class="post-img position-relative mb-30">' .
                                wp_get_attachment_image( get_post_thumbnail_id(), 'full' ) .
                                '<span class="date-with-svg position-absolute pin-t-20 pin-l-20">' .
                                    '<svg> <use xlink:href="#date-svg" /> </svg>' .
                                    '<span class="cal-month">' . get_the_time('M') . '</span>' .
                                    '<span class="cal-date transform-center">' . get_the_time('j') . '<sup>' . get_the_time('S') . '</sup> ' . '</span>' .
                                    '<span class="cal-year">' . get_the_time('Y') . '</span>' .
                                '</span>' .
                            '</div>'
                            : '<span class="date-with-svg">' .
                                '<svg> <use xlink:href="#date-svg" /> </svg>' .
                                '<span class="cal-month">' . get_the_time('M') . '</span>' .
                                '<span class="cal-date transform-center">' . get_the_time('j') . '<sup>' . get_the_time('S') . '</sup> ' . '</span>' .
                                '<span class="cal-year">' . get_the_time('Y') . '</span>' .
                            '</span>'
                        ) .
                        '<div class="entry">';
			            	the_content('<p class="serif">Read the rest of this entry </p>');

										$link = get_field('news_button');
										if( $link ):
										    $link_url = $link['url'];
										    $link_title = $link['title'];
										    $link_target = $link['target'] ? $link['target'] : '_self';

									    	echo '<div class="blog-button mt-20"><a class="read-more" href="'. esc_url( $link_url ) .'" target="'. esc_attr( $link_target ) .'">'. esc_html( $link_title )  .'</a></div>';
										endif;

			            echo '</div>';
	            	echo '</div>';
	            endwhile; else :
	            	echo '<p>Sorry, no posts matched your criteria.</p>';
	            endif;
	        echo '</div>';
	    echo '</div>';
echo '</div>';


get_footer();
