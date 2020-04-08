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


      //Bootstrap Sub Dropdown Show Helper
      $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        e.preventDefault();
        if (!$(this).next().hasClass('show')) {
          $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
        }
        var $subMenu = $(this).next('.dropdown-menu');
        $subMenu.toggleClass('show');

        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
          e.preventDefault();
          $('.dropdown-submenu .show').removeClass('show');
        });
        return false;
      });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
