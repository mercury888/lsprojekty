<?php
/*
Template Name: Referencie Page
*/
/** header */
get_header();

// /** banner */
get_template_part( 'template-parts/parts-front', 'inner-banner' );


// Referencie Listing
if( have_rows('referencie_listing') ):
  echo '<section class="referencie-section">'.
    '<div class="wrapper">'.
      '<ul class="referencie-listing d-flex list-none">';
        while ( have_rows('referencie_listing') ) : the_row();
            $referencie_image = get_sub_field('referencie_image');
            $referencie_name = get_sub_field('referencie_name');
            $referencie_type = get_sub_field('referencie_type');

            echo '<li class="referencie-content cell-6">'.
              '<div class="inner-content">'.
                (
                  $referencie_image
                  ? '<div class="inbanner image-src">'.
                    wp_image($referencie_image, 'full') .
                  '</div>'
                  : ''
                ) .
                '<div class="description">'.
                  (
                    $referencie_name
                    ? '<h3>'. $referencie_name .'</h3>'
                    : ''
                  ) .
                  (
                    $referencie_type
                    ? '<h4>'. $referencie_type .'</h4>'
                    : ''
                  ) .
                '</div>'.
              '</div>'.
            '</li>';
        endwhile;
  echo '</ul>'.
    '</div>'.
  '</section>';
endif;



// /** footer */
get_footer();

?>
