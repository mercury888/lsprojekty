<?php

$ServicesGroup = get_field('listing_section');
$FacilitySecImage = $ServicesGroup['facility_image'];
/*--- facility---*/
function facility() {
  ob_start();
       if( have_rows('facility_listing') ){
    echo '<div class="facilities cell-10 cell-1600-9 cell-1200-12 d-flex justify-content-center list-none pt-50 pt-992-30">';
    $CountNumber = 1;
     while ( have_rows('facility_listing') ) :
        the_row();
        $facilityTitle = get_sub_field( 'facility_title' );
        $facilityDesc = get_sub_field( 'facility_content' );
        $facilityUrl = get_sub_field( 'facility_link' );
        if( !empty( $facilityUrl ) ){
            $facilityUrlTitle = $facilityUrl[ 'title' ];
            $facilityUrlURL = $facilityUrl[ 'url' ];
            $facilityUrlTarget = $facilityUrl[ 'target' ];

        echo '<div class="facility-item cell-4 cell-992-6 cell-767-12 px-20 py-35">'.
              '<span class="number-icon">0'. $CountNumber . '.</span>'.
              '<h4 class="text-uppercase mb-20 text-24">' . $facilityTitle . '</h4>' .
                (
                    $facilityDesc
                    ? '<p data-match-height class="text-14 text-gray">' . $facilityDesc . '</p>'
                    : ''
                ) .
               '<a href="'. $facilityUrlURL .'" class="link-btn" target="'. $facilityUrlTarget .'">'. $facilityUrlTitle .'</a>'.
            '</div>';
        }
        $CountNumber++; endwhile;
    echo '</div>';
    }

  return ob_get_clean();
}

if(have_rows('listing_section')){
    while( have_rows('listing_section') ) :
    the_row();

    echo '<section class="listing-section position-relative section-padding">' .
            '<div class="inner-section position-relative section-padding">'.
                  (
                      $FacilitySecImage
                      ? '<div class="facility-media position-absolute pin-r d-992-none">'. wp_image($FacilitySecImage) . '</div>'
                      : ''
                  ).
              '<div class="wrapper">' .
                    facility() .
               '</div>' .
           '</div>' .
        '</section>';
    endwhile;
}



?>
