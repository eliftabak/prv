@php

if ($index === 0) {
$maincol = "col-lg-12";
$subcol = "col-lg-6 h-100";
$exist = true;
$picturesize = "full";
} else {
$maincol = "col-lg-6";
$subcol = "col-lg-12 h-100";
$picturesize = "large";
$exist = false;
}

@endphp

<div class='@php echo "{$maincol} mb-4" @endphp'>
  <div class="row no-gutters h-100">
    <div class="col-lg-12 h-100 blog-card-radius">
      @php echo ($exist === false ) ? '<div class="blog-card__overlay blog-card-radius">
      </div>' : "" @endphp
      <div class="h-100 w-100 lazy blog-card-radius blog-card-first"
        data-src="{!! wp_get_attachment_image_src( get_post_thumbnail_id(),$picturesize)[0] !!}" background-size:
        cover;">
        <div class='@php echo "{$subcol} p-4 p-lg-5 d-flex flex-column justify-content-between" @endphp'>
          <h2 class="blog-card__title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
          <p class="blog-card__summary"> @php the_excerpt() @endphp </p>
          <div>
            <h6 class="d-inline pr-lg-4 blog-card__category">Kategori:
              @php
              $cat = get_the_category();
              if ( ! empty( $cat ) ) {
              echo esc_html( $cat[0]->name );
              }
              @endphp
            </h6>
            <h6 class="d-inline"><time class="blog-card__time"
                datetime="{{ get_post_time('c', true) }}">{{ get_the_date("j F l, Y") }}</time></h6>
          </div>
          <a name="" id="" class="btn btn-info pl-5 pr-5 rounded-pill mt-4 shadow mr-auto" href="{{ get_permalink() }}"
            role="button">Detay</a>
        </div>
      </div>
    </div>
  </div>
</div>
