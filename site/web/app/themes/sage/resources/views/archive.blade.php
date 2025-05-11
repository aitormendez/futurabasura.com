@extends('layouts.app')

@section('content')
    <main class="main">

        @include('partials.page-header')

        <div class="infinite-scroll-container">

            @while (have_posts())
                @php(the_post())
                @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
            @endwhile
        </div>


        {!! get_the_posts_navigation() !!}
    </main>
@endsection
