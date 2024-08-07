<div id="solapa" class="fixed top-0 z-40 w-screen h-screen bg-white pointer-events-none flex flex-col justify-center items-center md:flex-row flex-wrap">
  <ul class="my-4 contenidos flex flex-col items-center md:mx-12">
    @if (!empty($contents_nav))
        @foreach ($contents_nav as $item)
            <li class="border">
                <a href="{{ $item->url }}"
                    class="inline-block px-4 pt-3 pb-2 text-sm tracking-widest text-black bg-white hover:bg-allo uppercase sm:text-xl">{{ $item->label }}</a>
            </li>
        @endforeach  
    @endif
  </ul>
  <ul class="my-4 shop flex flex-col items-center md:mx-12">
    @if (!empty($shop_nav))        
        @foreach ($shop_nav as $item)
            <li class="border">
                <a href="{{ $item->url }}"
                    class="inline-block px-4 pt-3 pb-2 text-sm tracking-widest text-black bg-white hover:bg-allo uppercase sm:text-xl">{{ $item->label }}</a>
            </li>
        @endforeach
    @endif
  </ul>
  <ul class="my-4 social  flex flex-col items-center md:mx-12">
    @if (!empty($social_nav))
    @endif
      @foreach ($social_nav as $item)
          <li class="border">
              <a href="{{ $item->url }}"
                  class="inline-block px-4 pt-3 pb-2 text-sm tracking-widest text-black bg-white hover:bg-allo uppercase sm:text-xl">{{ $item->label }}</a>
          </li>
      @endforeach
        
  </ul>
  {{-- <ul class="my-4 info  flex flex-col items-center md:mx-12">
    @if (!empty($info_nav))
        @foreach ($info_nav as $item)
            <li class="border">
                <a href="{{ $item->url }}"
                    class="inline-block px-4 pt-3 pb-2 text-sm tracking-widest text-black bg-white hover:bg-allo uppercase sm:text-xl">{{ $item->label }}</a>
            </li>
        @endforeach
    @endif
  </ul> --}}
  <a id="btn-close" href="#" class="absolute inline-block right-8 top-8 btn hover:bg-allo">CLOSE</a>
</div>

<header class="top-0 z-30 flex w-full banner">
  <nav class="w-full">
      <ul class="flex">
          <li class="inline-block p-4 li-brand sm:block sm:pt-8 max-w-[70%]">
              <a id="brand" class="brand nav-item hover:text-allo"" href="{{ home_url('/') }}">
                  {{ $frase }}
              </a>
          </li>
          @if (!empty($primary_nav))              
            @foreach ($primary_nav as $item)
                <li class="p-4 li-shop sm:pt-8">
                    <a href="{{ $item->url }}" class="nav-item hover:text-allo">{{ $item->label }}</a>
                </li>
            @endforeach
          @endif
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
