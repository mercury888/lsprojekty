<?php
$catalog_section = get_field('catalog_section');
$catalog_heading = $catalog_section['catalog_heading'];
$catalog_sub_heading = $catalog_section['catalog_sub_heading'];
$all_catalog_image = $catalog_section['all_catalog_image'];
$all_catalog_link = $catalog_section['all_catalog_link'];
if( $all_catalog_link ):
    $link_url = $all_catalog_link['url'];
    $link_title = $all_catalog_link['title'];
    $link_target = $all_catalog_link['target'] ? $all_catalog_link['target'] : '_self';
endif;

if( have_rows('catalog_section') ) {
	while ( have_rows('catalog_section') ) : the_row();
	echo '<section class="catalog-section position-relative section-padding">' .
		'<div class="wrapper">';

    $posts = get_sub_field('select_catalog');
    if( $posts ) {
    echo '<div class="catalog-block position-relative">'.
          (
              $catalog_heading
              ? '<h2 class="mb-0">'.$catalog_heading.'</h2>'
              : ''
          ).
          (
              $catalog_sub_heading
              ? '<p>'.$catalog_sub_heading.'</p>'
              : ''
          ).
          '<div class="grid-wrapper">';
              $count = 1;
              foreach($posts as $post):
                setup_postdata($post);
                  echo '<div class="single-catalog" style="background-image: url('. get_the_post_thumbnail_url($post) .');">' .
                    '<a href="'. get_the_permalink() .'">'.
                      '<div class="top-content">'.
                        '<h3 class="mb-0 text-white">Zobraziť projekt</h3>'.
                        '<span class="half-circle spin circle"></span>'.
                      '</div>'.

                      '<div class="inner-content">'.
                        (
                          get_the_title()
                          ? '<h4 class="text-white mb-5">' . get_the_title() . '</h4>'
                          : ''
                        ) .
                        '<div class="d-flex info">'.
                          '<p><svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M3.99162 3.66667H12.0084L8 7.67505L3.99162 3.66667ZM3.16667 4.49163V12.5084L7.17504 8.50001L3.16667 4.49163ZM8 9.32497L3.98749 13.3375H12.0125L8 9.32497ZM12.8375 12.5125V4.48749L8.82496 8.50001L12.8375 12.5125ZM2 2.5V14.5041H14.0041V2.5H2Z" fill="#657395"/>
                          </svg><span>'. get_field('property_usable_area') .' m2</span></p>'.

                          '<p class="pl-20"><svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M15.1192 6.0952C14.784 5.81004 14.3805 5.63641 13.9553 5.55738C13.7349 3.83814 12.2782 2.5 10.5 2.5H5.49999C3.72166 2.5 2.26487 3.83842 2.04465 5.55791C1.6199 5.63695 1.21605 5.81028 0.880842 6.0952C0.321297 6.57127 0 7.26561 0 7.99999C0 8.63378 0.240733 9.23825 0.677729 9.70166C0.88574 9.92237 0.999985 10.2583 0.999985 10.6479V13C0.999985 13.2763 1.22361 13.5 1.49998 13.5H2.99999V14.5H3.99997V13.5H12V14.5H13V13.5H14.5C14.7764 13.5 15 13.2763 15 13V10.6479C15 10.2583 15.1142 9.92237 15.3222 9.70166C15.7592 9.23829 16 8.63378 16 7.99999C16 7.26561 15.6787 6.57127 15.1192 6.0952ZM5.50002 3.49998H10.5C11.7303 3.49998 12.75 4.3952 12.9563 5.56735C11.8342 5.81795 11 6.8805 11 8.10692V9.5H4.99999V8.10692C4.99999 6.88072 4.166 5.81834 3.04375 5.56749C3.24995 4.39538 4.26967 3.49998 5.50002 3.49998ZM14.5947 9.01612C14.2114 9.42284 14 10.0024 14 10.6479V12.5H2V10.6479C2 10.0024 1.78859 9.42284 1.40529 9.01612C1.14404 8.73876 1.00002 8.37793 1.00002 8.00002C1.00002 7.55958 1.19288 7.1426 1.52883 6.85694C1.87014 6.56691 2.30764 6.44972 2.75539 6.52098C3.46485 6.63622 4.00001 7.31835 4.00001 8.10692V9.5V10.5H12V9.5V8.10692C12 7.31835 12.5352 6.63622 13.2442 6.52098C13.6953 6.44677 14.1294 6.56592 14.4712 6.85694C14.8072 7.14257 15 7.55958 15 8.00002C15 8.37793 14.856 8.73876 14.5947 9.01612Z" fill="#657395"/>
                          <path d="M14.3133 7.89313C14.5086 8.0884 14.5086 8.40498 14.3133 8.60025C14.118 8.79552 13.8015 8.79552 13.6062 8.60025C13.4109 8.40498 13.4109 8.0884 13.6062 7.89313C13.8015 7.6979 14.118 7.6979 14.3133 7.89313Z" fill="#657395"/>
                          <path d="M2.9229 7.89313C3.11817 8.0884 3.11817 8.40498 2.9229 8.60025C2.72763 8.79552 2.41106 8.79552 2.21579 8.60025C2.02052 8.40498 2.02052 8.0884 2.21579 7.89313C2.41106 7.6979 2.72763 7.6979 2.9229 7.89313Z" fill="#657395"/>
                          </svg><span>'. get_field('property_number_of_rooms') .' izieb</span></p>'.
                        '</div>'.
                      '</div>'.
                    '</a>'.
                  '</div>';

                  if($count == 3) {
                    echo '<div class="single-catalog last-col" style="background-image: url('. $all_catalog_image .');">';

                    if( $all_catalog_link ):
                        echo '<a class="button" href="'. esc_url( $link_url ) .'" target="'. esc_attr( $link_target ) .'"><span>'. esc_html( $link_title ) .'</span><svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.62006 4.45337L13.6667 8.50004L9.62006 12.5467" stroke="#081228" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M2.33331 8.5H13.5533" stroke="#081228" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg></a>';
                    endif;
                    echo '</div>';
                  }
                  $count++;
              endforeach;
          echo '</div>';

          echo '<div class="mobile-button d-none d-767-block p-20">';
            if( $all_catalog_link ):
                echo '<a class="read-more cell-12" href="'. esc_url( $link_url ) .'" target="'. esc_attr( $link_target ) .'"><span>'. esc_html( $link_title ) .'</span><svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9.62006 4.45337L13.6667 8.50004L9.62006 12.5467" stroke="#081228" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M2.33331 8.5H13.5533" stroke="#081228" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg></a>';
            endif;
          echo '</div>'.
    '</div>';
  }

		 echo '</div>' .
	'</section>';
	endwhile; wp_reset_query();
}
?>
