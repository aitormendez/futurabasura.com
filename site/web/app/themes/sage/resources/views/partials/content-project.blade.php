<article @php(post_class('bg-white md:bg-transparent mb-6'))>
  <header>
    <h2 class="p-6 leading-none md:p-0 entry-title md:mb-6">
      <a href="{{ get_permalink() }}" class="page-header-font text-azul">
        {!! $title !!}
      </a>
    </h2>

    @include('partials/entry-meta')

    <div class="thumb-wrap md:bg-white">
      <div class="thumb">
        @thumbnail('large')
      </div>
    </div>
  </header>

  <div class="p-6 font-serif text-xl md:px-0 entry-summary">
    @php(the_excerpt())
  </div>
</article>
