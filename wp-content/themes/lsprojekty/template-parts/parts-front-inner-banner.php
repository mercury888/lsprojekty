<?php

if (has_post_thumbnail( $post->ID ) ):
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );

  echo '<section class="banner-top" style="background-image: url('. $image[0]  .')">'.
    '<div class="wrapper d-flex align-items-center align-content-center text-center">';
        while (have_posts()) : the_post();
          echo '<div class="banner-content cell-12">'.
    				'<span class="mb-0 text-uppercase">' . get_the_title() . '</span>'.
            (
              get_field('banner_title')
              ? '<h1 class="text-uppercase mb-0">'. get_field('banner_title') .'</h1>'
              : ''
            ) .
          '</div>';
  	   endwhile;
    echo '</div>'.
  '</section>';
endif;

?>
