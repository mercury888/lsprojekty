<?php
$TestimonialsGroup = get_field('testimonials_section');
$TestimonialsTitle = $TestimonialsGroup['testimonial_section_title'];
$TestimonialsContactContent = $TestimonialsGroup['testimonial_contact_content'];
$TestimonialPage = $TestimonialsGroup['testimonial_contact_btn'];
if( !empty( $TestimonialPage ) ){
	$testTitle = $TestimonialPage['title'];
	$testUrl = $TestimonialPage['url'];
	$testTarget = $TestimonialPage['target'];
}
global $quoteIcon;
if( have_rows('testimonials_section') ) {
	while ( have_rows('testimonials_section') ) : the_row();
	echo '<section class="section testimonials-section position-relative section-padding">' .
		'<div class="wrapper">'.
		'<div class="d-flex justify-content-between">' ;

    $posts = get_sub_field('select_testimonials');
    if( $posts ) {
    echo '<div class="testimonial-block position-relative p-15 cell-6 cell-992-12">'.
		'<div class="description p-35 bg-brand-secondary position-relative">'.
							 '<div class="testmonia-icon">'. $quoteIcon . '</div>'.
              (
                  $TestimonialsTitle
                  ? '<div class="testimonials-title">'.
                        '<h2 class="text-uppercase font-normal">'.$TestimonialsTitle.'</h2>'.
                     '</div>'
                  : ''
              ).
          '<div class="testimonials-slider d-flex justify-content-center position-relative">' .
            '<div class="slider-wrapper cell-12">';
            foreach($posts as $post):
              setup_postdata($post);
                echo '<div class="single-testimonial">' .
                  (
                    has_excerpt()
                    ? apply_filters( 'the_content', get_the_excerpt() )
                    : apply_filters( 'the_content', wp_trim_words( get_the_content(), 28 ) )
                  ) .
                  (
                    get_the_title()
                    ? '<h4 class="text-16 mb-0 font-bold">' . get_the_title() . '</h4>'
                    : ''
                  ) .
                '</div>';
            endforeach;
          echo '</div>' .
           '</div>'.
					 '</div>'.
    '</div>';
  }

      if($TestimonialsContactContent):
      echo '<div class="contact-block cell-6 cell-992-12 p-15">'.
			'<div class="inner-content p-50 bg-brand-primary d-flex align-items-center">'.
				'<div>'.
          $TestimonialsContactContent .
          (
               !empty( $TestimonialPage )
               ? '<a class="read-more secondary hover-white" href="' . $testUrl . '" target="'. $testTarget .'"> <span>' . $testTitle . ' </span><svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
 <path d="M9.62003 4.45337L13.6667 8.50004L9.62003 12.5467" stroke="#081228" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
 <path d="M2.33333 8.5H13.5533" stroke="#081228" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
 </svg></a>'
               : ''
           ).
					 '</div>'.
				'</div>'.
      '</div>';
    endif;
		 echo '</div>' .
		 '</div>' .
		'</section>';
	endwhile; wp_reset_query();
}
?>
