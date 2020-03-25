<section class="container-fluid top-header">
  <div class="container p-0 h-100">
    <div class="row top-header__inner-container">
      <div class="col-lg-6 text-left">
        <div class="top-header__title">
          <h1>{!! App::title() !!}</h1>
        </div>
      </div>
      <div class="col-lg-6 text-right">
        <div class="top-header__breadcumb">@php if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
          } @endphp
        </div>
      </div>
    </div>
  </div>
</section>
