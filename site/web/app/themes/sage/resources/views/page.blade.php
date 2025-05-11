@extends('layouts.app')

@section('content')



    @if (is_front_page())
        @while (have_posts())
            @php(the_post())
            @includeFirst(['partials.content-page', 'partials.content'])
        @endwhile
    @elseif (is_page('cart') || is_page('checkout'))
        @while (have_posts())
            @php(the_post())
            @includeFirst(['partials.content-page', 'partials.content'])
        @endwhile
    @else
        @include('partials.page-header')
        @while (have_posts())
            @php(the_post())
            @includeFirst(['partials.content-page', 'partials.content'])
        @endwhile
    @endif
@endsection
