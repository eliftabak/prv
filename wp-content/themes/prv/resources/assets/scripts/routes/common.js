import $ from 'jquery';

export default {
  init() {

    $(function () {
      $('.lazy').lazy({
        effect: 'fadeIn',
          effectTime: 1500,
          threshold: 0,
      });

    });

    $(window).on('scroll', function () {
      if ($(window).scrollTop() > 10) {
        $('.navbar').addClass('active');
      } else {
        $('.navbar').removeClass('active');
      }
    });

    $(window).scroll(function () {
      if ($(window).scrollTop() > 50) {
        $('#back-to-top').fadeIn();
      } else {
        $('#back-to-top').fadeOut();
      }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function () {
      $('body,html').animate({
        scrollTop: 0,
      }, 1000);
      return false;
    });





    //Bootstrap Menu Dropdown Open Closing Logic

    const timeOut = 100;

    function toggleDropdown(e) {
      const _d = $(e.target).closest('.dropdown'),
        _m = $('> .dropdown-menu', _d);
      setTimeout(function () {
        const shouldOpen = e.type !== 'click' && _d.is(':hover');
        _m.toggleClass('show', shouldOpen);
        _d.toggleClass('show', shouldOpen);
        $('[data-toggle="dropdown"]', _d).attr('aria-expanded', shouldOpen);
      }, e.type === 'mouseleave' ? timeOut : 0);
    }

    function toggleDark(e) {
      const _d = $(e.target).closest('.dropdown'),
        _c = $('> .cart__dropdown-menu', _d),
        _b = $('body');
      setTimeout(function () {
        const cartOpen = e.type !== 'click' && _c.is(':hover') || _d.is(':hover');
        _b.toggleClass('dark', cartOpen);
      }, e.type === 'mouseleave' ? timeOut : 0);

    }

    $('body')
      .on('mouseenter mouseleave', '.dropdown', (e) => {
        toggleDropdown(e);
        toggleDark(e);
      })
      .on('click', '.dropdown-menu a', toggleDropdown);




    // Slider action logic
    $('#home-page-slider').on('slid.bs.carousel', function (e) {

      const slideToIndex = e.to;
      const slideFromIndex = e.from;

      const nextCarouselItem = $(this).find(`.carousel-item:nth-child(${slideToIndex + 1})`);
      const previousCarouselItem = $(this).find(`.carousel-item:nth-child(${slideFromIndex + 1})`);

      const nextLeftImage = $('.home-slider__left-image', nextCarouselItem);
      const previousLeftImage = $('.home-slider__left-image', previousCarouselItem);
      const nextImage = $('.home-slider__child-draw', nextCarouselItem);
      const previousImage = $('.home-slider__child-draw', previousCarouselItem);
      const nextTextBlock = $('.home-slider__right-text-block', nextCarouselItem);
      const previousTextBlock = $('.home-slider__right-text-block', previousCarouselItem);


      nextLeftImage.toggleClass('show');
      previousLeftImage.toggleClass('show');
      nextImage.toggleClass('show');
      previousImage.toggleClass('show');
      nextTextBlock.toggleClass('show');
      previousTextBlock.toggleClass('show');

    });

     // Slider lazy load logic
    $(function() {
      const lazyEls = $('.carousel.carousel-lazy .active').find('img[data-src]');7


      lazyEls.each(function(){
          $(this).attr('src',  $(this).data('src'));
          $(this).removeAttr('data-src');
        })
    });

     // Slider lazy load logic
    $(function() {
      return $('.carousel.carousel-lazy').on('slid.bs.carousel', function(e) {
        const lazyEls = $(e.relatedTarget).find('img[data-src]');
        lazyEls.each(function(){
          $(this).attr('src',  $(this).data('src'));
          $(this).removeAttr('data-src');
        })
      });
    });

    const $cart = $('#Cart');
    if (window.matchMedia('(max-width: 768px)').matches) {
      $cart.clone().appendTo('body').addClass('cart-mobile');
      $cart.remove();
    }

  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
