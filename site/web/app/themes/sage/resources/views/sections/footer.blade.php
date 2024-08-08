<footer class="flex flex-wrap">
  
    <div class="flex flex-wrap w-full md:w-1/2 bg-white font-bugrino md:text-xl">
        <ul class="w-1/2 h-[50vw] md:h-[25vw] p-6 border-r border-b border-black">
            @foreach ($contents_nav as $item)
                <li>
                    <a href="{{ $item->url }}" class="hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
        <ul class="w-1/2 h-[50vw] md:h-[25vw] p-6 border-b border-black">
            @foreach ($shop_nav as $item)
                <li>
                    <a href="{{ $item->url }}" class="hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
        <ul class="w-1/2 h-[50vw] md:h-[25vw] p-6  border-r border-black">
            @foreach ($social_nav as $item)
                <li>
                    <a href="{{ $item->url }}" class="hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
        <ul class="w-1/2 h-[50vw] md:h-[25vw] p-6">
            @foreach ($footer_pages_nav as $item)
                <li>
                    <a href="{{ $item->url }}" class="hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- desktop --}}
    <div class="hidden md:flex flex-col justify-between items-center w-full md:w-1/2 md:border-l border-black p-6 font-bugrino" style="background-color: {{ get_field('footer_color', 'option') }}">
        <div class="w-1/3 mt-[3vw]">
            @svg('images.logo-fb')
        </div>
        <div class="text-xl text-center mb-[3vw]">
            {!! wpautop(get_field('footer_texto_mancha', 'option')) !!}
        </div>
    </div>

    {{-- mobile --}}
    <div class="flex md:!hidden flex-wrap w-full font-bugrino">
        <div class="arriba flex flex-wrap w-full h-[50vw] my-4">
            <div class="izq flex justify-end items-stretch w-1/2 bg-white">
                <div class="w-[10vw] border-r border-black" style="background-color: {{ get_field('footer_color', 'option') }}"></div>

            </div>
            <div class="der flex justify-center items-center w-1/2" style="background-color: {{ get_field('footer_color', 'option') }}">
                    @svg('images.logo-fb', 'w-1/2')
            </div>
        </div>
        <div class="abajo flex flex-wrap w-full h-[50vw] mb-4">
            <div class="izq flex justify-end items-stretch w-1/2 bg-white">
                <div class="w-[10vw] border-r border-black" style="background-color: {{ get_field('footer_color', 'option') }}"></div>

            </div>
            <div class="der flex w-1/2 text-sm p-4" style="background-color: {{ get_field('footer_color', 'option') }}">
                {!! wpautop(get_field('footer_texto_mancha', 'option')) !!}
            </div>
        </div>
    </div>


    <div class="flex justify-center w-full mb-10 footer-hole">@svg('images.hole-outline')</div>

    {{-- <div class="w-full max-w-screen-md px-4 mx-auto formulario">
        <div class="flex flex-wrap items-center px-6 py-4 bg-white border border-black sm:flex-nowrap formu">
            <h3 class="text-sm tracking-widest sm:mr-10">NEWSLETTER</h3>
            {!! do_shortcode('[mc4wp_form id="474"]') !!}
        </div>
    </div> --}}
</footer>
