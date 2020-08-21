@extends('layouts.app')

@section('content')
@include('partials.page-header')

@if (!have_posts())
@include('partials.content-search-not-found')
@else
@include('partials.content-search')
@endif
@include('sections.section-benimsorumnet')
@endsection
