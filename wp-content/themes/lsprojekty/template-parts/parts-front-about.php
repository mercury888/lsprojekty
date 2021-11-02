<?php
$AboutGroup = get_field('about_group');
$AboutTitle = $AboutGroup['about_title'];
$AboutContent = $AboutGroup['about_content'];

if( have_rows('about_group') ) {
	while ( have_rows('about_group') ) : the_row();
echo '<section class="section about-section section-padding">' .
        '<div class="wrapper d-flex justify-content-around">'.
              (
                  $AboutTitle
                  ? '<div class="cell-5">'.
                        '<h2>'. $AboutTitle . '</h2>'.
                    '</div>'
                  : ''
              ).
              (
                  $AboutContent
                  ? '<div class="cell-5">'.
                        $AboutContent .
                    '</div>'
                  : ''
              ).
        '</div>' .
'</section>';
endwhile; wp_reset_query();
}
?>
