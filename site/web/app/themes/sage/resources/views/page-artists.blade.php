{{--
  Template Name: Artists Template
--}}

@extends('layouts.app')

<main id="main" class="py-8 sm:mt-40 main">
  @section('content')
    @while(have_posts()) @php(the_post())
      @include('partials.page-header')
    @endwhile

    @foreach ($artists as $artist)
      <a href="{{ $artist['permalink'] }}" role="article" class="flex flex-wrap mb-6 md:mb-10 justify-startmb-6 article md:flex-nowrap hover:text-white">
        <h2 class="block w-full p-6 font-bold text-center uppercase tracking-max">{{ $artist['name'] }}</h2>

        <div class="flex items-start justify-center avatar f-full">
          @if ($artist['avatar'])
          <img src="{{ $artist['avatar']['url'] }}" srcset="{{ $artist['srcset'] }}" sizes="(max-width: 768px) 100vw, 20vw" alt="{{ $artist['name'] }}" class="">
          @endif
        </div>

        <div class="flex flex-wrap items-start w-full md:w-auto productos">
          @foreach ($artist['products'] as $prod)
              {!! $prod['prod_img'] !!}
          @endforeach
        </div>
      </a>

    @endforeach
  @endsection
</main>
