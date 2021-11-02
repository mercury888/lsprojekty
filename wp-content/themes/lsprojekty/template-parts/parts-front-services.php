<?php

if( have_rows('services_listing') ):
  echo '<section class="services-section text-center">'.
    '<div class="d-flex">';
      while ( have_rows('services_listing') ) : the_row();
          $service_title = get_sub_field('service_title');
          $service_sub_title = get_sub_field('service_sub_title');
          $service_image = get_sub_field('service_image');
          $service_link = get_sub_field('service_link');

          echo '<div class="single-service">'.
            ($service_link ? '<a href="'. $service_link .'">' : '') .
              '<div class="inbanner image-src">'.
                  wp_image($service_image , 'full') .
              '</div>'.
              '<div class="content-part">'.
                  '<div class="top-content">'.
                    '<h3 class="mb-0 text-white">'. $service_title .'</h3>'.
                    '<span class="half-circle spin circle"></span>'.
                  '</div>'.
                  '<div class="bottom-content">'.
                  '<p class="mb-10 text-white">'. $service_sub_title .'</p>'.
                  '<span class="link d-flex justify-content-center align-items-center"><span class="d-flex justify-content-center align-items-center"><p>Zistiť viac</p><svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M9.62012 4.45337L13.6668 8.50004L9.62012 12.5467" stroke="#081228" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
      <path d="M2.33325 8.5H13.5533" stroke="#081228" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
      </svg></span></span>'.
                '</div>'.
              '</div>'.
            ($service_link ? '</a>' : '') .
          '</div>';
      endwhile;
      echo '</div>'.
  '</section>';
endif;

?>
