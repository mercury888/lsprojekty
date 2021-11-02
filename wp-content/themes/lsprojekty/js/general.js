$headerHeight = '';
$headerHeightscroll = '';

jQuery(document).ready(function($) {
        $(".navbar-toggle").click(function() {
            if ($(this).hasClass("active")) {
                $(this).removeClass("active");
                $('.mobile_menu').animate({
                    'right': '-100%'
                }, 500);
            } else {
                $(this).addClass("active");
                $('.mobile_menu').animate({
                    'right': '0'
                }, 500);
            }
        });
        $(".mobile_menu ul li").find("ul").parents("li").prepend("<span></span>");
        $(".mobile_menu ul li ul").addClass("first-sub");
        $(".mobile_menu ul li ul").prev().prev("span").addClass("first-em");
        $(".mobile_menu ul li ul ul").removeClass("first-sub");
        $(".mobile_menu ul li ul ul").addClass("second-sub");
        $(".mobile_menu ul li ul ul").prev().prev("span").addClass("second-em");
        $(".mobile_menu ul li ul ul").prev().prev("span").removeClass("first-em");
        $(".mobile_menu ul li span.first-em").click(function(e) {
            $(".mobile_menu ul li span.first-em").removeClass('active');
            $(".mobile_menu ul li span.second-em").removeClass('active');
            if ($(this).parent("li").hasClass("active")) {
                $(this).parent("li").removeClass("active");
                $(this).next().next("ul.first-sub").slideUp();
                $(".mobile_menu ul li ul.second-sub li").removeClass("active");
                $(".mobile_menu ul li ul.second-sub").slideUp();
            } else {
                $(this).addClass('active');
                $(".mobile_menu ul li").removeClass("active");
                $(this).parent("li").addClass("active");
                $(".mobile_menu ul li ul.first-sub").slideUp();
                $(this).next().next("ul.first-sub").slideDown();
                $(".mobile_menu ul li ul.second-sub li").removeClass("active");
                $(".mobile_menu ul li ul.second-sub").slideUp();
            }
        });
        $(".mobile_menu ul li ul.first-sub li span.second-em").click(function(e) {
            $(".mobile_menu ul li span.second-em").removeClass('active');
            if ($(this).parent("li").hasClass("active")) {
                $(this).parent("li").removeClass("active");
                $(this).next().next("ul.second-sub").slideUp();
            } else {
                $(this).addClass('active');
                $(".mobile_menu ul li ul li").removeClass("active");
                $(this).parent("li").addClass("active");
                $(".mobile_menu ul li ul.second-sub").slideUp();
                $(this).next().next("ul.second-sub").slideDown();
            }
        });
        $(".close-btn").click(function() {
            $('.mobile_menu').animate({
                'right': '-100%'
            }, 500);
            $(" .navbar-toggle").removeClass("active");
        });

        $('.testimonials-section .slider-wrapper').slick({
            dots: true,
            arrows: false,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear'
        });

        // Banner Slider Js
        $('.banner .home-slider').slick({
            dots: true,
            autoplay: true,
            adaptiveHeight: true,
            autoplaySpeed: 3000,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            arrows: true,
            nextArrow: '<span class="slick-next"> Ďalšie </span>',
            prevArrow: '<span class="slick-prev"> Minulý </span>',
        });

        // scroll top js
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('#scroll').fadeIn();
            } else {
                $('#scroll').fadeOut();
            }
        });
        $('#scroll').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });

        // Banner Slider
        $('.banner-images-slider').slick({
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            autoplay: true,
            nextArrow: '<span class="slick-next"> &#10095; </span>',
            prevArrow: '<span class="slick-prev"> &#10094; </span>',
        });

        // Images Slider
        $('.images-slider').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            autoplay: true,
            nextArrow: '<span class="slick-next"> &#10095; </span>',
            prevArrow: '<span class="slick-prev"> &#10094; </span>',
            responsive: [
              {
                breakpoint: 992,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 1
                }
              },
              {
                breakpoint: 640,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 1
                }
              },
              {
                breakpoint: 480,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1
                }
              }
            ]
        });

    // Affiliates
    // $('.affiliates-section ul').slick({
    //     infinite: true,
    //     slidesToShow: 4,
    //     slidesToScroll: 1,
    //     dots: false,
    //     arrows: false,
    //     autoplay: true,
    //     responsive: [
    //       {
    //           breakpoint: 992,
    //           settings: {
    //               slidesToShow: 3,
    //               slidesToScroll: 1,
    //               dots: true,
    //         }
    //       },
    //       {
    //           breakpoint: 767,
    //           settings: {
    //               slidesToShow: 2,
    //               slidesToScroll: 1,
    //               dots: true,
    //         }
    //       },
    //       {
    //           breakpoint: 480,
    //           settings: {
    //               slidesToShow: 1,
    //               slidesToScroll: 1,
    //               dots: true,
    //         }
    //       }
    //     ]
    // });

    // $(".dropdown-content").multipleSelectBox();

    /*$('#rooms').multiselect({
      columns: 1,
      placeholder: 'Select rooms',
      selectedOptions: 'in',
      maxPlaceholderOpts: '2',
    });*/


    $('#rooms').select2({
        placeholder: { text: 'Počet izieb' },
        closeOnSelect: false,
        allowClear: true,
    });$('#area').select2({
      placeholder: { text: 'Úžitková plocha' },
      closeOnSelect: false,
    });$('#floors').select2({
      placeholder: { text: 'Poschodia' },
      closeOnSelect: false,
    });   

    // $('#rooms').select2('open');
    $('.select2-results__option--selectable').attr('aria-selected', false);
    $('select').on('select2:open', function() {
       $('.select2-results__option--selectable').attr('aria-selected', false);
   });


    $(document).on('change', '#rooms,#area,#floors', function() {

        var uldiv = $(this).next('span.select2').find('ul');
        var count = $(this).select2('data').length

        if(count==0){ uldiv.html("") }
        else {
          $('#rooms span.select2 ul li,#area span.select2 ul li,#floors span.select2 ul li').remove();

          uldiv.html("<li>0" + count + "</li>");
        }
    });

});


// jQuery( window ).load(function() {
//   var uldiv = $('#rooms,#area,#floors').next('span.select2').find('ul');
//   var count = $('#rooms,#area,#floors').select2('data').length
//   if(count==0){ uldiv.html("<li>00</li>") }
// });


jQuery(window).on('load resize ready', function($) {

    // setTimeout(function(){
    //     $headerHeight = jQuery('header').outerHeight();
    //     jQuery('#wrapper').css('padding-top', $headerHeight);
    // },500);
    if( jQuery(window).scrollTop() > 50 ){
        setTimeout(function(){
            stickyHeader();
        },500);
    }
});

jQuery(window).scroll(function(event) {
    stickyHeader();
});

/* sticky header script */
function stickyHeader() {
    var sticky = jQuery('header'),
        scroll = jQuery(window).scrollTop();

    if (scroll >= 50) {
        sticky.addClass('sticky');
        $headerHeightscroll = jQuery('header.sticky').outerHeight();
    } else sticky.removeClass('sticky');
}

jQuery('.dalsi-btn').click(function() {
    jQuery('.home-slider').slickNext();
});

jQuery('.for-mobile-filter').click(function() {
    jQuery('.my-ajax-filter-search-cus').addClass('open-sidefilter');
    jQuery('.dropdown .select2-container').addClass('select2-container--focus select2-container--open');
});
jQuery('.close-mobilefilter').click(function() {
    jQuery('.my-ajax-filter-search-cus').removeClass('open-sidefilter');
});

if(jQuery(window).width() <= 767){
  jQuery('.catalog-section .grid-wrapper').slick({
    centerMode: true,
    centerPadding: '60px',
    arrows: false,
    dots: true,
    slidesToShow: 1
  });
}
