
export default {
  init() {

    $(window).load(function(){

    // init Isotope
    var $grid = $('.filterable-catalog').isotope({
    });

    $('.filters-button-group').on('click', 'button', function () {
      var filterValue = $(this).attr('data-filter');
      $grid.isotope({ filter: filterValue });
    });

  });

  },
  finalize() {
  },
};
