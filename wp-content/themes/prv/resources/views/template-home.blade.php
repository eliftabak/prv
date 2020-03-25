{{--
  Template Name: Home Page Template
--}}

@extends('layouts.app')

@section('content')
@while(have_posts()) @php the_post() @endphp

@include('sections.section-homepage-slider')
@include('sections.section-sorular-konusuyor')
@include('sections.section-brans-denemeleri')
@include('sections.section-teke-tek')
@include('sections.section-muhendis-kafasi')
@include('sections.section-beceri-temelli')
@include('sections.section-yorumlar')
@include('sections.section-neden-sorular-konusuyor')
@include('sections.section-benimsorumnet')
@endwhile
@endsection
