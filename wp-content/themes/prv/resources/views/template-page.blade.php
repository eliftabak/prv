{{--
  Template Name: General Page Template
--}}

@extends('layouts.app')

@section('content')
@include('partials.page-header')
@while(have_posts()) @php the_post() @endphp
@include('partials.content-page')
@include('sections.section-benimsorumnet')
@endwhile
@endsection
