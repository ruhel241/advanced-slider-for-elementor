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
          autoHeight: isPro ? $(sectionId).data('auto-height') : false,
          effect: isPro ? $(sectionId).data('transition') : 'slide',  
          fadeEffect: isPro && $(sectionId).data('transition') == 'fade'  ? { crossFade: true } : { crossFade: false },
          speed: isPro ? $(sectionId).data('slider-speed') : 3000,
          spaceBetween: isPro ? $(sectionId).data('space-between') : 30,
          mousewheel: isPro ? $(sectionId).data('mousewheel') : false,
          keyboard: isPro ? $(sectionId).data('keyboard') : false,
          direction: isPro ? $(sectionId).data('direction') : 'horizontal',
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
  