export default {
  init() {
    $(window).on('scroll', function () {
      if ( $(window).scrollTop() > 10 ) {
          $('.navbar').addClass('active');
      } else {
          $('.navbar').removeClass('active');
      }
  });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
