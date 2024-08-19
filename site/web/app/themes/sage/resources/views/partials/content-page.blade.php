<div class="contenido prose bg-white prose-fb py-6 md:py-20 text-xl px-6 md:px-none">
  @php(the_content())
</div>


@if ($pagination)
  <nav class="page-nav" aria-label="Page">
    {!! $pagination !!}
  </nav>
@endif
