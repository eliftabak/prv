export default {
  init() {

    function sorularKonusuyorModalVideo(){
      const modelID = '#SKModal';
      const playButtonClass = '.neden-sorular-konusuyor__play';
      const videoID = '#video';
      let videoSource='';

       $(playButtonClass).click(function() {
           videoSource = $(this).data( 'src' );
       });
       //console.log(videoSource);
       // when the modal is opened autoplay it

       $(modelID).on('shown.bs.modal', function () {
       // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
       $(videoID).attr('src',videoSource + '?autoplay=1&amp;modestbranding=1&amp;showinfo=0' );
       })

       // stop playing the youtube video when I close the modal
       $(modelID).on('hide.bs.modal', function () {
           // a poor man's stop video
           $(videoID).attr('src',videoSource);
       })

    }

    function toolTipInit(){
      $(function () {
        $('[data-toggle="tooltip"]').tooltip();
      })
    }

    $(document).ready(function() {

      sorularKonusuyorModalVideo();
      toolTipInit();


      });
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
