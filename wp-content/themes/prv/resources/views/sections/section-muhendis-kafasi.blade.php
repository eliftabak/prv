@php
$home = App::home_url_with_slash();
@endphp
<!-- muhendis-kafasi section start -->
<section class="muhendis-kafasi">
  <div class="muhendis-kafasi__background lazy w-100 h-100"
    data-src="{{$home}}wp-content/themes/prv/resources/assets/images/muhendis-kafasi-background.svg"></div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
      </div>
      <div class="col-lg-6">
        <div class="row">
          <div class="col-lg-12 pt-5 pb-5">
            <div class="muhendis-kafasi__book">
              @php
              do_action("section_muhendis_kafasi");
              @endphp
              <div class="muhendis-kafasi__book-name">Mühendis Kafası</div>
              <div class="muhendis-kafasi__book-category">Matematik</div>
              <div class="muhendis-kafasi__book-descp">Bir adım ileriyi hedefleyenler için Mühendis Kafasıyla Yeni Nesil
                Beceri Temelli Sorular</div>
              <div class="pt-5">
                <a name="" id="" class="muhendis-kafasi_book-button btn btn-primary btn-lg rounded-pill pr-5 pl-5"
                  href="#" role="button">DETAY</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- muhendis-kafasi section end -->
</section>
<!-- teke-tek section end -->
