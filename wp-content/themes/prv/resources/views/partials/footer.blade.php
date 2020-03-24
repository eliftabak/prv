<footer class="content-info footer">
  <div class="p-0 h-100">
    <div class="container-fluid subscriber">
      <div class="row p-5">
        <div class="col">
          <h1 class="font-weight-bold">E-Bülten</h1>
          <p class="font-weight-lighter">Kampanyalarımızdan haberdar olmak için e-posta adresinizle kayıt olabilirsiniz.
          </p>
        </div>
        <div class="col">
          <div class="form-group text-right pt-1">
            <input type="text" class="form-control w-50 d-inline rounded-pill p-4" name="" id=""
              aria-describedby="helpId" placeholder="E-posta adresi giriniz...">
            <a name="" id="" class="btn btn-subscriber-submit d-inline rounded-pill p-2" href="#" role="button"><i
                class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
          </div>
        </div>
      </div>
    </div>
    <section class="footer__wrapper p-5">
      <a class="navbar-brand text-uppercase font-weight-bold mb-3" href="{{ home_url('/') }}">
        <img src="{{ home_url('/') }}wp-content/themes/prv/resources/assets/images/pruva-akademi-logo.svg"
          alt="{{ get_bloginfo('name', 'display') }}" width="276" height="auto">
      </a>
      <div class="container-fluid">
        <div class="row">
          <div class="col-6">
            <div class="row pt-5">
              @php dynamic_sidebar('sidebar-footer-1') @endphp
              @php dynamic_sidebar('sidebar-footer-2') @endphp
              @php dynamic_sidebar('sidebar-footer-3') @endphp
            </div>
          </div>
          <div class="col-6 pt-5">
            <div class="row pt-5">
              @php dynamic_sidebar('sidebar-footer-4') @endphp
            </div>
          </div>
        </div>
      </div>
      <section>
        <div class="row">
          <div class="col-12">
            <p>Copyright 2019 Pruva Akademi | All Rights Reserved | Web Tasarım Hexagon Design</p>
          </div>
        </div>
      </section>

    </section>
    <section class="credit-cards bg-white h-100 p-1">
      <div class="container-fluid">
        <div class="row mx-auto">
          <div class="col-lg-12 text-center">
            <img src="{{ home_url('/') }}wp-content/themes/prv/resources/assets/images/credit-cards.png" alt="">
          </div>
        </div>
      </div>
    </section>
  </div>
  <a id="back-to-top" href="#" class="btn btn-primary back-to-top shadow font-weight-bold" role="button"><i
      class="fa fa-chevron-up pr-2"></i>Başa dön</a>
</footer>
