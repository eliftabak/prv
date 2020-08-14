import $ from 'jquery';
import { modalVideo } from '../util/helpers';

export default {
  init() {


    function toolTipInit() {
      $(function () {
        $('[data-toggle="tooltip"]').tooltip();
      })
    }

    $(document).ready(function () {

      modalVideo({
        'modelID': '#SKModal',
        'playButtonClass': '.neden-sorular-konusuyor__play',
        'videoID': '#video',
      });

      toolTipInit();

    });
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};



