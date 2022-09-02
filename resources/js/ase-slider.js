import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';

(function($) {
    const ASESlider = function( $scope, $ ) {
      if ( 'undefined' == typeof $scope ) {
        return;
      }
      
      const aseSliderCarousel  = $('.ase-slider-container');
      const isPro = !!window.aseSwiperVar.has_pro;
      
      aseSliderCarousel.each(function() {
        const sectionId = '#' + $(this).attr('id');
        new Swiper(sectionId, {
          autoplay: isPro ? $(sectionId).data('autoplay') : false,
          loop: isPro ? $(sectionId).data('loop') : false,
          effect: isPro ? $(sectionId).data('transition') : 'slide',
          speed: isPro ? $(sectionId).data('slider-speed') : 3000,
          animationDuration: isPro ? $(sectionId).data('content-animation') : 'fadeInRight',
          autoHeight: true,
          spaceBetween: 30,
          pagination: {
            el: $(sectionId).data('pagination'),
            clickable: true
          },
          navigation: {
            nextEl: $(sectionId).data('button-next'),
            prevEl: $(sectionId).data('button-prev')
          }
        });
      });
    }
   
    $( window ).on( 'elementor/frontend/init', function () {
      elementorFrontend.hooks.addAction( 'frontend/element_ready/ase-slider.default', ASESlider );
    });
  
})( jQuery );
  