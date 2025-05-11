@if (is_front_page())
    <div class="is-content-width md:px-none pb-6 pt-0 text-xl md:pb-20">
        @php the_content() @endphp

        @include('partials.cupones')


        @include('partials.slider')

        @if ($destacados['has_posts'] = true)
            <section id="destacados" class="alignfull">
                @foreach ($destacados['posts'] as $destacado)
                    @include('partials.destacados-portada')
                @endforeach
            </section>
        @endif
    </div>
@elseif (is_page('cart') || is_page('checkout'))
    <div class="main is-content-width md:px-none w-full py-6 md:py-20">
        @php the_content() @endphp
    </div>
@else
    <div class="is-content-width md:px-none prose w-full bg-white py-6 md:py-20">
        @php the_content() @endphp
    </div>
@endif

@if ($pagination)
    <nav class="page-nav" aria-label="Page">
        {!! $pagination !!}
    </nav>
@endif
