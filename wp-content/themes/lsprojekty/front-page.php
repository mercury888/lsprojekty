<?php
/*
Template Name: Front Page
*/
/** header */
get_header();

// /** banner */
get_template_part( 'template-parts/parts-front', 'banner' );
get_template_part( 'template-parts/parts-front', 'welcome' );
get_template_part( 'template-parts/parts-front', 'info' );
get_template_part( 'template-parts/parts-front', 'about' );
get_template_part( 'template-parts/parts-front', 'services' );
get_template_part( 'template-parts/parts-front', 'listing' );
get_template_part( 'template-parts/parts-front', 'catalog' );
get_template_part( 'template-parts/parts-front', 'testimonial' );

// /** footer */
get_footer();

?>
