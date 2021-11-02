jQuery(document).ready(function($) {
    if ($('.run-slider').length > 0) {
        if ($('.home__single--slide').length > 1) {
            /** slick slider on initialized event */
            $('.home-slider').on('init', function(event, slick) {
                $('.slick-current ').find('.home__single--slide-content').addClass(' show ');
            });

            /** slick slider on initialized event */
            $('.home-slider').slick({
                arrows: false,
                dots: true,
                autoplay: true,
                adaptiveHeight: true,
                autoplaySpeed: 3000,
            });

            /** slick slider on before change event */
            jQuery('.home-slider').on('beforeChange', function(slick, slide, current) {
                $('.slick-slide ').find('.home__single--slide-content').removeClass(' show ');
                $('.slick-slide ').find('.home__single--slide-content').addClass(' hide ');
            });

            /** slick slider on after change event */
            jQuery('.home-slider').on('afterChange', function(slick, slide, current) {
                $('.slick-current ').find('.home__single--slide-content').addClass(' show ');
            });
        } else {
            setTimeout(function() {
                $('.home-slider').find('.home__single--slide-content').addClass(' show ');
            }, 1000);
        }
    } else {
        if ($('.home-slider').find('.home__single--slide-content').hasClass('mobile-show')) {
            setTimeout(function() {
                $('.home-slider').find('.home__single--slide-content').addClass(' show ');
            }, 1000);
        }
    }
});
