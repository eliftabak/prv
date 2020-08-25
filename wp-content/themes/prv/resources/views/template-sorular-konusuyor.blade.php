{{--
  Template Name: Sorular Konusuyor Page Template
--}}

@extends('layouts.app')

@section('content')
@include('partials.page-header')
@while(have_posts()) @php the_post() @endphp
@include('partials.content-sorular-konusuyor')
@include('sections.section-benimsorumnet')
@endwhile
@endsection