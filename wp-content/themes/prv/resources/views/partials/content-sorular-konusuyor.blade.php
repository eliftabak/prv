@php
$home = App::home_url_with_slash();
@endphp

<section class="container container__page-content pt-5">
  <div class="row">
    <div class="col-12">
      <div class="first-page">
        <img src="{{$home}}wp-content/themes/prv/resources/assets/images/sorular-konusuyor-sidebar.png"
          class="side-block" />
        <div class="title-texts-container">
          <div class="box">
            <img src="{{$home}}wp-content/themes/prv/resources/assets/images/dots.png" alt="22x6dots"
              class="dots-image">
            <div class="text">
              <h1 class="blue-text">Mavi</h1>
            </div>
          </div>
          <div class="second-text-line">
            <h1 class="text-inside">Sayfalar</h1>
          </div>
        </div>
        <img src="{{$home}}wp-content/themes/prv/resources/assets/images/sorular-konusuyor.png" alt="sorular konusuyor"
          class="sorular-image">
        <div class="logo-questions-page">
          <img src="{{$home}}wp-content/themes/prv/resources/assets/images/pruva-akademi-logo.png" alt="pruva-logo">
        </div>
      </div>
      <!----End of first page----->
    </div>
    <div class="col-12">
      <div class="second-page">
        <div class="title-texts-container">
          <div class="box">
            <img src="{{$home}}wp-content/themes/prv/resources/assets/images/dots.png" alt="22x6dots"
              class="dots-image">
            <div class="text">
              <h1 class="secondpage__text-inside">Neden</h1>
            </div>
          </div>
          <div class="second-text-line">
            <h1 class="text-inside">Sorular</h1>
          </div>
          <div class="second-text-line">
            <h1 class="text-inside">Konuşuyor</h1>
          </div>
        </div>
        <!----End of second page----->
      </div>
    </div>
</section>
