<section class="container container__page-content pt-5">
  <div class="row">
    <div class="col-12">
      @php the_content() @endphp
    </div>
    {!! do_action('woocommerce_share')!!}
  </div>
</section>

<section class="related-posts container container__page-content">
  <div class="container-fluid">
    <h2>İlgili Makaleler</h2>
    <div class="row row-eq-height align-items-end">
      {!! do_action('related_posts',$post)!!}
    </div>
  </div>
</section>
