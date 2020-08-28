
export default {
  init() {

    $(window).ready(function(){
      $('#magazine').turn({
          width: 1100,
          height: 600,
          autoCenter: true,
          display:'double',
          acceleration: true,
          elevation:50,
      });
    })

    $(window).bind('keydown',function(e){
      if (e.keyCode==37)
          $('#magazine').turn('previous');
      else if (e.keyCode==39)
          $('#magazine').turn('next');
    });

  },
  finalize() {

  },
};
