<?php
/**
*
* @package WordPress
* @subpackage Twenty_Nineteen
* @since Twenty Nineteen 1.0.0
*/
get_header();

wp_reset_query();
wp_reset_postdata();

// Banner Slider
if( have_rows('banner_images') ):
  echo '<section class="banner-images-slider">';
      while ( have_rows('banner_images') ) : the_row();
          $single_image = get_sub_field('single_image');

          echo '<div class="single-image">' .
            wp_image($single_image, 'full') .
          '</div>';
      endwhile;
    echo '</section>';
endif;

// Facility Section
if( have_rows('facility_listing') ):
  echo '<section class="facility-listing">'.
      '<div class="wrapper d-flex">';

        $count = count(get_field('facility_listing'));
        while ( have_rows('facility_listing') ) : the_row();
            $facility_icon = get_sub_field('facility_icon');
            $facility_name = get_sub_field('facility_name');
            $facility_value = get_sub_field('facility_value');

            echo '<div class="single-facility d-flex justify-content-center align-items-center col'. $count .'">' .
              '<div class="icon">'.
                wp_icon($facility_icon) .
              '</div>'.
              '<div class="desciription">'.
                  (
                    $facility_name
                    ? '<h3>'. $facility_name .'</h3>'
                    : ''
                  ) .
                  (
                    $facility_value
                    ? '<p>'. $facility_value .'</p>'
                    : ''
                  ) .
              '</div>'.
            '</div>';
        endwhile;
    echo '</div>'.
  '</section>';
endif;


$contact_form = get_field('contact_form');
$price_value = get_field('price_value');
$detail_button = get_field('detail_button');
if( $detail_button ):
    $detail_url = $detail_button['url'];
    $detail_title = $detail_button['title'];
    $detail_target = $detail_button['target'] ? $detail_button['target'] : '_self';
endif;

$see_more_button = get_field('see_more_button');
if( $see_more_button ):
    $see_more_url = $see_more_button['url'];
    $see_more_title = $see_more_button['title'];
    $see_more_target = $see_more_button['target'] ? $see_more_button['target'] : '_self';
endif;

echo '<section class="detail-page-content">'.
  '<div class="wrapper d-flex justify-content-between">'.
    '<div class="content-block">'.
      '<div class="breadcrumb">'. ah_breadcrumb() .'</div>';

      while ( have_posts() ) : the_post();
        echo '<h1 class="h2 pb-10">' . get_the_title() .'</h1>';
        echo apply_filters( 'the_content', wp_trim_words( get_the_content(), 50 ) );
      endwhile;

      echo '<div class="button"><a class="link" href="'. $see_more_url .'"  target="'. esc_attr( $see_more_target ) .'"><span class="d-flex align-items-center">'. esc_html( $see_more_title ) .'<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12.6667 6L8.00008 10.6667L3.33341 6" stroke="#081228" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg></span></a></div>';

    echo '</div>'.
    '<div class="table-block">';
      if( have_rows('table_listing') ):
          echo '<div class="table-listing">';
            while ( have_rows('table_listing') ) : the_row();
                $name = get_sub_field('name');
                $value = get_sub_field('value');

                echo '<div class="table-content d-flex justify-content-between align-items-center">' .
                  '<h3 class="mb-0">'. $name .'</h3>'.
                  '<p>'. $value .'</p>'.
                '</div>';
            endwhile;
          echo '</div>';
      endif;
      echo '<div class="table-button-block '. ($price_value ? 'd-flex justify-content-center': 'mt-25') .'">'.
        (
          $price_value
          ? '<div class="price-block cell-6">'.
            '<h3 class="mb-5">cena projektu od</h3>'.
            '<p>'. $price_value .'</p>'.
          '</div>'
          : ''
        ) .
        '<div class="detail-block d-flex justify-content-center align-items-center '. ($price_value ? 'cell-6': 'cell-12 one-button') .'">'.
            '<a class="link d-flex justify-content-center align-items-center" '.( $detail_url=='#content-popup' ? ' data-fancybox' : '' ).' href="'. $detail_url .'"  target="'. esc_attr( $detail_target ) .'"><span class="d-flex justify-content-center align-items-center"><p>'. esc_html( $detail_title ) .'</p><svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M9.62012 4.45337L13.6668 8.50004L9.62012 12.5467" stroke="#081228" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M2.33325 8.5H13.5533" stroke="#081228" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg></span></a>'.
        '</div>'.
      '</div>'.

      '<div style="display:none;">';
        echo '<div id="content-popup" class="pupup_frm">'.
              '<div class="inner">';
                  echo '<span class="d-block subtitle text-center">Mám záujem o informácie</span>';
                  echo '<h2 class="d-block text-center">'. get_the_title() .'</h2>';
                  echo do_shortcode($contact_form);
          echo '</div>' .
          '</div>'.
      '</div>'.
    '</div>'.

  '</div>'.
'</section>';



$floor_plans_heading = get_field('floor_plans_heading');
$floor_plans_left_image = get_field('floor_plans_left_image');
$floor_plans_right_image = get_field('floor_plans_right_image');

echo '<section class="floor-plans-section">'.
  '<div class="wrapper">'.
      (
        $floor_plans_heading
        ? '<h2>'. $floor_plans_heading .'</h2>'
        : ''
      ) .
      '<div class="floor-plans-image d-flex '. ($floor_plans_right_image ? 'justify-content-between' : 'justify-content-center') .'">'.
          (
            $floor_plans_left_image
            ? '<div class="image-block">'.
              '<a href="'. wp_get_attachment_image_url($floor_plans_left_image, 'full') .'" data-fancybox="left_block">'.
                wp_image($floor_plans_left_image, 'full') .
              '</a>'.
            '</div>'
            : ''
          ) .
          (
            $floor_plans_right_image
            ? '<div class="image-block">'.
              '<a href="'. wp_get_attachment_image_url($floor_plans_right_image, 'full') .'" data-fancybox="right_block">'.
                wp_image($floor_plans_right_image, 'full') .
              '</a>'.
            '</div>'
            : ''
          ) .
      '</div>';

      if( have_rows('floor_plans_image_list') ):
        echo '<div class="plans-image-list d-flex justify-content-center align-items-center">';
            while ( have_rows('floor_plans_image_list') ) : the_row();
                $floor_plans_image = get_sub_field('floor_plans_image');

                echo '<div class="single-image cell-3">' .
                  '<a href="'. wp_get_attachment_image_url($floor_plans_image, 'full') .'" data-fancybox="floor_plans">'.
                    wp_image($floor_plans_image, 'full') .
                  '</a>'.
                '</div>';
            endwhile;
          echo '</div>';
      endif;

  echo '</div>'.
'</section>';


// Images Slider
if( have_rows('images_slider') ):
  echo '<section class="images-slider">';
      while ( have_rows('images_slider') ) : the_row();
          $single_image = get_sub_field('single_image');

          echo '<div class="single-image">' .
            '<a href="'. wp_get_attachment_image_url($single_image, 'full') .'" data-fancybox="images_slider">'.
              '<div class="inbanner image-src">'.
                wp_image($single_image, 'full') .
              '</div>'.
            '</a>'.
          '</div>';
      endwhile;
    echo '</section>';
endif;


get_template_part( 'template-parts/parts-front', 'info' );


get_footer();
?>
