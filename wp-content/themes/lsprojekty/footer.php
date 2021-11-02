<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?>

</div><!-- #content -->
</div><!-- #page -->
<?php
echo '<footer class="site-footer cell-12 position-relative text-767-center '. (!is_front_page() ? 'bg-color' : '') .'">'.
        '<div class="wrapper">'.
          '<div class="copyright d-flex justify-content-between align-items-center">'.
              brand_logo() .
    					'<div class="footer-menu">'.
                  do_shortcode('[footer-navigation]') .
              '</div>'.
              (
    						get_field('footer_logo', 'options')
    						? get_field('footer_logo', 'options')
    						: ''
    					) .
          '</div>'.
      '</div>'.
'</footer>';
 ?>

</footer><!-- #colophon -->

<?php
wp_footer();
?>
</body>
</html>
