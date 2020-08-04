@php
$home = App::home_url_with_slash();
@endphp
<!-- benimsorumnet section start -->
<section class="benimsorumnet p-0">
  <div class="container-fluid">
    <div class="row bg-white">
      <div class="col-lg-6 p-0">
        <div id="benimsorumnet-slider" class="slider carousel  carousel-lazy slide carousel-fade" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#benimsorumnet-slider" data-slide-to="0" class="active"></li>
            <li data-target="#benimsorumnet-slider" data-slide-to="1"></li>
            <li data-target="#benimsorumnet-slider" data-slide-to="2"></li>
          </ol>
          <div class="slider__wrapper carousel-inner">
            <div class="slider__item carousel-item active">
              <img class="d-block w-100 "
                data-src="{{$home}}wp-content/themes/prv/resources/assets/images/benimsorum.net-slayt-1.jpg">
              <div class="carousel-caption d-none d-md-block">
                <h2 class="pb-5">Bizim Sorularımız .Net</h2>
              </div>
            </div>
            <div class="slider__item carousel-item">
              <img class="d-block w-100 "
                data-src="{{$home}}wp-content/themes/prv/resources/assets/images/benimsorum.net-slayt-2.jpg">
              <div class="carousel-caption d-none d-md-block">
                <h2 class="pb-5">Benim sorum da .Net Diyorsanız</h2>
              </div>
            </div>
            <div class="slider__item carousel-item">
              <img class="d-block w-100 "
                data-src="{{$home}}wp-content/themes/prv/resources/assets/images/benimsorum.net-slayt-3.jpg">
              <div class="carousel-caption d-none d-md-block">
                <h2 class="pb-5">Örnek Sorularınızı Bekliyoruz</h2>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#benimsorumnet-slider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#benimsorumnet-slider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-lg-6 vmx-auto p-5">
        <div class="content text-dark">
          <h1 class="text-primary">Değerli Öğretmenlerimiz,</h1>
          <p class="w-75">Yeni Nesil soruları seviyor, yazıyor ve siz de BenimSorum.Net diyorsanız hemen tıklayın ve
            örnek sorularınızı gönderin.</p>
          <a id="benimsorum" class="btn btn-primary p-3 pl-5 pr-5 mt-3 rounded-pill" href="http://www.benimsorum.net"
            target="_blank" role="button">BenimSorum.Net</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- benimsorumnet section end -->
