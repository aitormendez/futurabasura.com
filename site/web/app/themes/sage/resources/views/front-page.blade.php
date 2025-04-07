@extends('layouts.app')


@section('content')
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
        </section>
    @endif
@endsection
