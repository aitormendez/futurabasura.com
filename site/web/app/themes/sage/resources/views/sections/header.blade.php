<div id="solapa"
    class="pointer-events-none fixed top-0 z-40 flex h-screen w-screen flex-col flex-wrap items-center justify-center bg-white md:flex-row">
    <ul class="contenidos my-4 flex flex-col items-center md:mx-12">
        @if (!empty($contents_nav))
            @foreach ($contents_nav as $item)
                <li class="border border-black">
                    <a href="{{ $item->url }}"
                        class="inline-block bg-white px-4 pb-2 pt-3 text-sm uppercase tracking-widest text-black hover:bg-allo sm:text-xl">{{ $item->label }}</a>
                </li>
            @endforeach
        @endif
    </ul>
    {{-- <ul class="my-4 shop flex flex-col items-center md:mx-12">
        @if (!empty($shop_nav))
        @foreach ($shop_nav as $item)
        <li class="border border-black">
            <a href="{{ $item->url }}"
                class="inline-block px-4 pt-3 pb-2 text-sm tracking-widest text-black bg-white hover:bg-allo uppercase sm:text-xl">{{
                $item->label }}</a>
        </li>
        @endforeach
        @endif
    </ul> --}}
    <ul class="social my-4 flex flex-col items-center md:mx-12">
        @if (!empty($social_nav))
        @endif
        @foreach ($social_nav as $item)
            <li class="border border-black">
                <a href="{{ $item->url }}"
                    class="inline-block bg-white px-4 pb-2 pt-3 text-sm uppercase tracking-widest text-black hover:bg-allo sm:text-xl">{{ $item->label }}</a>
            </li>
        @endforeach

    </ul>
    {{-- <ul class="my-4 info  flex flex-col items-center md:mx-12">
        @if (!empty($info_nav))
        @foreach ($info_nav as $item)
        <li class="border border-black">
            <a href="{{ $item->url }}"
                class="inline-block px-4 pt-3 pb-2 text-sm tracking-widest text-black bg-white hover:bg-allo uppercase sm:text-xl">{{
                $item->label }}</a>
        </li>
        @endforeach
        @endif
    </ul> --}}
    <a id="btn-close" href="#" class="btn absolute right-8 top-8 inline-block hover:bg-allo">CLOSE</a>
</div>

<header class="banner top-0 z-30 flex w-full font-sans">
    <nav class="w-full">
        <ul class="flex">
            <li class="li-brand inline-block max-w-[60%] p-4 sm:block sm:pt-8">
                <a id="brand" class="brand nav-item hover:text-allo"" href=" {{ home_url('/') }}">
                    {{ $frase }}
                </a>
            </li>
            @if (!empty($primary_nav))
                @foreach ($primary_nav as $item)
                    <li class="li-shop p-4 sm:pt-8">
                        <a href="{{ $item->url }}" class="nav-item hover:text-allo">{{ $item->label }}</a>
                    </li>
                @endforeach
            @endif
            <li class="li-cart">
                <a href="/cart" class="cart-link nav-item flex hover:text-allo">
                    <div
                        class="cart flex flex-shrink flex-grow items-center justify-end bg-white pl-8 pr-8 sm:items-start sm:pt-8">
                        <span>cart</span>
                    </div>
                    <div class="hole flex flex-col">
                        <div class="num-items bg-white text-center font-serif font-bold text-azul">
                            {{ $items_cart }}
                        </div>
                        <div class="hole-cell">
                            {!! file_get_contents(get_theme_file_path('resources/images/cart-hole-min.svg')) !!}
                        </div>
                        <div class="espacio bg-white"></div>
                    </div>
                    <div class="espacio bg-white"></div>
                </a>
            </li>
            <li id="li-btn-menu" class="li-menu absolute block sm:static sm:pt-6">
                <a href="#" id="btn-menu" class="btn block hover:bg-allo">MENU</a>
            </li>
        </ul>
    </nav>
</header>
