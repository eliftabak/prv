(function ($,window) {

  $(document).ready(function () {

    const WPMU_PLUGIN_URL = php_vars.WPMU_PLUGIN_URL;
    const DISTRICT_URL = php_vars.district_path;
    const MAPS = WPMU_PLUGIN_URL + "/selling-points/vendor/svg-map/maps/"
    const DATA = php_vars.data;
    const MAP_NAME = "turkiye";
    const $mapWrapper = $("#bayi-map");
    const $mapContainer = $(".bayi-container");
    const $pictures = $('.bayi-pictures');
    const $bayiinfo = $('.bayi-info');


    function hideContent(){
      $pictures.css("display","none");
      $bayiinfo.css("display","none");
    }


    function resetMap() {
      $mapWrapper.empty();
      $mapWrapper.removeClass("pt-lg-0");
      $mapWrapper.addClass("pt-lg-5");
      $mapContainer.removeClass("col-lg-6");
      $mapContainer.addClass("col-lg-12");
    }

    function districtLogic(){

      const districts = document.querySelectorAll('.district');

      districts.forEach(element => {

        element.addEventListener(
          'click',
          function(event){
          const data_city_name = event.target.parentNode.getAttribute('data-iladi');
          const data_city_ilid = event.target.parentNode.getAttribute('data-ilid');
          const district_name = data_city_name.toLocaleUpperCase("TR");
          const district_ilid =Number(data_city_ilid);

          const getDistrictInfo  = $.ajax({
            url:DISTRICT_URL+ `?name="${district_name}"&city=${district_ilid}`,
            type: 'GET',
            success: function (result) {
              return result;
            }
          });

          getDistrictInfo.then(function(response){


           let result;

            const district_id = response[0].district_id;
            const city_id = response[0].city_id;

            DATA.forEach(element => {

              const element_city_id = element.city[0]
              const element_district_id = element.district[0]

              if(district_id === element_district_id && element_city_id === city_id ){

                result = element;
              }

            });

            return result;

          }).then(function(data){

            const images = Object.values(data.pictures);
            drawDealerInfo($bayiinfo,data);
            drawGallery($pictures,images);

          })

          }
        );

      });

    }


    function mapLogic() {
      const body = document.querySelector('#svg-turkiye-haritasi');
      const container = document.querySelector('.container.container__page-content');
      const windowdWith = window.innerWidth;
      const element = document.querySelector('#svg-turkiye-haritasi');
      const info = document.querySelector('.il-isimleri');
      let scroolTop = window.scrollY;

      element.addEventListener(
        'mouseover',
        function (event) {
          if (event.target.tagName === 'path' && event.target.parentNode.id !== 'guney-kibris') {
            info.innerHTML = [
              '<div>',
              event.target.parentNode.getAttribute('data-iladi'),
              '</div>'
            ].join('');
          }
        }
      );

      window.addEventListener("scroll", function(){
        scroolTop = window.scrollY;
      });

      body.addEventListener(
        'mousemove',
        function (event) {
          const containerLeftWidth = (windowdWith - container.clientWidth) / 2;
          info.style.top = event.clientY + 15 - 300 + scroolTop + 'px';
          info.style.left = event.clientX - containerLeftWidth+'px';
        }
      );

      element.addEventListener(
        'mouseout',
        function (event) {
          info.innerHTML = '';
        }
      );

         //element.addEventListener(
      //  'click',
      //  function (event) {
      //    if (event.target.tagName === 'path') {
      //      const parent = event.target.parentNode;
      //      const id = parent.getAttribute('id');
      //
      //      if (
      //        id === 'guney-kibris'
      //      ) {
      //        return;
      //      }
      //
      //      window.location.href = (
      //        '#'
      //        + id
      //        + '-'
      //        + parent.getAttribute('data-plakakodu')
      //      );
      //    }
      //  }
      //);
    }

    function cityLogic() {
      $(".city").click(function () {
        const cityname = $(this).data("iladi");
        const cityId = $(this).attr("id");
        const $cityWrapper = $(`#${cityId}`);
        $.ajax({
          url: MAPS + cityId + ".html",
          type: 'GET',
          success: function (mapHtml) {
            //alert(mapHtml)
            $mapWrapper.empty()
            $mapWrapper.append(mapHtml);
            $mapWrapper.removeClass("pt-lg-5");
            $mapWrapper.addClass("pt-lg-0");
            $mapContainer.removeClass("col-lg-12");
            $mapContainer.addClass("col-lg-6");
            mapLogic();
            districtLogic();
          }
        });
      })
    }

    function init(){
      return $.ajax({
        url: MAPS + MAP_NAME + ".html",
        type: 'GET',
        success: function (mapHtml) {
          $mapWrapper.append(mapHtml);
          mapLogic();
          cityLogic();
        }
      })
    }

    window.showMap=()=>{
      resetMap();
      hideContent();
      init();
    }

    init();

  });

})(jQuery,window);
