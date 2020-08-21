export default {
  init() {

    $(window).load(function () {

      const $alert = $('.alert.alert-warning');

      function hideAlert() {
        $alert.removeClass('alert-warning').addClass('alert-info').text('Lütfen başka bir kelime ile tekrar deneyin');
      }

      setTimeout(() => {
        hideAlert()
      },2000)

    });
  },
  finalize() {
    //
  },
};
