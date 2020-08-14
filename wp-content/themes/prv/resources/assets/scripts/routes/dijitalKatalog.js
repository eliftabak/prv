import { modalVideo, viewPdf } from '../util/helpers';


export default {
  init() {


    $(window).load(function () {

      // init Isotope
      var $grid = $('.filterable-catalog').isotope({
      });

      $('.filters-button-group').on('click', 'button', function () {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue });
      });

      modalVideo({
        'modelID':'#Book-Video-Promotion',
        'playButtonClass':'.book-advertise__play-button',
        'videoID' : '#Book-Promotion-Video',
      });

      viewPdf({
        'modelID' : '#PDFModal',
        'pdfButtonClass' : '.pdf__view-button',
        'pdfiframe' : '.pdf-viewer__iframe',
      });

    });

  },
  finalize() {
  },
};
