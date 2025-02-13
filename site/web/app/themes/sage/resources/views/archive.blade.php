@extends('layouts.app')

@section('content')
    <main id="main" class="main sm:mt-40">
        @include('partials.page-header')

        @if (!have_posts())
            <x-alert type="warning">
                {!! __('Sorry, no results were found.', 'sage') !!}
            </x-alert>

            {!! get_search_form(false) !!}
        @endif

        <div class="infinite-scroll-container">
            @while (have_posts())
                @php(the_post())
                @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
            @endwhile
        </div>

        {!! get_the_posts_navigation() !!}
    </main>
@endsection
