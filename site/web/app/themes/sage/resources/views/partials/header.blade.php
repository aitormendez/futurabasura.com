<div id="solapa" class="fixed top-0 z-40 w-screen h-screen py-8 pl-0 pr-8 bg-white sm:pr-16 sm:py-16">
    <ul class="my-4 contents">
        @foreach ($contents_nav as $item)
            <li class="">
                <a href="{{ $item->url }}"
                    class="text-sm tracking-widest text-black uppercase sm:text-xl">{{ $item->label }}</a>
            </li>
        @endforeach
    </ul>
    <ul class="my-4 shop">
        @foreach ($shop_nav as $item)
            <li class="">
                <a href="{{ $item->url }}"
                    class="text-sm tracking-widest text-black uppercase sm:text-xl">{{ $item->label }}</a>
            </li>
        @endforeach
    </ul>
    <ul class="my-4 social">
        @foreach ($social_nav as $item)
            <li class="">
                <a href="{{ $item->url }}"
                    class="text-sm tracking-widest text-black uppercase sm:text-xl">{{ $item->label }}</a>
            </li>
        @endforeach
    </ul>
    <ul class="my-4 info">
        @foreach ($info_nav as $item)
            <li class="">
                <a href="{{ $item->url }}"
                    class="text-sm tracking-widest text-black uppercase sm:text-xl">{{ $item->label }}</a>
            </li>
        @endforeach
    </ul>
    <a id="btn-close" href="#" class="absolute inline-block right-8 top-8 btn hover:bg-allo">CLOSE</a>
</div>

<header class="top-0 z-30 flex w-full banner">
    <nav class="w-full">
        <ul class="flex">
            <li class="inline-block p-4 li-brand sm:block sm:pt-8">
                <a id="brand" class="brand nav-item hover:text-allo"" href="{{ home_url('/') }}">
                    {{ $frase }}
                </a>
            </li>
            @foreach ($primary_nav as $item)
                <li class="p-4 li-shop sm:pt-8">
                    <a href="{{ $item->url }}" class="nav-item hover:text-allo">{{ $item->label }}</a>
                </li>
            @endforeach
            <li class="li-cart">
                <a href="/cart" class="flex cart-link nav-item hover:text-allo">
                    <div
                        class="flex items-center justify-end flex-grow flex-shrink pl-8 pr-8 bg-white cart sm:items-start sm:pt-8">
                        <span>cart</span>
                    </div>
                    <div class="flex flex-col hole">
                        <div class="font-serif font-bold text-center bg-white num-items text-azul">
                            {{ $items_cart }}
                        </div>
                        <div class="hole-cell">
                            @svg('images.cart-hole-min')
                        </div>
                        <div class="bg-white espacio"></div>
                    </div>
                    <div class="bg-white espacio"></div>
                </a>
            </li>
            <li id="li-btn-menu" class="absolute block li-menu sm:static sm:pt-6">
                <a href="#" id="btn-menu" class="block btn hover:bg-allo">MENU</a>
            </li>
        </ul>
    </nav>
</header>
