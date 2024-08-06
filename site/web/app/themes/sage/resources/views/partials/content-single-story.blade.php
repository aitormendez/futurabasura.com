<article @php(post_class('top-0 bg-white md:bg-transparent'))>
  <header>
    <div class="thumb-wrap md:bg-white mb-20">
      <div class="thumb md:ml-[20vw] md:max-w-[50vw]">
        @if (has_post_thumbnail())
          {!! get_the_post_thumbnail(null, 'large') !!}
        @endif
      </div>
    </div>
    <aside>
      <a href="/stories" class="leading-none md:absolute page-header-font text-azul ml-7 md:ml-0">
        {!! __('News', 'sage') !!}
      </a>
    </aside>
    <h1 class="leading-none px-7 entry-title page-header-font md:mb-6 md:px-0 md:ml-[20vw] md:max-w-[50vw]">
      {!! $title !!}
    </h1>

    @include('partials/entry-meta')
  </header>

  <div class="font-serif leading-tight entry-content bg-white md:mt-3 pt-6">
    <div class="md:ml-[20vw] md:max-w-[50vw] prose">
      @php(the_content())
    </div>
  </div>

  @php(comments_template())
</article>
