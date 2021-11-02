<?php
function WelcomeDesc() {
  ob_start();
    $WelcomeGroup = get_field('welcome_group');
    $WelcomeImage = $WelcomeGroup['welcome_image'];
    $WelcomeContent = $WelcomeGroup['welcome_content'];
    $WelcomeButton = $WelcomeGroup['welcome_button'];
    if( !empty( $WelcomeButton ) ){
      	$WelcomeBtnTitle = $WelcomeButton['title'];
      	$WelcomeBtntUrl = $WelcomeButton['url'];
      	$WelcomeBtnTarget = $WelcomeButton['target'];
    }

echo '<div class="welcome-content d-flex justify-content-between align-items-center">' .
        '<div class="welcome-image position-relative cell-4 cell-767-12">'.
            '<div class="image-src">'.
                (
                    $WelcomeImage
                    ? wp_image($WelcomeImage)
                    : ''
                ) .
            '</div>'.
            (
              !empty( $WelcomeButton )
              ? '<div class="welcome-btn"><a class="read-more secondary hover-primary" href="' . $WelcomeBtntUrl . '" target="'. $WelcomeBtnTarget .'"> <span>' . $WelcomeBtnTitle . ' </span><svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M9.62003 4.45337L13.6667 8.50004L9.62003 12.5467" stroke="#081228" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M2.33333 8.5H13.5533" stroke="#081228" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg></a></div>'
              : ''
            ).
        '</div>'.
        '<div class="welcome-desc cell-6 cell-992-12 p-992-20 position-relative">'.
               (
                   $WelcomeContent
                   ? '<div class="cell-12 position-relative">'.
				   		             $WelcomeContent .
          					 '</div>'
                   : ''
               ).
        '</div>' .
'</div>';

 return ob_get_clean();
}

if( WelcomeDesc()):
echo '<section class="section welcome-section section-padding">' .
        '<div class="wrapper">'.
            WelcomeDesc().
        '</div>' .
'</section>';
endif;


?>
