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
      <div class="page2">
        <div class="page2__title-texts-container">
          <div class="box">
            <img src="{{$home}}wp-content/themes/prv/resources/assets/images/page2-short-dots.png" alt="22x6dots"
              class="page2__dots-image">
            <div class="page2__text">
              <h1 class="page2__text-inside">Neden</h1>
            </div>git add .
          </div>
          <div class="page2__second-text-line">
            <h1 class="page2__text-inside">Sorular</h1>
            <h1 class="page2__text-inside">Konuşuyor</h1>
          </div>
        </div>
        <div class="page2__">
          <p><b>KİTABIMIZI,<b> BİR BÜTÜN OLARAK ya da TEST TEST Kolay, Orta, Zor şeklinde GRUPLANDIRARAK değil, her
                bir
                soruyu tek tek ele alıp <b>SORU TEMELLİ BİR SINIFLANDIRMA<b> yaparak oluşturduk.</p>
        </div>
        <!----End of second page----->
      </div>
    </div>
</section>
