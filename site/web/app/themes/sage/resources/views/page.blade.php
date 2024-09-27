@extends('layouts.app')
@section('content')
    @while (have_posts())
        @php(the_post())
        @include('partials.page-header')
        {!! do_shortcode('[hf_form slug="participate"]') !!}
        @includeFirst(['partials.content-page', 'partials.content'])
    @endwhile
@endsection
