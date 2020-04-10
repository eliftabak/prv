import $ from 'jquery';

export default {
  init() {
    $(window).on('scroll', function () {
      if ( $(window).scrollTop() > 10 ) {
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

      const timeOut  = 100;

      function toggleDropdown (e) {
        const _d = $(e.target).closest('.dropdown'),
          _m = $('> .dropdown-menu', _d);
        setTimeout(function(){
          const shouldOpen = e.type !== 'click' && _d.is(':hover');
          _m.toggleClass('show', shouldOpen);
          _d.toggleClass('show', shouldOpen);
          $('[data-toggle="dropdown"]', _d).attr('aria-expanded', shouldOpen);
        }, e.type === 'mouseleave' ? timeOut : 0);
      }

      function toggleDark (e){
        const _d = $(e.target).closest('.dropdown'),
             _c = $('> .cart__dropdown-menu', _d),
             _b =$('body');
        setTimeout(function(){
          const cartOpen = e.type !== 'click' && _c.is(':hover') || _d.is(':hover');
              _b.toggleClass('dark', cartOpen);
        }, e.type === 'mouseleave' ? timeOut : 0);

      }

      $('body')
        .on('mouseenter mouseleave','.dropdown',(e)=>{
          toggleDropdown(e);
          toggleDark(e);
        })
        .on('click', '.dropdown-menu a', toggleDropdown);


  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
