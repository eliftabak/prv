@extends('layouts.app')

@section('content')
@while(have_posts()) @php the_post() @endphp
@include('partials.content-archive-'.get_post_type())
@endwhile
@endsection
