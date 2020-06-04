@extends('layouts.app')

@section('content')
@include('partials.page-header')
<section class="container container__page-content blog-card-radius">
  <div class="row">
    @php $i=0; @endphp
    @while(have_posts()) @php the_post() @endphp
    @include('partials.content-archive-post',['index'=>$i])
    @php $i++; @endphp
    @endwhile



    @php
    global $wp_query;
    $big = 999999999; // need an unlikely integer
    echo paginate_links( array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $wp_query->max_num_pages
    ) );
    @endphp
  </div>
</section>
@endsection
