
import $ from 'jquery';

export default {
  init() {

    let htmlEl = '<div class="woocommerce-product-details__read-more">';
    htmlEl += '<i class="fa fa-plus-circle woocommerce-product-details__plus-icon" aria-hidden="true"></i></div>';

    const content = $('.woocommerce-product-details__full-content');

    content.find('> div').after(htmlEl);

    const readMore = $('.woocommerce-product-details__read-more');

    readMore.click(() => {
      content.toggleClass('opened');
    })

    function toolTipInit() {
      $(function () {
        $('[data-toggle="tooltip"]').tooltip();
      })
    }

    toolTipInit();

  },
  finalize() {

  },
};
