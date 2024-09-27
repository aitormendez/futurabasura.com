{{--
  Template Name: Checkout
--}}

@extends('layouts.app')


  @section('content')
    <main id="main" class="py-8 sm:mt-40 main">
      @while(have_posts()) @php(the_post())
        @include('partials.page-header')
        @include('partials.content-cart')
      @endwhile
    </main>
  @endsection
