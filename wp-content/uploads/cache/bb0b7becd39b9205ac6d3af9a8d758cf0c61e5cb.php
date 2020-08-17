<?php
$home = App::home_url_with_slash();
?>
<!-- section8__wrapper end -->
<section class="neden-sorular-konusuyor">
  <div class="container-fluid h-100">
    <div class="row h-100">
      <div class="col-sm-8 col-lg-6 mx-auto vmx-auto">
        <div class="row pl-lg-5">
          <div class="col-lg-12">
            <div class="neden-sorular-konusuyor__left-conent">
              <h1 class="neden-sorular-konusuyor__title p-0 pt-5">Neden</h1>
              <h2 class="neden-sorular-konusuyor__subtitle p-0">Sorular Konuşuyor?</h2>
              <p class="neden-sorular-konusuyor__description">Sorular Konuşuyor Serisinin özenle hazırlanmış çok özel
                sistemini incelemek ve tüm detayları öğrenmek için bu makaleyi okuyabilir veya aşağıdaki butona
                tıklayarak izleyebilirsiniz.</p>
              <a name="" id=""
                class="btn btn-primary btn-lg neden-sorular-konusuyor__button pl-5 pr-5 mt-5 rounded-pill" href="#"
                role="button">Detay</a>
            </div>
          </div>
          <div class="col-lg-12 pt-5">
            <div class="row">
              <div class="col-lg-4"></div>
              <div class="col-lg-8 text-sm-left text-md-center">
                <div class="neden-sorular-konusuyor__videobox">
                  <!-- modal start -->
                  <div class="modal fade neden-sorular-konusuyor__modal" id="SKModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog neden-sorular-konusuyor__modal-dialog" role="document">
                      <div class="modal-content shadow-lg">
                        <div class="modal-body neden-sorular-konusuyor__modal-body">
                          <button type="button"
                            class="btn btn-light rounded-pill modal-close neden-sorular-konusuyor__model-close"
                            data-dismiss="modal" aria-label="Close">
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
                <div class="neden-sorular-konusuyor__play-button"><i
                    class="fa fa-play-circle neden-sorular-konusuyor__play" aria-hidden="true" data-toggle="modal"
                    data-src="https://www.youtube.com/embed/nnmhhZcH8Wc" data-target="#SKModal"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-8 col-lg-6 mx-auto pt-lg-5">
        <div class="emoji pt-lg-5 h-100">
          <img class="emoji__item emoji__item-1 lazy" data-toggle="tooltip" data-html="true" data-placement="left"
            title="<div>
          <h5>Klasik Kolay</h5>
          <p>Klasik soru kalıpları içinde temelleri sağlam atmak için hızlı çözülebilen kolay bir soruyum. Konuya
            devam etmeden önce benden birkaç tane çözmen lazım.</p></div>"
            data-src="<?php echo e($home); ?>wp-content/themes/prv/resources/assets/images/emoji-icon-1.svg" alt="">
          <img class="emoji__item emoji__item-2 lazy" data-toggle="tooltip" data-html="true" data-placement="top" title="<div>
            <h5>Klasik Orta</h5>
            <p>Eğer klasik kalıplarda temel sorulardan çözdüysen seni bir tık öteye taşıyacak orta şiddette bir soru-
              yum. Kendini zor sorulara hazırlamak için bu aşama önemli!</p></div>"
            data-src="<?php echo e($home); ?>wp-content/themes/prv/resources/assets/images/emoji-icon-2.svg" alt="">
          <img class="emoji__item emoji__item-3 lazy" data-toggle="tooltip" data-html="true" data-placement="top" title="<div>
            <h5>Klasik Zor</h5>
            <p>Evet, artık kendini zorlama zamanı. Ben, klasik soru tarzlarında o sevilmeyen zor soruyum. İyi kon-
              santre ol, dikkatini topla ve bitir işimi!</p></div>"
            data-src="<?php echo e($home); ?>wp-content/themes/prv/resources/assets/images/emoji-icon-3.svg" alt="">
          <img class="emoji__item emoji__item-4 lazy" data-toggle="tooltip" data-html="true" data-placement="top" title="<div>
            <h5>Yeni Nesil Çeyrek Kolay</h5>
            <p>Bu konuda Yeni Nesil Sorulara giriş yapmak için kurgu çözümleme yeteneğini geliştirebileceğin kısa
              ve kolay bir soruyum.</p></div>"
            data-src="<?php echo e($home); ?>wp-content/themes/prv/resources/assets/images/emoji-icon-4.svg" alt="">
          <img class="emoji__item emoji__item-5 lazy" data-toggle="tooltip" data-html="true" data-placement="top" title="<div>
            <h5>Yeni Nesil Çeyrek Orta</h5>
            <p>Yeni Nesil Sorularda bir tık öteye geçme zamanı! Merak etme, çok yormam seni. Yine kısa fakat orta
              şiddette bir soru olduğumu bilmeni isterim.</p></div>"
            data-src="<?php echo e($home); ?>wp-content/themes/prv/resources/assets/images/emoji-icon-5.svg" alt="">
          <img class="emoji__item emoji__item-6 lazy" data-toggle="tooltip" data-html="true" data-placement="top" title="<div>
            <h5>Yeni Nesil Çeyrek Zor</h5>
            <p>Uzun uzun Yeni Nesil Sorulara geçmeden önce kendini alıştırman için seni biraz yormak istiyorum.
              Kısa fakat zor bir soruyum. Sana güveniyorum!</p></div>"
            data-src="<?php echo e($home); ?>wp-content/themes/prv/resources/assets/images/emoji-icon-6.svg" alt="">
          <img class="emoji__item emoji__item-7 lazy" data-toggle="tooltip" data-html="true" data-placement="top" title="<div>
            <h5>Yeni Nesil Yarım Orta</h5>
            <p>Yeni Nesil Soruyum. Kısa bir soru değilim, kabul ediyorum. Fakat çok uzun bir soru da değilim. Çok
              basit değilim, bunu da kabul ediyorum. Ama çok zor bir soru da değilim, seni zorlamam. Kısaca orta
              uzunlukta ve orta şiddette bir soruyum.</p></div>"
            data-src="<?php echo e($home); ?>wp-content/themes/prv/resources/assets/images/emoji-icon-7.svg" alt="">
          <img class="emoji__item emoji__item-8 lazy" data-toggle="tooltip" data-html="true" data-placement="top" title="<div>
            <h5>Yeni Nesil Yarım Zor</h5>
            <p>Yeni Nesil Soruyum. Açık konuşmak gerekirse kolaylık adına bende hiçbir şey yok. Sakın beni hafife
              alma! Evet, orta uzunlukta fakat zorum.</p></div>"
            data-src="<?php echo e($home); ?>wp-content/themes/prv/resources/assets/images/emoji-icon-8.svg" alt="">
          <img class="emoji__item emoji__item-9 lazy" data-toggle="tooltip" data-html="true" data-placement="top" title="<div>
            <h5>Yeni Nesil Tam Zor</h5>
            <p>Yeni Nesil Soruların en kralıyım. Bütün sorular seni bana ulaştırmak için çırpındı. Beni çözersen olayın
              çoğu bitmiş demektir. Baştan söyleyim seni bunaltmak için elimden geleni yapacağım. Çünkü uzun ve
              zor bir soruyum. Fakat beni çözmeye başladıysan yine de senden korkarım.</p></div>"
            data-src="<?php echo e($home); ?>wp-content/themes/prv/resources/assets/images/emoji-icon-9.svg" alt="">
        </div>
      </div>
    </div>
  </div>
</section>
<!-- section-8__wrapper end -->
