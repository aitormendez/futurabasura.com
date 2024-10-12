<footer class="mt-20 flex flex-wrap">

    <div class="flex w-full flex-wrap bg-white font-bugrino font-light md:w-1/2 md:text-xl lg:text-2xl">
        <ul class="h-[40vw] w-1/2 border-b-2 border-r-2 border-black p-6 md:h-[20vw]">
            @foreach ($contents_nav as $item)
                <li>
                    <a href="{{ $item->url }}" class="font-light hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
        <ul class="h-[40vw] w-1/2 border-b-2 border-black p-6 md:h-[20vw]">
            @foreach ($shop_nav as $item)
                <li>
                    <a href="{{ $item->url }}" class="hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
        <ul class="h-[40vw] w-1/2 border-r-2 border-black p-6 md:h-[20vw]">
            @foreach ($social_nav as $item)
                <li>
                    <a href="{{ $item->url }}" class="hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
        <ul class="h-[40vw] w-1/2 p-6 md:h-[20vw]">
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
            <img class="w-1/2" src="@asset('images/logo-fb.svg')">
        </div>
        <div class="mb-[3vw] text-center text-xl font-light">
            {!! wpautop(get_field('footer_texto_mancha', 'option')) !!}
        </div>
    </div>
    {{-- /desktop --}}

    {{-- mobile --}}
    <div class="flex w-full flex-wrap font-bugrino md:hidden">
        <div class="arriba my-4 flex h-[50vw] w-full flex-wrap">
            <div class="izq flex w-1/2 items-stretch justify-end bg-white">
                <div class="w-[10vw] border-r-2 border-black"
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

    {{-- desktop --}}
    <div class="my-6 hidden w-full flex-wrap bg-white pb-6 md:flex">
        <ul class="mb-20 flex w-full justify-center gap-4 p-6 font-bugrino text-xl">
            @foreach ($legal_nav as $item)
                <li class="">
                    <a href="{{ $item->url }}" class="font-light hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>

        <div class="w-2/3 pl-6">
            <div class="text-lg">
                {!! wpautop(get_field('footer_texto_legal', 'option')) !!}
            </div>

            <div class="mt-12 flex flex-col gap-4 tracking-widest md:!flex-row">
                <div class="max-w-[600px] text-xs uppercase">
                    {!! get_field('footer_creditos', 'option') !!}
                </div>
                <div class="max-w-[600px] text-xs uppercase">
                    {!! get_field('footer_creditos_2col', 'option') !!}
                </div>
            </div>
        </div>
        <div class="flex w-1/3 flex-col items-end justify-between pr-6">
            <a class="hover:text-azul" href="https://www.instagram.com/futurabasura/">
                <x-fab-instagram class="w-8" alt="instagram" />
            </a>
            <a href="mailto:alwaysopen@futurabasura.com"
                class="email font-arialblack text-xl hover:text-azul">alwaysopen@futurabasura.com</a>
        </div>

        <div class="iconos mt-16 flex w-full justify-center gap-8">
            <x-fab-cc-visa class="w-12" alt="Visa" />
            <x-custom-paypal class="w-16" alt="Bizum" />
            <x-fab-cc-mastercard class="w-12" alt="Mastercard" />
            <x-fab-apple-pay class="w-14" alt="Apple Pay" />
            <x-fab-google-pay class="w-14" alt="Google Pay" />
            <x-custom-bizum class="w-20" alt="Bizum" />
        </div>
    </div>
    {{-- /desktop --}}

    {{-- mobile --}}
    <div class="flex w-full flex-wrap bg-white md:!hidden">
        <div class="arriba flex h-[20px] w-full flex-wrap">
            <div class="izq flex w-1/2 items-stretch justify-end bg-white">
                <div class="w-[10vw] border-r-2 border-black"
                    style="background-color: {{ get_field('footer_color', 'option') }}"></div>
            </div>
            <div class="der flex w-1/2 items-center justify-center"
                style="background-color: {{ get_field('footer_color', 'option') }}">
            </div>
        </div>

        <ul class="flex w-1/2 flex-col px-6 font-bugrino">
            @foreach ($legal_nav as $item)
                <li class="">
                    <a href="{{ $item->url }}" class="font-light hover:text-azul">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>

        <div class="mt-6 w-full pl-6 text-sm">
            <a href="mailto:alwaysopen@futurabasura.com"
                class="email font-arialblack hover:text-azul">alwaysopen@futurabasura.com</a>
        </div>

        <div class="iconos mt-16 flex w-full justify-center gap-4 px-6">
            <x-fab-cc-visa class="w-12" alt="Visa" />
            <x-custom-paypal class="w-16" alt="Bizum" />
            <x-fab-cc-mastercard class="w-12" alt="Mastercard" />
            <x-fab-apple-pay class="w-14" alt="Apple Pay" />
            <x-fab-google-pay class="w-14" alt="Google Pay" />
            <x-custom-bizum class="w-20" alt="Bizum" />
        </div>

        <div class="w-full p-6 text-xs">
            <div>
                {!! wpautop(get_field('footer_texto_legal', 'option')) !!}
            </div>
            <div class="mt-12 max-w-[600px] text-xs uppercase">
                {!! get_field('footer_creditos', 'option') !!}
            </div>
            <div class="mt-12 max-w-[600px] text-xs uppercase">
                {!! get_field('footer_creditos_2col', 'option') !!}
            </div>
        </div>
    </div>
    {{-- /mobile --}}

</footer>
