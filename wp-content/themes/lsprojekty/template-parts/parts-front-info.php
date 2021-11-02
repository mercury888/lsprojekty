<?php
$InfoGroup = get_field('info_group', 'options');
$InfoContent = $InfoGroup['info_content'];
$info_phone = $InfoGroup['info_phone'];
$info_email =  $InfoGroup['info_email'];
global $bigPhone;
global $bigMail;

if( have_rows('info_group', 'options') ) {
	while ( have_rows('info_group', 'options') ) : the_row();
echo '<section class="section info-section section-padding overflow-hidden">' .
        '<div class="wrapper bg-brand-primary d-flex justify-content-between align-items-center">'.
              '<div class="cell-5">'.
                  $InfoContent .
              '</div>'.
              '<div class="cell-7 info-contact">';
              if( !empty( $info_phone ) ){
                  $InfoPhoneTitle = $info_phone['title'];
                  $InfoPhonetUrl = $info_phone['url'];
                  echo '<a href="tel:'. $InfoPhonetUrl .'">'.
						'<span class="phone-icon icon">'. $bigPhone . '</span>'.
						'<span class="info-text">'. $InfoPhoneTitle . '</span>'.
				'</a>';
              }
              if( !empty( $info_email ) ){
                  $InfoEmailTitle = $info_email['title'];
                  $InfoEmailtUrl = $info_email['url'];
                  echo '<a href="mailto:'. $InfoEmailtUrl .'">'.
					'<span class="mail-icon icon">'. $bigMail . '</span>'.
					'<span class="info-text">'. $InfoEmailTitle . '</span>'.
				'</a>';
              }
              echo '</div>'.
        '</div>' .
'</section>';
endwhile; wp_reset_query();
}
?>
