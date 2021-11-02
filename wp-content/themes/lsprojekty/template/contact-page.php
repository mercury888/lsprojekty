<?php
/*
Template Name: Contact Page
*/
/** header */
get_header();

// /** banner */
get_template_part( 'template-parts/parts-front', 'inner-banner' );

global $facebook;
global $insta;
global $emailIcon;
global $phoneIcon;

$contactTitle = get_field('contact_title');
$contactDescription = get_field('contact_description');
$contactForm = get_field('contact_form');
$contactIframe = get_field('contact_iframe');

if($contactForm) {
  echo '<section class="contact-section position-relative">'.
      '<div class="contact-info text-center">'.
        '<div class="wrapper">'.
        '<div class="d-flex">';

        $locationPhoneNumber = get_field('contact_phone');
        if( $locationPhoneNumber ) {
          echo '<div class="contact-item cell-3 cell-767-12 call">'.
                  '<a href="tel:' . preg_replace('/[^0-9]/', '', $locationPhoneNumber ) . '" class=" py-30">' .
                      '<span class="icon-thumb">'. $phoneIcon .'</span>'.
                      $locationPhoneNumber .
                  '</a>'.
              '</div>';
        }

        $locationEmail = get_field('contact_email');
        if( $locationEmail ) {
          echo '<div class="contact-item cell-3 cell-767-12 pb-767-15 email">'.
          (
            $locationEmail
            ? '<a href="mailto:'.  $locationEmail.'" class=" py-30">' .
                    '<span class="icon-thumb">'. $emailIcon .'</span>'.
                    $locationEmail .
               '</a>'
            : ''
            ) .
            '</div>';
          }

        $ContactFacebook = get_field('contact_facebook');
        if( $ContactFacebook ) {
          echo '<div class="contact-item cell-3 cell-767-12 pb-767-15 email">'.
              '<a href="'.  $ContactFacebook.'" class=" py-30">' .
                  '<span class="icon-thumb">'. $facebook .'</span>'.
                  'facebook' .
               '</a>'.
            '</div>';
          }

          $ContactInstagram = get_field('contact_instagram');
          if( $ContactInstagram ) {
            echo '<div class="contact-item cell-3 cell-767-12 pb-767-15 email">'.
              '<a href="'.  $ContactInstagram.'" class=" py-30">' .
                  '<span class="icon-thumb">'. $insta .'</span>'.
                  'instagram' .
               '</a>'.
            '</div>';
            }


        echo '</div>'.
        '</div>'.
      '</div>'.

'<div class="contact-outer-section position-relative">'.
    '<div class="contact-form d-flex justify-content-between">'.
        (
            $contactIframe
            ? '<div class="contact-map cell-5 d-992-none">'. $contactIframe .'</div>'
            : ''
        ) .
        '<div class="form-block '. ( $contactIframe ? 'cell-7 cell-992-12' : '') .'">'.
            (
              $contactTitle
              ? '<h2>'. $contactTitle .'</h2>'
              : ''
            ) .
            (
              $contactDescription
              ? '<p>'. $contactDescription .'</p>'
              : ''
            ) .
            do_shortcode($contactForm) .
        '</div>'.
    '</div>'.
'</div>'.


  '</section>';
}

if( get_field( 'address_map_iframe' ,'options') ){
  echo '<section class="map-section">'.
    	do_shortcode('[location-map]') .
  '</section>';
}

// /** footer */
get_footer();

?>
