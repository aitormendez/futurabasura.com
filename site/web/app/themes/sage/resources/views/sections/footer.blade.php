<footer class="mt-20 flex flex-wrap">

    <div class="flex w-full flex-wrap bg-white font-bugrino text-sm font-light md:w-1/2 md:text-xl lg:text-2xl">
        <ul class="h-[40vw] w-1/2 border-b border-r border-black p-3 md:h-[20vw] md:border-b-2 md:border-r-2 md:p-6">
            @foreach ($contents_nav as $item)
                <li>
                    <a href="{{ $item->url }}" class="font-light hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
        <ul class="h-[40vw] w-1/2 border-b border-black p-3 md:h-[20vw] md:border-b-2 md:p-6">
            @foreach ($shop_nav as $item)
                <li>
                    <a href="{{ $item->url }}" class="hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
        <ul class="h-[40vw] w-1/2 border-r border-black p-3 md:h-[20vw] md:border-r-2 md:p-6">
            @foreach ($social_nav as $item)
                <li>
                    <a href="{{ $item->url }}" class="hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
        <ul class="h-[40vw] w-1/2 p-3 md:h-[20vw] md:p-6">
            @foreach ($footer_pages_nav as $item)
                <li>
                    <a href="{{ $item->url }}" class="hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- desktop --}}
    <div class="hidden w-1/2 flex-col items-center justify-between border-l-2 border-black p-6 font-bugrino md:flex"
        style="background-color: {{ get_field('footer_color', 'option') }}">
        <div class="mt-[5vw] w-1/3">
            <img class="w-full" src="@asset('images/logo-fb.svg')">
        </div>
        <div class="mb-[3vw] text-center text-xl font-light">
            {!! wpautop(get_field('footer_texto_mancha', 'option')) !!}
        </div>
    </div>
    {{-- /desktop --}}

    {{-- mobile --}}
    <div class="flex w-full flex-wrap font-bugrino md:!hidden">
        <div class="arriba mt-4 flex h-[50vw] w-full flex-wrap">
            <div class="izq flex w-1/2 items-stretch justify-end bg-white">
                <div class="w-[10vw] border-r border-black"
                    style="background-color: {{ get_field('footer_color', 'option') }}"></div>
            </div>
            <div class="der flex w-1/2 items-center justify-center"
                style="background-color: {{ get_field('footer_color', 'option') }}">
                <img class="w-1/2" src="@asset('images/logo-fb.svg')">
            </div>
        </div>
    </div>
    {{-- /mobile --}}

    @include('partials.mailchimp-form')

    <div class="flex w-full flex-wrap bg-white">
        <ul class="mt-8 flex flex-col px-6 text-sm md:!flex-row md:gap-4">
            @foreach ($legal_nav as $item)
                <li class="">
                    <a href="{{ $item->url }}" class="font-light">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>

        <div class="mt-6 w-full justify-between px-6 text-sm md:flex">
            <a href="mailto:alwaysopen@futurabasura.com"
                class="email font-arialblack hover:text-azul">alwaysopen@futurabasura.com</a>
            <a class="mt-4 block hover:text-azul md:mt-0" target="_blank"
                href="https://www.instagram.com/futurabasura/">
                <x-fab-instagram class="w-7" alt="instagram" />
            </a>
        </div>


        <div class="w-full p-6 text-sm">
            <div class="max-w-[55%]">
                {!! wpautop(get_field('footer_texto_legal', 'option')) !!}
            </div>
            <div class="mt-12 max-w-[600px] text-xs uppercase md:text-[0.65rem]">
                {!! get_field('footer_creditos', 'option') !!}
                {!! get_field('footer_creditos_2col', 'option') !!}
            </div>
        </div>

        <div class="iconos mb-16 flex w-full justify-center gap-4 px-6">
            <x-fab-cc-visa class="w-10" alt="Visa" />
            <x-custom-paypal class="w-14" alt="Paypal" />
            <x-fab-cc-mastercard class="w-10" alt="Mastercard" />
            <x-fab-apple-pay class="w-12" alt="Apple Pay" />
            <x-fab-google-pay class="w-12" alt="Google Pay" />
            {{-- <x-custom-bizum class="w-20" alt="Bizum" /> --}}
        </div>
    </div>

</footer>
