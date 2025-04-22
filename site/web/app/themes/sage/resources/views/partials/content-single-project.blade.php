<article @php(post_class('top-0 bg-white md:bg-transparent'))>
    <header>
        <div class="thumb-wrap mb-20 md:bg-white">
            <div class="thumb md:ml-[20vw] md:max-w-[50vw]">
                @if (has_post_thumbnail())
                    {!! get_the_post_thumbnail(null, 'large') !!}
                @endif
            </div>
        </div>
        <aside>
            <a href="/projects" class="page-header-font text-azul ml-7 leading-none md:absolute md:ml-4">
                {!! __('Projects', 'sage') !!}
            </a>
        </aside>
        <h1 class="entry-title page-header-font px-7 leading-none md:mb-6 md:ml-[20vw] md:max-w-[50vw] md:px-0">
            {!! $title !!}
        </h1>

        @include('partials/entry-meta')
    </header>

    <div class="entry-content bg-white px-6 pt-6 font-serif leading-tight md:mt-3 md:px-0">
        <div class="prose md:ml-[20vw] md:max-w-[50vw]">
            @php(the_content())
        </div>
    </div>

    @php(comments_template())
</article>
