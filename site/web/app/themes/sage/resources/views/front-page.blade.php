@extends('layouts.app')


@section('content')
    <main id="main" class="mt-10 main">

        @while (have_posts())
            @php(the_post())
            @include('partials.content-page')
        @endwhile

        @include('partials.cupones')


        @include('partials.slider')

        @if ($destacados['has_posts'] = true)
            <section id="destacados">
                @foreach ($destacados['posts'] as $destacado)
                    @include('partials.destacados-portada')
                @endforeach
            </section>pwd
        @endif

    </main>
@endsection

@section('sidebar')
    @include('partials.sidebar')
@endsection
