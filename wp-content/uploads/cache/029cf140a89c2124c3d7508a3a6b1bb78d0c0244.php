<?php
$home = App::home_url_with_slash();
?>
<footer class="content-info footer">
  <div class="p-0 h-100">
    <div class="container-fluid subscriber">
      <div class="row p-lg-5 pt-3">
        <div class="col-12 col-lg-6">
          <h1 class="font-weight-bold text-center text-lg-left">E-Bülten</h1>
          <p class="font-weight-lighter">Kampanyalarımızdan haberdar olmak için e-posta adresinizle kayıt olabilirsiniz.
          </p>
        </div>
        <div class="col-12 col-lg-6">
          <!-- Begin Mailchimp Signup Form -->
          <div id="mc_embed_signup">
            <form
              action="https://pruvaakademi.us8.list-manage.com/subscribe/post?u=0dce354ad5969072d8e1e0bbb&amp;id=9d7c8d917c"
              method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"
              target="_blank" novalidate>
              <div class="form-group text-right pt-1">
                <input type="email" value="" name="EMAIL" class="email form-control d-inline rounded-pill p-4"
                  id="mce-EMAIL" placeholder="E-posta adresi giriniz..." required>
                <input type="submit" value="Abone Ol" name="subscribe" id="mc-embedded-subscribe"
                  class="button btn btn-subscriber-submit d-inline rounded-pill p-2">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-head-background lazy"
      data-src="<?php echo e($home); ?>wp-content/themes/prv/resources/assets/images/footer-background-head.png"></div>
  </div>
  <section class="footer__wrapper p-lg-5">
    <div class="container-fluid">
      <a class="navbar-brand text-uppercase font-weight-bold mb-3 pt-5" href="<?php echo e(home_url('/')); ?>">
        <img class="lazy"
          data-src="<?php echo e(home_url('/')); ?>wp-content/themes/prv/resources/assets/images/pruva-akademi-logo.svg"
          alt="<?php echo e(get_bloginfo('name', 'display')); ?>" width="276" height="auto">
      </a>
      <div class="row">
        <div class="col-6">
          <div class="row pt-5 no-gutters">
            <?php dynamic_sidebar('sidebar-footer-1') ?>
            <?php dynamic_sidebar('sidebar-footer-2') ?>
            <?php dynamic_sidebar('sidebar-footer-3') ?>
          </div>
        </div>
        <div class="col-6 pt-5">
          <div class="row pt-lg-5 no-gutters">
            <?php dynamic_sidebar('sidebar-footer-4') ?>
          </div>
        </div>
      </div>
    </div>
    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <p>Copyright 2019 Pruva Akademi | All Rights Reserved | Web Tasarım Hexagon Design</p>
          </div>
        </div>
      </div>
    </section>

  </section>
  <section class="credit-cards bg-white h-100 p-1">
    <div class="container-fluid">
      <div class="row mx-auto">
        <div class="col-lg-12 text-center">
          <img class="lazy" data-src="<?php echo e(home_url('/')); ?>wp-content/themes/prv/resources/assets/images/credit-cards.png"
            alt="">
        </div>
      </div>
    </div>
  </section>
  </div>
  <a id="back-to-top" href="#" class="btn btn-primary back-to-top shadow font-weight-bold" role="button"><i
      class="fa fa-chevron-up pr-2"></i>Başa dön</a>
</footer>
