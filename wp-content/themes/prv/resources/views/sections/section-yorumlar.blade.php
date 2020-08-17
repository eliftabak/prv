<!-- yorumlar section start -->
<section class="yorumlar pt-5">
  <div class="container-fluid">
    <div class="row mx-auto">
      <div class="col-lg-12">
        <div class="d-flex justify-content-center">
          <h1 class="yorumlar__title">Öğrenci Görüşleri</h1>
        </div>
      </div>
      <div class="col-sm-8 col-lg-12 mx-auto">
        <div class="row">
          <div class="col-lg-2"></div>
          <div class="col-lg-8">
            <div class="d-flex justify-content-center align-items-center flex-column">
              @php
              do_action("section_yorumlar");
              @endphp
            </div>
          </div>
          <div class="col-lg-2"></div>
        </div>
      </div>
      <div class="col-sm-8 col-lg-12 mx-auto pt-5">
        <div class="row">
          <div class="col-lg-3"></div>
          <div class="col-lg-6"><img class="lazy w-100"
              data-src=" wp-content/themes/prv/resources/assets/images/yourmlar-picture.svg" alt=""
              class="yorumlar__picture w-100"></div>
          <div class="col-lg-3"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- yorumlar section end -->
