{{--
  Template Name: Artists Template
--}}

@extends('layouts.app')
@section('content')
    @while (have_posts())
        @php(the_post())
        @include('partials.page-header')
    @endwhile

    @foreach ($artists as $artist)
        <a href="{{ $artist['permalink'] }}" role="article"
            class="justify-startmb-6 article mb-6 flex flex-wrap hover:text-white md:mb-10 md:flex-nowrap">
            <h2 class="tracking-max block w-full p-6 text-center font-bold uppercase">{{ $artist['name'] }}</h2>

            <div class="avatar f-full flex items-start justify-center">
                @if ($artist['avatar'])
                    <img src="{{ $artist['avatar']['url'] }}" srcset="{{ $artist['srcset'] }}"
                        sizes="(max-width: 768px) 100vw, 20vw" alt="{{ $artist['name'] }}" class="">
                @endif
            </div>

            <div class="productos flex w-full flex-wrap items-start md:w-auto">
                @foreach ($artist['products'] as $prod)
                    {!! $prod['prod_img'] !!}
                @endforeach
            </div>
        </a>
    @endforeach
@endsection
