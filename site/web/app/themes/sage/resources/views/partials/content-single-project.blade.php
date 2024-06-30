<article @php(post_class('top-0 bg-white md:bg-transparent'))>
  <header>
    <div class="mb-6 thumb">
      @thumbnail('large')
    </div>
    <aside>
      <a href="/projects" class="leading-none md:absolute page-header-font text-azul ml-7 md:ml-0">
        {!! __('Projects', 'sage') !!}
      </a>
    </aside>
    <h1 class="leading-none px-7 entry-title page-header-font md:mb-6 md:px-0">
      {!! $title !!}
    </h1>

    @include('partials/entry-meta')
  </header>

  <div class="font-serif leading-tight prose entry-content md:bg-white md:mt-3">
    @php(the_content())
  </div>

  @php(comments_template())
</article>
