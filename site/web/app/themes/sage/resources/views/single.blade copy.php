@extends('layouts.app')

@section('content')
  <main id="main" class="py-8 main">
    @while(have_posts()) @php(the_post())
      @includeFirst(['partials.content-single-' . get_post_type(), 'partials.content-single'])
    @endwhile
  </main>
@endsection
