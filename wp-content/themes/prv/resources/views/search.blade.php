@extends('layouts.app')

@section('content')
@include('partials.page-header')

@if (!have_posts())
<div class="alert alert-warning">
  {{ __('Sorry, no results were found.', 'sage') }}
</div>

{!! get_search_form(false) !!}
)
@include('sections.section-benimsorumnet')
@endif
@include('partials.content-search')
@include('sections.section-benimsorumnet')
@endsection
