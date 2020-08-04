@php
$home = App::home_url_with_slash();
@endphp

<!-- brans-denemeleri section start -->
<section class="brans-denemeleri p-0 lazy"
  data-src="{{$home}}wp-content/themes/prv/resources/assets/images/section-3-background.svg">
  <div class="container-fluid">
    <div class="row pt-lg-5">
      <div class="col-lg-12">
        <div class="text-center">
          <h1 class="brans-denemeleri__title p-lg-5 p-3">8. Sınıf Branş Denemeleri</h1>
          <p class="brans-denemeleri__desc">Gerçek bir sınav deneyimi yaşamak için LGS'ye Sınav Modu Serisi ile
            hazırlan!
          </p>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="row p-lg-5">
          @php
          do_action("section_brans_denemeleri");
          @endphp
        </div>
      </div>
    </div>
  </div>
</section>
<!-- brans-denemeleri section end -->
