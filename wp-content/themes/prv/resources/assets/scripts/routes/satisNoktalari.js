/* eslint-disable no-unused-vars */
/* eslint-disable no-undef */

export default {
  init() {

    $(document).ready(function () {

      var locations = [
        ['Sidney Bayi', -33.890542, 151.274856,
          ['https://image.shutterstock.com/image-photo/white-transparent-leaf-on-mirror-260nw-1029171697.jpg',
            'https://miro.medium.com/max/1200/1*mk1-6aYaf_Bes1E3Imhc0A.jpeg',
            'https://www.w3schools.com/w3images/lights.jpg',
            'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg',
            'https://miro.medium.com/max/1200/1*mk1-6aYaf_Bes1E3Imhc0A.jpeg',
            'https://www.w3schools.com/w3images/lights.jpg',
          ],
        ],
        ['Sidney Bayi', -33.923036, 151.259052,
          [
            'https://www.w3schools.com/w3images/lights.jpg',
            'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg',
            'https://miro.medium.com/max/1200/1*mk1-6aYaf_Bes1E3Imhc0A.jpeg',
            'https://www.w3schools.com/w3images/lights.jpg',
            'https://miro.medium.com/max/1200/1*mk1-6aYaf_Bes1E3Imhc0A.jpeg',
            'https://www.w3schools.com/w3images/lights.jpg',
            'https://www.w3schools.com/w3images/lights.jpg',
            'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__340.jpg',
          ],
        ],
      ];

      var map = new google.maps.Map(document.getElementById('bayi-map'), {
        zoom: 10,
        center: new google.maps.LatLng(-33.92, 151.25),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
      });

      var infowindow = new google.maps.InfoWindow();

      const sliderGenerator = (images) => `<h2>Bayi Resimleri</h2>
      <div class="container-fluid shadow-sm p-4">
        <div id="bayiCarousel" class="carousel slide w-100 multiple-carousel" data-ride="carousel" data-interval="false">
          <div class="carousel-inner w-100" role="listbox">
          ${images}
          </div>
          <a class="carousel-control-prev w-auto text-primary" href="#bayiCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true">
              <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
            </span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next  w-auto text-primary" href="#bayiCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fa fa-long-arrow-right"
                aria-hidden="true"></i>
            </span>

            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>`

      const initCorousel = () => {
        $('#bayiCarousel').carousel({
          interval: 4000,
        })

        $('.multiple-carousel .carousel-item').each(function () {
          var minPerSlide = 4;
          var next = $(this).next();
          if (!next.length) {
            next = $(this).siblings(':first');
          }
          next.children(':first-child').clone().appendTo($(this));

          for (var i = 0; i < minPerSlide; i++) {
            next = next.next();
            if (!next.length) {
              next = $(this).siblings(':first');
            }

            next.children(':first-child').clone().appendTo($(this));
          }
        });
      }

      var $pictures = $('.bayi-pictures');

      const drawImageSlider = (images) => {
        $pictures.empty();
        images = images.map((image, index) => {
          const active = index === 0 ? 'active':'';
          const result = `
          <div class="carousel-item ${active}">
            <div class="col-lg-3 col-md-6">
              <img src="${image}" width="200" height="auto">
            </div>
          </div>`
          return result;
        });
        images = images.join('');
        images = sliderGenerator(images);
        $pictures.append(images);
        initCorousel();
      }


      var marker, i;

      for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(locations[i][1], locations[i][2]),
          map: map,
        });

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
          return function () {
            infowindow.setContent(locations[i][0]);
            infowindow.open(map, marker);
            drawImageSlider(locations[i][3]);
          }
        })(marker, i));
      }

    });

  },
  finalize() {

  },
};
