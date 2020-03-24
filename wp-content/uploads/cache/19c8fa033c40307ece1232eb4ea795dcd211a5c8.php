<?php $__env->startSection('content'); ?>
<?php while(have_posts()): ?> <?php the_post() ?>
<?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('partials.content-page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<!-- section-1__wrapper start -->
<section class="section-1__wrapper p-0 home-slider">
  <div class="container-fluid p-0">
    <div id="home-page-slider" class="carousel slide h-100" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#home-page-slider" data-slide-to="0" class="active"></li>
        <li data-target="#home-page-slider" data-slide-to="1"></li>
        <li data-target="#home-page-slider" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner h-100" role="listbox">
        <div class="carousel-item active h-100">
          <div class="home-slider__slider-item h-100 bg-primary">
            <img class="p-0 position-absolute green-background" style="z-index:2"
              src="wp-content/themes/prv/resources/assets/images/green.svg">
            <img class="p-0 position-absolute home-slider__child-draw" style="z-index:3"
              src="wp-content/themes/prv/resources/assets/images/child.svg">
            <div class="position-relative" style="z-index:3">
              <div class="pt-5 text-white text-right pr-5">
                <div class="pt-5 mt-5">
                  <h1 class="home-slider__text-1 pt-5">Siz hiç konuşan soru bankası</h1>
                  <p class="home-slider__text-2">Gördünüz mü ?</p>
                  <p class="home-slider__text-3">yeni sisteme hazır olun!</p>
                </div>
                <div class="home-slider__desc text-right w-50 ml-auto ml">
                  <div class="py-3">
                    <p class="lead">Lorem ipsum dolor sit amet, <strong class="font-weight-bold">consectetur adipisicing
                      </strong>elit. Explicabo consectetur odio voluptatum facere animi temporibus, distinctio tempore
                      enim
                      corporis quam <strong class="font-weight-bold">recusandae </strong>placeat! Voluptatum voluptate,
                      ex
                      modi illum quas nam distinctio.</p>
                  </div>
                </div>
                <button class="btn btn-purple btn-lg pl-5 pr-5 ">DETAY</button>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item h-100">
          <div class="home-slider__slider-item h-100 bg-secondary">
            <img class="p-0 position-absolute green-background" style="z-index:2"
              src="wp-content/themes/prv/resources/assets/images/green.svg">
            <img class="p-0 position-absolute home-slider__child-draw" style="z-index:3"
              src="wp-content/themes/prv/resources/assets/images/target.svg">
            <div class="position-relative" style="z-index:3">
              <div class="pt-5 text-white text-right pr-5">
                <div class="pt-5 mt-5">
                  <h1 class="home-slider__text-1 pt-5">Teke Tek Soru Bankarımız Çıktı</h1>
                  <p class="home-slider__text-2">İncelediniz mi ?</p>
                  <p class="home-slider__text-3">yeni sınav sistemine hazır olun!</p>
                </div>
                <div class="home-slider__desc text-right w-50 ml-auto ml">
                  <div class="py-3">
                    <p class="lead">Lorem ipsum dolor sit amet, <strong class="font-weight-bold">consectetur adipisicing
                      </strong>elit. Explicabo consectetur odio voluptatum facere animi temporibus, distinctio tempore
                      enim
                      corporis quam <strong class="font-weight-bold">recusandae </strong>placeat! Voluptatum voluptate,
                      ex
                      modi illum quas nam distinctio.</p>
                  </div>
                </div>
                <button class="btn btn-purple btn-lg pl-5 pr-5 ">DETAY</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#home-page-slider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fa fa-long-arrow-left"
            aria-hidden="true"></i></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#home-page-slider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"><i class="fa fa-long-arrow-right"
            aria-hidden="true"></i></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

  </div>
</section>
<!-- section-1__wrapper end -->


<!-- section-2__wrapper start -->
<section class="section-2__wrapper p-0 sorular-konusuyor">
  <div class="container-fluid">
    <div class="row p-5">
      <div class="col-lg-5 vmx-auto">
        <div class="">
          <h1 class="sorular-konusuyor__title">Ortaokula Yardımcı Kitaplar</h1>
          <p class="sorular-konusuyor__desc">When it comes to software design, animation is alimitless way to make
            digital</p>
          <a name="" id="" class="btn btn-primary btn-lg rounded-pill pl-lg-5 pr-lg-5 shadow-lg mr-3" href="#"
            role="button">TÜM KİTAPLAR</a>
          <a name="" id="" class="btn btn-success btn-lg rounded-pill pl-lg-5 pr-lg-5 shadow-lg" href="#"
            role="button">SATIN AL</a>
        </div>
      </div>
      <div class="col-lg-7 pl-5">
        <div id="sorular-konusuyor-slider" class="carousel slide sorular-konusuyor__slider pl-5" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#sorular-konusuyor-slider" data-slide-to="0" class="active">
              <div>5.</div>
            </li>
            <li data-target="#sorular-konusuyor-slider" data-slide-to="1">
              <div>6.</div>
            </li>
            <li data-target="#sorular-konusuyor-slider" data-slide-to="2">
              <div>7.</div>
            </li>
            <li data-target="#sorular-konusuyor-slider" data-slide-to="3">
              <div>8.</div>
            </li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row">
                <div class="col-sm-6 col-lg-6">
                  <div class="sorular-konusuyor__book-picture mx-auto text-center">
                    <img src="wp-content/themes/prv/resources/assets/images/sorular-konusuyor-5-sinif-turkce.png"
                      alt="">
                    <h3 class="sorular-konusuyor__book-category">5.Sınıf</h3>
                    <h3 class="sorular-konusuyor__book-branch">Türkçe Soru Bankkası</h3>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-6">
                  <div class="sorular-konusuyor__book-picture mx-auto text-center"><img
                      src="wp-content/themes/prv/resources/assets/images/sorular-konusuyor-5-sinif-matematik.png"
                      alt="">
                    <h3 class="sorular-konusuyor__book-category">5.Sınıf</h3>
                    <h3 class="sorular-konusuyor__book-branch">Matematik Soru Bankkası</h3>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-6">
                  <div class="sorular-konusuyor__book-picture mx-auto text-center"><img
                      src="wp-content/themes/prv/resources/assets/images/sorular-konusuyor-5-sinif-fen-bilimleri.png"
                      alt="">
                    <h3 class="sorular-konusuyor__book-category">5.Sınıf</h3>
                    <h3 class="sorular-konusuyor__book-branch">Fen Bilimleri Soru Bankkası</h3>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-6">
                  <div class="sorular-konusuyor__book-picture mx-auto text-center"><img
                      src="wp-content/themes/prv/resources/assets/images/sorular-konusuyor-5-sinif-sosyal-bilgiler.png"
                      alt="">
                    <h3 class="sorular-konusuyor__book-category">5.Sınıf</h3>
                    <h3 class="sorular-konusuyor__book-branch">Sosyal Bilgiler Soru Bankkası</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row">
                <div class="col-sm-6 col-lg-6">
                  <div class="sorular-konusuyor__book-picture mx-auto text-center">
                    <img src="wp-content/themes/prv/resources/assets/images/sorular-konusuyor-6-sinif-turkce.png"
                      alt="">
                    <h3 class="sorular-konusuyor__book-category">6.Sınıf</h3>
                    <h3 class="sorular-konusuyor__book-branch">Türkçe Soru Bankkası</h3>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-6">
                  <div class="sorular-konusuyor__book-picture mx-auto text-center"><img
                      src="wp-content/themes/prv/resources/assets/images/sorular-konusuyor-6-sinif-matematik.png"
                      alt="">
                    <h3 class="sorular-konusuyor__book-category">6.Sınıf</h3>
                    <h3 class="sorular-konusuyor__book-branch">Matematik Soru Bankkası</h3>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-6">
                  <div class="sorular-konusuyor__book-picture mx-auto text-center"><img
                      src="wp-content/themes/prv/resources/assets/images/sorular-konusuyor-6-sinif-fen-bilimleri.png"
                      alt="">
                    <h3 class="sorular-konusuyor__book-category">6.Sınıf</h3>
                    <h3 class="sorular-konusuyor__book-branch">Fen Bilimleri Soru Bankkası</h3>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-6">
                  <div class="sorular-konusuyor__book-picture mx-auto text-center"><img
                      src="wp-content/themes/prv/resources/assets/images/sorular-konusuyor-6-sinif-sosyal-bilgiler.png"
                      alt="">
                    <h3 class="sorular-konusuyor__book-category">6.Sınıf</h3>
                    <h3 class="sorular-konusuyor__book-branch">Sosyal Bilgiler Soru Bankkası</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- section-2__wrapper end -->



<!-- section-3__wrapper start -->

<section class="section-3__wrapper p-0 brans-denemeleri">
  <div class="container-fluid">
    <div class="row pt-lg-5">
      <div class="col-lg-12">
        <div class="text-center">
          <h1 class="brans-denemeleri__title p-5">8. Sınıf Branş Denemeleri</h1>
          <p class="brans-denemeleri__desc">When it comes to software design, animation is alimitless way to make
            digital</p>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="row p-lg-5">
          <div class="col-sm-6 col-lg-3 text-center">
            <div class="brans-denemeleri__book-picture"><img
                src="wp-content/themes/prv/resources/assets/images/turkce-brans.png" alt="">
              <a name="" id="" class="btn btn-primary btn-lg rounded-pill pl-lg-5 pr-lg-5 shadow-lg" href="#"
                role="button">İncele<i class="fa fa-external-link pl-2" aria-hidden="true"></i></a>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="brans-denemeleri__book-picture"><img
                src="wp-content/themes/prv/resources/assets/images/matematik-brans.png" alt="">
              <a name="" id="" class="btn btn-primary btn-lg rounded-pill pl-lg-5 pr-lg-5 shadow-lg" href="#"
                role="button">İncele<i class="fa fa-external-link pl-2" aria-hidden="true"></i></a>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="brans-denemeleri__book-picture"><img
                src="wp-content/themes/prv/resources/assets/images/fen-bilimleri-brans.png" alt=""> <a name="" id=""
                class="btn btn-primary btn-lg rounded-pill pl-lg-5 pr-lg-5 shadow-lg" href="#" role="button">İncele<i
                  class="fa fa-external-link pl-2" aria-hidden="true"></i></a></div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="brans-denemeleri__book-picture"><img
                src="wp-content/themes/prv/resources/assets/images/sosyal-bilgiler-brans.png" alt=""> <a name="" id=""
                class="btn btn-primary btn-lg rounded-pill pl-lg-5 pr-lg-5 shadow-lg" href="#" role="button">İncele<i
                  class="fa fa-external-link pl-2" aria-hidden="true"></i></a></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>

<!-- section-3__wrapper end -->

<!-- section4__wrapper start -->
<section class="section-4__wrapper teke-tek pt-5">
  <div class="container-fluid">
    <div class="row p-5">
      <div class="col-lg-6">
        <div class="row">
          <div class="col-sm-6 col-lg-6 pt-lg-5">
            <div class="teke-tek__book-picture"><img
                src="wp-content/themes/prv/resources/assets/images/teke-tek-turkce.png" alt="">
            </div>
          </div>
          <div class="col-sm-6 col-lg-6">
            <div class="teke-tek__book-picture"><img
                src="wp-content/themes/prv/resources/assets/images/teke-tek-matematik.png" alt=""></div>
          </div>
          <div class="col-sm-6 col-lg-6 pt-lg-5">
            <div class="teke-tek__book-picture"><img
                src="wp-content/themes/prv/resources/assets/images/teke-tek-fen-bilimleri.png" alt=""></div>
          </div>
          <div class="col-sm-6 col-lg-6">
            <div class="teke-tek__book-picture"><img
                src="wp-content/themes/prv/resources/assets/images/teke-tek-tc-inkilap-tarihi-ve-ataturkculuk.png"
                alt=""></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 vmx-auto">
        <div class="teke-tek__book text-right">
          <div class="teke-tek__book-brand">Pruva</div>
          <div class="teke-tek__book-name">Teke Tek</div>
          <div class="teke-tek__book-catchword pt-5"><span class="bold">Tek</span> Sayfa <span class="bold">Tek</span>
            Soru
          </div>
          <div class="teke-tek__book-desc">When it comes to software design, animation is alimitless way to make digital
          </div>
          <div class="pt-5">
            <a name="" id="" class="teke-tek_book-button btn btn-primary btn-lg rounded-pill pr-5 pl-5" href="#"
              role="button">DETAY</a>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- section4__wrapper end -->

  <!-- section5__wrapper start -->

  <section class="section-5__wrapper muhendis-kafasi">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6"></div>
        <div class="col-lg-6">
          <div class="row">
            <div class="col-lg-12 pt-5 pb-5">
              <div class="muhendis-kafasi__book">
                <div class="muhendis-kafasi__book-picture"><img
                    src="wp-content/themes/prv/resources/assets/images/muhendis-kafasi.png" alt=""></div>
                <div class="muhendis-kafasi__book-name">Mühendis Kafası</div>
                <div class="muhendis-kafasi__book-category">Matematik</div>
                <div class="muhendis-kafasi__book-descp">When it comes to software design, animation is alimitless way
                  to
                  make digital</div>
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
    </div>
    </div>
  </section>

</section>

<!-- section5__wrapper end -->

<!-- section6__wrapper start -->
<section class="section-6__wrapper beceri-temelli pt-5">
  <div class="container-fluid">
    <div class="row pt-5">
      <div class="col-lg-12">
        <div class="d-flex justify-content-center">
          <h1 class="beceri-temelli__title">Beceri Temelli Sorular</h1>
        </div>
      </div>
      <div class="col-lg-12 p-5">
        <div class="grid grid__container">
          <div class="grid__item grid__item-a">
            <div class="row grid__inner grid__inner-a p-3">
              <div class="col-12 beceri-temelli__icon">
                <i class="fonksiyonel-soru-prv-icon" aria-hidden="true"></i>
              </div>
              <div class="col-12 beceri-temelli__header">
                <h2>Fonksiyonel Soru</h2>
              </div>
              <div class="col-12 beceri-temelli__description">
                <h3>Modelleme Yöntemi</h3>
              </div>
            </div>
          </div>
          <div class="grid__item grid__item-b">
            <div class="row grid__inner grid__inner-b p-3">
              <div class="col-12 beceri-temelli__icon"><i class="ogreten-sorular-icon-prv-icon" aria-hidden="true"></i>
              </div>
              <div class="col-12 beceri-temelli__header">
                <h2>Öğreten Sorular</h2>
              </div>
              <div class="col-12 beceri-temelli__description">
                <h3>Konu Kavrama Testi</h3>
              </div>
            </div>
          </div>
          <div class="grid__item grid__item-c">
            <div class="row grid__inner grid__inner-c p-3">
              <div class="col-12 beceri-temelli__icon"><i class="kazanim-odakli-icon-prv-icon" aria-hidden="true"></i>
              </div>
              <div class="col-12 beceri-temelli__header">
                <h2>Kazanım Odaklı</h2>
              </div>
              <div class="col-12 beceri-temelli__description">
                <h3>EBA Soruları</h3>
              </div>
            </div>
          </div>
          <div class="grid__item grid__item-d">
            <div class="row grid__inner grid__inner-d p-3">
              <div class="col-12 beceri-temelli__icon"><i class="grafik-tablo-prv-icon" aria-hidden="true"></i></div>
              <div class="col-12 beceri-temelli__header">
                <h2>Grafik & Tablo</h2>
              </div>
              <div class="col-12 beceri-temelli__description">
                <h3>Yorumlama ve Analiz</h3>
              </div>
            </div>
          </div>
          <div class="grid__item grid__item-e">
            <div class="row grid__inner grid__inner-e p-3">
              <div class="col-12 beceri-temelli__icon"><i class="mantik-muhakeme-prv-icon" aria-hidden="true"></i></div>
              <div class="col-12 beceri-temelli__header">
                <h2>Mantık Muhakeme</h2>
              </div>
              <div class="col-12 beceri-temelli__description">
                <h3>Bilgiyi İşleme Kuramı</h3>
              </div>
            </div>
          </div>
          <div class="grid__item grid__item-ı">
            <div class="row grid__inner grid__inner-ı p-3">
              <div class="col-12 beceri-temelli__icon"><i class="yeni-nesil-sorular-prv-icon" aria-hidden="true"></i>
              </div>
              <div class="col-12 beceri-temelli__header">
                <h2>Yeni Nesil Sorular</h2>
              </div>
              <div class="col-12 beceri-temelli__description">
                <h3>MEB,PISA,TIMSS</h3>
              </div>
            </div>
          </div>
          <div class="grid__item grid__item-k">
            <div class="row grid__inner grid__inner-k p-3">
              <div class="col-12 beceri-temelli__icon"><i class="sinav-modu-prv-icon" aria-hidden="true"></i></div>
              <div class="col-12 beceri-temelli__header">
                <h2>SınavModu</h2>
              </div>
              <div class="col-12 beceri-temelli__description">
                <h3>Gerçek Sınav Deneyimi</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- section6__wrapper end -->


<!-- section7__wrapper start -->
<section class="section-7__wrapper yorumlar pt-5">
  <div class="container-fluid">
    <div class="row mx-auto">
      <div class="col-lg-12">
        <div class="d-flex justify-content-center">
          <h1 class="yorumlar__title">Öğrenci Görüşleri</h1>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-2"></div>
          <div class="col-lg-8">
            <div class="d-flex justify-content-center align-items-center flex-column">
              <div class="w-75 p-3 yorumlar__wrapper">
                <div class="row">
                  <div class="col-lg-2 text-right"><img class="yorumlar__profile rounded-pill"
                      src="wp-content/themes/prv/resources/assets/images/user-1.jpg" alt=""></div>
                  <div class="col-lg-10 vmx-auto p-4 yorumlar__content">
                    <h5 class="yorumlar__isim">Hatice DÖNMEZ</h5>
                    <p class="yorumlar__yorum d-inline">Nulla vehicula consectetur nulla et posuere. Vivamus maximus
                      eros
                      at
                      egestas
                      auctor. </p>
                  </div>
                </div>
              </div>
              <div class="w-75 p-3 yorumlar__wrapper">
                <div class="row">
                  <div class="col-lg-2 text-right"><img class="yorumlar__profile rounded-pill"
                      src="wp-content/themes/prv/resources/assets/images/user-2.jpg" alt=""></div>
                  <div class="col-lg-10 vmx-auto p-4 yorumlar__content">
                    <h5 class="yorumlar__isim">Mehmet ŞAFAK</h5>
                    <p class="yorumlar__yorum d-inline">Nulla vehicula consectetur nulla et posuere. Vivamus maximus
                      eros
                      at
                      egestas
                      auctor.Nulla vehicula consectetur nulla et posuere. Vivamus maximus eros at
                      egestas
                      auctor. </p>
                  </div>
                </div>
              </div>
              <div class="w-75 p-3 yorumlar__wrapper">
                <div class="row">
                  <div class="col-lg-2 text-right"><img class="yorumlar__profile rounded-pill"
                      src="wp-content/themes/prv/resources/assets/images/user-3.jpg" alt=""></div>
                  <div class="col-lg-10 vmx-auto p-4 yorumlar__content">
                    <h5 class="yorumlar__isim">Nuriye VERDENDİ</h5>
                    <p class="yorumlar__yorum d-inline">Nulla vehicula consectetur nulla et posuere. Vivamus maximus
                      eros
                      at
                      egestas
                      auctor. </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-2"></div>
        </div>
      </div>
      <div class="col-lg-12 pt-5">
        <div class="row">
          <div class="col-lg-3"></div>
          <div class="col-lg-6"><img src="wp-content/themes/prv/resources/assets/images/yourmlar-picture.svg" alt=""
              class="yorumlar__picture w-100"></div>
          <div class="col-lg-3"></div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<!-- section7__wrapper end -->

<!-- section8__wrapper end -->
<section class="section-8__wrapper neden-sorular-konusuyor">
  <div class="container-fluid h-100">
    <div class="row h-100">
      <div class="col-lg-6 vmx-auto">
        <div class="row pl-5">
          <div class="col-lg-12">
            <div class="neden-sorular-konusuyor__left-conent">
              <h1 class="neden-sorular-konusuyor__title p-0">Neden</h1>
              <h2 class="neden-sorular-konusuyor__subtitle p-0">Sorular konuşuyor?</h2>
              <p class="neden-sorular-konusuyor__description">Soruların derecelendirme sistemi çoğunlukla kullanılan bir
                metottur.
                Yardımcı kaynaklarımızın
                kullandıkları
                yöntemleri dikkate aldığımızda ihtiyaca göre genel olarak 2 farklı metot görürüz</p>
              <a name="" id=""
                class="btn btn-primary btn-lg neden-sorular-konusuyor__button pl-5 pr-5 mt-5 rounded-pill" href="#"
                role="button">Detay</a>
            </div>
          </div>
          <div class="col-lg-12 pt-5">
            <div class="row">
              <div class="col-lg-4"></div>
              <div class="col-lg-8">
                <div class="neden-sorular-konusuyor__videobox">
                  <!-- modal start -->
                  <div class="modal fade neden-sorular-konusuyor__modal" id="SKModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog neden-sorular-konusuyor__modal-dialog" role="document">
                      <div class="modal-content shadow-lg">
                        <div class="modal-body neden-sorular-konusuyor__modal-body">
                          <button type="button" class="close neden-sorular-konusuyor__model-close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <!-- 16:9 aspect ratio -->
                          <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always"
                              allow="autoplay"></iframe>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- modal end -->
                </div>
                <div><i class="fa fa-play-circle neden-sorular-konusuyor__play" aria-hidden="true" data-toggle="modal"
                    data-src="https://www.youtube.com/embed/nnmhhZcH8Wc" data-target="#SKModal"></i></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 pt-5">
        <div class="emoji pt-5">
          <div class="pt-5">
            <img class="emoji__item emoji__item-1" data-toggle="tooltip" data-html="true" data-placement="left" title="<div>
          <h5>Klasik Kolay</h5>
          <p>Klasik soru kalıpları içinde temelleri sağlam atmak için hızlı çözülebilen kolay bir soruyum. Konuya
            devam etmeden önce benden birkaç tane çözmen lazım.</p></div>"
              src="wp-content/themes/prv/resources/assets/images/emoji-icon-1.svg" alt="">
            <img class="emoji__item emoji__item-2" data-toggle="tooltip" data-html="true" data-placement="top" title="<div>
            <h5>Klasik Orta</h5>
            <p>Eğer klasik kalıplarda temel sorulardan çözdüysen seni bir tık öteye taşıyacak orta şiddette bir soru-
              yum. Kendini zor sorulara hazırlamak için bu aşama önemli!</p></div>"
              src="wp-content/themes/prv/resources/assets/images/emoji-icon-2.svg" alt="">
            <img class="emoji__item emoji__item-3" data-toggle="tooltip" data-html="true" data-placement="top" title="<div>
            <h5>Klasik Zor</h5>
            <p>Evet, artık kendini zorlama zamanı. Ben, klasik soru tarzlarında o sevilmeyen zor soruyum. İyi kon-
              santre ol, dikkatini topla ve bitir işimi!</p></div>"
              src="wp-content/themes/prv/resources/assets/images/emoji-icon-3.svg" alt="">
            <img class="emoji__item emoji__item-4" data-toggle="tooltip" data-html="true" data-placement="top" title="<div>
            <h5>Yeni Nesil Çeyrek Kolay</h5>
            <p>Bu konuda Yeni Nesil Sorulara giriş yapmak için kurgu çözümleme yeteneğini geliştirebileceğin kısa
              ve kolay bir soruyum.</p></div>" src="wp-content/themes/prv/resources/assets/images/emoji-icon-4.svg"
              alt="">
            <img class="emoji__item emoji__item-5" data-toggle="tooltip" data-html="true" data-placement="top" title="<div>
            <h5>Yeni Nesil Çeyrek Orta</h5>
            <p>Yeni Nesil Sorularda bir tık öteye geçme zamanı! Merak etme, çok yormam seni. Yine kısa fakat orta
              şiddette bir soru olduğumu bilmeni isterim.</p></div>"
              src="wp-content/themes/prv/resources/assets/images/emoji-icon-5.svg" alt="">
            <img class="emoji__item emoji__item-6" data-toggle="tooltip" data-html="true" data-placement="top" title="<div>
            <h5>Yeni Nesil Çeyrek Zor</h5>
            <p>Uzun uzun Yeni Nesil Sorulara geçmeden önce kendini alıştırman için seni biraz yormak istiyorum.
              Kısa fakat zor bir soruyum. Sana güveniyorum!</p></div>"
              src="wp-content/themes/prv/resources/assets/images/emoji-icon-6.svg" alt="">
            <img class="emoji__item emoji__item-7" data-toggle="tooltip" data-html="true" data-placement="top" title="<div>
            <h5>Yeni Nesil Yarım Orta</h5>
            <p>Yeni Nesil Soruyum. Kısa bir soru değilim, kabul ediyorum. Fakat çok uzun bir soru da değilim. Çok
              basit değilim, bunu da kabul ediyorum. Ama çok zor bir soru da değilim, seni zorlamam. Kısaca orta
              uzunlukta ve orta şiddette bir soruyum.</p></div>"
              src="wp-content/themes/prv/resources/assets/images/emoji-icon-7.svg" alt="">
            <img class="emoji__item emoji__item-8" data-toggle="tooltip" data-html="true" data-placement="top" title="<div>
            <h5>Yeni Nesil Yarım Zor</h5>
            <p>Yeni Nesil Soruyum. Açık konuşmak gerekirse kolaylık adına bende hiçbir şey yok. Sakın beni hafife
              alma! Evet, orta uzunlukta fakat zorum.</p></div>"
              src="wp-content/themes/prv/resources/assets/images/emoji-icon-8.svg" alt="">
            <img class="emoji__item emoji__item-9" data-toggle="tooltip" data-html="true" data-placement="top" title="<div>
            <h5>Yeni Nesil Tam Zor</h5>
            <p>Yeni Nesil Soruların en kralıyım. Bütün sorular seni bana ulaştırmak için çırpındı. Beni çözersen olayın
              çoğu bitmiş demektir. Baştan söyleyim seni bunaltmak için elimden geleni yapacağım. Çünkü uzun ve
              zor bir soruyum. Fakat beni çözmeye başladıysan yine de senden korkarım.</p></div>"
              src="wp-content/themes/prv/resources/assets/images/emoji-icon-9.svg" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- section-8__wrapper end -->

<!-- section-9__wrapper start -->

<section class="section-9__wrapper p-0 benimsorumnet">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 p-0">
        <div id="benimsorumnet-slider" class="slider carousel slide carousel-fade" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#benimsorumnet-slider" data-slide-to="0" class="active"></li>
            <li data-target="#benimsorumnet-slider" data-slide-to="1"></li>
            <li data-target="#benimsorumnet-slider" data-slide-to="2"></li>
          </ol>
          <div class="slider__wrapper carousel-inner">
            <div class="slider__item carousel-item active">
              <img class="d-block w-100" src="wp-content/themes/prv/resources/assets/images/benimsorum.net-slayt-1.jpg">
              <div class="carousel-caption d-none d-md-block">
                <h2 class="pb-5">Bizim Sorularımız .Net</h2>
              </div>
            </div>
            <div class="slider__item carousel-item">
              <img class="d-block w-100" src="wp-content/themes/prv/resources/assets/images/benimsorum.net-slayt-2.jpg">
              <div class="carousel-caption d-none d-md-block">
                <h2 class="pb-5">Benim sorumda .Net Diyorsanız</h2>
              </div>
            </div>
            <div class="slider__item carousel-item">
              <img class="d-block w-100" src="wp-content/themes/prv/resources/assets/images/benimsorum.net-slayt-3.jpg">
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
          <p class="pt-5">BenimSorum.Net'e Hoşgeldiniz!</p>
          <p class="w-75">Pruva Akademi’nin ciddi gayretlerle ve özenle hazırlanmış sorularını örnek üniteler linkimize
            tıklayıp
            inceleyebilirsiniz.</p>
          <a id="benimsorum" class="btn btn-primary p-3 pl-5 pr-5 mt-3 rounded-pill" href="www.benimsorum.net"
            target="_blank" role="button">www.benimsorum.net</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- section-9__wrapper end -->

<?php endwhile; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>