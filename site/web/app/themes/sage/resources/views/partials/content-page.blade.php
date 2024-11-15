@if (is_front_page())
    <div class="contenido md:px-none prose prose-fb bg-white py-6 text-xl md:pb-20 md:pt-0">
        @php(the_content())
    </div>
@else
    <div class="contenido md:px-none prose prose-fb bg-white py-6 text-xl md:py-20">
        @php(the_content())
    </div>
@endif



@if ($pagination)
    <nav class="page-nav" aria-label="Page">
        {!! $pagination !!}
    </nav>
@endif
