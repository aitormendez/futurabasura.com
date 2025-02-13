<div id="solapa"
    class="bg-fondo-medio bg-10px pointer-events-none fixed top-0 z-40 flex h-screen w-screen flex-col flex-wrap items-center justify-center bg-white opacity-0 md:flex-row">
    <ul class="contenidos my-4 flex flex-col items-center md:mx-12">
        @if (!empty($contents_nav))
            @foreach ($contents_nav as $item)
                <li class="border border-black">
                    <a href="{{ $item->url }}"
                        class="hover:bg-allo inline-block bg-white px-4 pb-2 pt-3 text-sm uppercase tracking-widest text-black sm:text-xl">{{ $item->label }}</a>
                </li>
            @endforeach
        @endif
    </ul>
    <ul class="social my-4 flex flex-col items-center md:mx-12">
        @if (!empty($social_nav))
            @foreach ($social_nav as $item)
                <li class="border border-black">
                    <a href="{{ $item->url }}"
                        class="hover:bg-allo inline-block bg-white px-4 pb-2 pt-3 text-sm uppercase tracking-widest text-black sm:text-xl">{{ $item->label }}</a>
                </li>
            @endforeach
        @endif

    </ul>
    <a id="btn-close" href="#" class="btn hover:bg-allo absolute right-8 top-8 inline-block">CLOSE</a>
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
                <a href="/cart" class="cart-link nav-item hover:text-allo flex">
                    <div
                        class="cart flex flex-shrink flex-grow items-center justify-end bg-white pl-8 pr-8 sm:items-start sm:pt-8">
                        <span>cart</span>
                    </div>
                    <div class="hole flex flex-col">
                        <div class="num-items text-azul bg-white text-center font-serif font-bold">
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
                <a href="#" id="btn-menu" class="btn hover:bg-allo block">MENU</a>
            </li>
        </ul>
    </nav>
</header>
