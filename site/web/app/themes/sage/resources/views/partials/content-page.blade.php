<div class="contenido md:px-none prose prose-fb bg-white py-6 text-xl md:py-20">
    @php(the_content())
</div>


@if ($pagination)
    <nav class="page-nav" aria-label="Page">
        {!! $pagination !!}
    </nav>
@endif
