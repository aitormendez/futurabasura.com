@if (is_front_page())
    <main id="main" class="main is-content-width md:px-none pb-6 pt-0 text-xl md:pb-20">
        @php the_content() @endphp
    </main id="main">
@else
    <main id="main" class="main is-content-width md:px-none prose w-full bg-white py-6 text-xl md:py-20">
        @php the_content() @endphp
    </main id="main">
@endif

@if ($pagination)
    <nav class="page-nav" aria-label="Page">
        {!! $pagination !!}
    </nav>
@endif
