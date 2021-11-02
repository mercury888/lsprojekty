<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
get_header();


wp_reset_query();
wp_reset_postdata();
if ( have_posts() ):
	$post_type_obj = get_post_type_object( get_post_type() );
	$title = apply_filters('post_type_archive_title', $post_type_obj->labels->name );
	$archive_title = apply_filters('post_type_archive_title', $post_type_obj->labels->all_items);

	$post_id = 588;
	$queried_post = get_post($post_id);
	$src = wp_get_attachment_image_src(get_post_thumbnail_id($queried_post->ID), '') ;
	$thumb_id = get_post_thumbnail_id($post_id);

  echo '<section class="banner-top" style="background-image: url('. $src[0]  .')">'.
    '<div class="wrapper d-flex align-items-center align-content-center text-center">';
          echo '<div class="banner-content cell-12">'.
    				'<span class="mb-0 text-uppercase">' . get_the_title($post_id) . '</span>'.
            (
              get_field('banner_title',$post_id)
              ? '<h1 class="text-uppercase mb-0">'. get_field('banner_title',$post_id) .'</h1>'
              : ''
            ) .
          '</div>';
    echo '</div>'.
  '</section>';
endif;

echo '<section class="referencie-section">'.
	'<div class="wrapper">';
			if ( have_posts() ) {
				echo '<ul class="referencie-listing d-flex list-none">' ;
					while (  have_posts() ) :the_post();

					echo '<li class="referencie-content cell-6">' .
						'<div class="inner-content">'.
							(
								has_post_thumbnail()
								? '<div class="inbanner image-src"><a href="'. get_the_permalink() .'">' . wp_get_attachment_image( get_post_thumbnail_id(), 'full' ) . '</a></div>'
								: ''
							) .
							'<div class="description">' .
								'<h3><a href="'. get_the_permalink() .'">' . get_the_title() . '</a></h3>'.
								(
									get_field('referencie_type')
									? '<h4>'. get_field('referencie_type') .'</h4>'
									: ''
								) .
							'</div>' .
						'</div>'.
					'</li>' ;
					endwhile;
				echo '</ul>' ;
		} else {
			echo '<h2>' . 'No referencie available' . '</h2>';
		}
	echo '</div>' .
'</section>' ;
get_footer();

?>
