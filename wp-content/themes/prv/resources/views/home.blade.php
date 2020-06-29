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
    <div class="col-lg-12">
      {!! Home::bootstrap_pagnition() !!}
    </div>
  </div>
</section>
@endsection
