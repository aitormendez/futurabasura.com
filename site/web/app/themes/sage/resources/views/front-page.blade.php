@extends('layouts.app')


  @section('content')
  <main id="main" class="mt-10 main">

    @include('partials.hero-video')

    @include('partials.cupones')


    @include('partials.slider')

@if ($destacados['has_posts'] = true)

    <section id="destacados">
      @foreach ($destacados['posts'] as $destacado)
        @include('partials.destacados-portada')
      @endforeach
    </section>

@endif

  </main>
  @endsection

@section('sidebar')
  @include('partials.sidebar')
@endsection
