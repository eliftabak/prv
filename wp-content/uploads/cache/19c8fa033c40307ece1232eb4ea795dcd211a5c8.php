<?php $__env->startSection('content'); ?>
<?php while(have_posts()): ?> <?php the_post() ?>
<?php echo $__env->make('partials.page-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('partials.content-page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- section-1__wrapper start -->
<section class="section-1__wrapper">
  <div class="bg-primary p-0 section-1__container">
    <div class="slider-wrapper">
      <img class="p-0 position-absolute green-background" style="z-index:2"
        src="wp-content/themes/prv/resources/assets/images/green.svg">
      <img class="p-0 position-absolute child" style="z-index:3"
        src="wp-content/themes/prv/resources/assets/images/child.svg">
      <div class="position-relative" style="z-index:3">
        <div class="pt-5 text-white text-right pr-5">
          <div class="pt-5 mt-5">
            <h1 class="text-1 pt-5">Siz hiç konuşan soru bankası</h1>
            <p class="text-2">Gördünüz mü ?</p>
            <p class="text-3">yeni sisteme hazır olun!</p>
          </div>
          <div class="description text-right w-50 ml-auto ml">
            <div class="py-3">
              <p class="lead">Lorem ipsum dolor sit amet, <strong class="font-weight-bold">consectetur adipisicing
                </strong>elit. Explicabo consectetur odio voluptatum facere animi temporibus, distinctio tempore enim
                corporis quam <strong class="font-weight-bold">recusandae </strong>placeat! Voluptatum voluptate, ex
                modi illum quas nam distinctio.</p>
            </div>
          </div>
          <button class="btn btn-purple btn-lg pl-5 pr-5 ">DETAY</button>
        </div>
      </div>
    </div>
  </div>

  <section class="section-2__wrapper p-0">

  </section>
  <!-- section-2__wrapper end -->

</section>
<!-- section-1__wrapper end -->



<!-- section-3__wrapper start -->

<section class="section-3__wrapper p-0">

</section>

<!-- section-3__wrapper end -->

<!-- section4__wrapper start -->
<section class="section-4__wrapper teke-tek pt-5">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6"></div>
      <div class="col-lg-6"></div>
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
<section class="section-8__wrapper sorular-konusuyor">
  <div class="container-fluid">
    <div class="row h-100">
      <div class="col-lg-6 vmx-auto">
        <div class="row pl-5">
          <div class="col-lg-12">
            <div class="sorular-konusuyor__left-conent">
              <h1 class="sorular-konusuyor__title p-0">Neden</h1>
              <h2 class="sorular-konusuyor__subtitle p-0">Sorular konuşuyor?</h2>
              <p class="sorular-konusuyor__description">Soruların derecelendirme sistemi çoğunlukla kullanılan bir
                metottur.
                Yardımcı kaynaklarımızın
                kullandıkları
                yöntemleri dikkate aldığımızda ihtiyaca göre genel olarak 2 farklı metot görürüz</p>
              <a name="" id="" class="btn btn-primary btn-lg sorular-konusuyor__button pl-5 pr-5 mt-5 rounded-pill"
                href="#" role="button">Detay</a>
            </div>
          </div>
          <div class="col-lg-12 pt-5">
            <div class="row">
              <div class="col-lg-4"></div>
              <div class="col-lg-8">
                <div class="sorular-konusuyor__videobox">
                  <!-- modal start -->
                  <div class="modal fade sorular-konusuyor__modal" id="SKModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog sorular-konusuyor__modal-dialog" role="document">
                      <div class="modal-content shadow-lg">
                        <div class="modal-body sorular-konusuyor__modal-body">
                          <button type="button" class="close sorular-konusuyor__model-close" data-dismiss="modal"
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
                <div><i class="fa fa-play-circle sorular-konusuyor__play" aria-hidden="true" data-toggle="modal"
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
        <div id="carouselExampleControls" class="slider carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="slider__wrapper carousel-inner">
            <div class="slider__item carousel-item active">
              <img class="d-block w-100"
                src="http://localhost:3000/websiteler/pruvaakademi.com/wp-content/themes/prv/resources/assets/images/benimsorum.net-slayt-1.jpg">
              <div class="carousel-caption d-none d-md-block">
                <h2 class="pb-5">Bizim Sorularımız .Net</h2>
              </div>
            </div>
            <div class="slider__item carousel-item">
              <img class="d-block w-100"
                src="http://localhost:3000/websiteler/pruvaakademi.com/wp-content/themes/prv/resources/assets/images/benimsorum.net-slayt-2.jpg">
              <div class="carousel-caption d-none d-md-block">
                <h2 class="pb-5">Benim sorumda .Net Diyorsanız</h2>
              </div>
            </div>
            <div class="slider__item carousel-item">
              <img class="d-block w-100"
                src="http://localhost:3000/websiteler/pruvaakademi.com/wp-content/themes/prv/resources/assets/images/benimsorum.net-slayt-3.jpg">
              <div class="carousel-caption d-none d-md-block">
                <h2 class="pb-5">Örnek Sorularınızı Bekliyoruz</h2>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      <div class="col-lg-6 vmx-auto p-5">
        <div class="content text-dark">
          <h5 class="text-primary">Değerli Öğretmenlerimiz,</h5>
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