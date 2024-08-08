<footer class="flex flex-wrap">
  
    <div class="flex flex-wrap w-full md:w-1/2 bg-white font-bugrino md:text-xl font-light">
        <ul class="w-1/2 h-[50vw] md:h-[25vw] p-6 border-r-2 border-b-2 border-black">
            @foreach ($contents_nav as $item)
                <li>
                    <a href="{{ $item->url }}" class="hover:text-azul font-light">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
        <ul class="w-1/2 h-[50vw] md:h-[25vw] p-6 border-b-2 border-black">
            @foreach ($shop_nav as $item)
                <li>
                    <a href="{{ $item->url }}" class="hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
        <ul class="w-1/2 h-[50vw] md:h-[25vw] p-6 border-r-2 border-black">
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
    <div class="hidden md:flex flex-col justify-between items-center w-1/2 border-l-2 border-black p-6 font-bugrino" style="background-color: {{ get_field('footer_color', 'option') }}">
        <div class="w-1/3 mt-[5vw]">
            @svg('images.logo-fb')
        </div>
        <div class="text-xl text-center mb-[3vw] font-light">
            {!! wpautop(get_field('footer_texto_mancha', 'option')) !!}
        </div>
    </div>
    {{-- /desktop --}}

    {{-- mobile --}}
    <div class="flex md:!hidden flex-wrap w-full font-bugrino">
        <div class="arriba flex flex-wrap w-full h-[50vw] my-4">
            <div class="izq flex justify-end items-stretch w-1/2 bg-white">
                <div class="w-[10vw] border-r border-black border-2" style="background-color: {{ get_field('footer_color', 'option') }}"></div>
            </div>
            <div class="der flex justify-center items-center w-1/2" style="background-color: {{ get_field('footer_color', 'option') }}">
                    @svg('images.logo-fb', 'w-1/2')
            </div>
        </div>
        <div class="abajo flex flex-wrap w-full h-[50vw]">
            <div class="izq flex justify-end items-stretch w-1/2 bg-white">
                <div class="w-[10vw] border-r border-black border-2" style="background-color: {{ get_field('footer_color', 'option') }}"></div>
            </div>
            <div class="der flex w-1/2 text-sm p-4" style="background-color: {{ get_field('footer_color', 'option') }}">
                {!! wpautop(get_field('footer_texto_mancha', 'option')) !!}
            </div>
        </div>
    </div>
    {{-- /mobile --}}

    <div class="flex justify-center w-full mb-10 footer-hole my-12 md:my-20">@svg('images.hole-outline', 'w-1/2 md:w-[15vw]')</div>

    {{-- desktop --}}
    <div class="hidden md:flex flex-wrap bg-white w-full my-6 pb-6">
        <ul class="p-6 font-bugrino flex gap-4 w-full text-xl justify-center mb-20">
            @foreach ($legal_nav as $item)
                <li class="">
                    <a href="{{ $item->url }}" class="hover:text-azul font-light">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>

        <div class="w-2/3 pl-6">
            <div>
                {!! wpautop(get_field('footer_texto_legal', 'option')) !!}
            </div>
            <div class="columns-2 mt-12 text-xs uppercase max-w-[600px]">
                {!! get_field('footer_creditos', 'option') !!}
            </div>
        </div>
        <div class="flex flex-col w-1/3 items-end pr-6 justify-between">
            <a class="hover:text-azul" href="https://www.instagram.com/futurabasura/">
                <x-fab-instagram class="w-8" alt="instagram"/>
            </a>
            <a href="mailto:alwaysopen@futurabasura.com" class="email font-arialblack hover:text-azul">alwaysopen@futurabasura.com</a>
        </div>

        <div class="iconos w-full flex justify-center mt-16 gap-8">
            <x-fab-cc-visa class="w-12" alt="Visa"/>
            <x-custom-paypal class="w-16" alt="Bizum"/>
            <x-fab-cc-mastercard class="w-12" alt="Mastercard"/>
            <x-fab-apple-pay class="w-14" alt="Apple Pay"/>
            <x-fab-google-pay class="w-14" alt="Google Pay"/>
            <x-custom-bizum class="w-20" alt="Bizum"/>
        </div>
    </div>
    {{-- /desktop --}}

    {{-- mobile --}}
    <div class="flex md:!hidden flex-wrap w-full bg-white">
        <div class="arriba flex flex-wrap w-full h-[20px]">
            <div class="izq flex justify-end items-stretch w-1/2 bg-white">
                <div class="w-[10vw] border-r border-black border-2" style="background-color: {{ get_field('footer_color', 'option') }}"></div>
            </div>
            <div class="der flex justify-center items-center w-1/2" style="background-color: {{ get_field('footer_color', 'option') }}">
            </div>
        </div>

        <ul class="px-6 font-bugrino flex flex-col w-1/2">
            @foreach ($legal_nav as $item)
                <li class="">
                    <a href="{{ $item->url }}" class="hover:text-azul font-light">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>

        <div class="w-full text-sm pl-6 mt-6">
            <a href="mailto:alwaysopen@futurabasura.com" class="email font-arialblack hover:text-azul">alwaysopen@futurabasura.com</a>
        </div>

        <div class="iconos w-full flex justify-center mt-16 gap-4 px-6">
            <x-fab-cc-visa class="w-12" alt="Visa"/>
            <x-custom-paypal class="w-16" alt="Bizum"/>
            <x-fab-cc-mastercard class="w-12" alt="Mastercard"/>
            <x-fab-apple-pay class="w-14" alt="Apple Pay"/>
            <x-fab-google-pay class="w-14" alt="Google Pay"/>
            <x-custom-bizum class="w-20" alt="Bizum"/>
        </div>

        <div class="w-full p-6 text-xs">
            <div>
                {!! wpautop(get_field('footer_texto_legal', 'option')) !!}
            </div>
            <div class="columns-2 mt-12 text-xs uppercase max-w-[600px]">
                {!! get_field('footer_creditos', 'option') !!}
            </div>
        </div>
    </div>
    {{-- /mobile --}}


    {{-- <div class="w-full max-w-screen-md px-4 mx-auto formulario">
        <div class="flex flex-wrap items-center px-6 py-4 bg-white border border-black sm:flex-nowrap formu">
            <h3 class="text-sm tracking-widest sm:mr-10">NEWSLETTER</h3>
            {!! do_shortcode('[mc4wp_form id="474"]') !!}
        </div>
    </div> --}}
</footer>
