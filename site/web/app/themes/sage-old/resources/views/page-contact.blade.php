{{--
  Template Name: Contact
--}}

@extends('layouts.app')


  @section('content')
    <main id="main" class="py-8 sm:mt-40 main">
      @while(have_posts()) @php(the_post())
        @include('partials.page-header')
        <div class="max-w-3xl mx-auto tracking-wide bg-white">
          <div class="font-serif prose">@php(the_content())</div>
        </div>
        
      @endwhile
    </main>
  @endsection
