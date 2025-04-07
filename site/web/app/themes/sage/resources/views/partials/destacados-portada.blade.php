@php 
$bgc = $destacado['fondo'] ?? '' ;
$ct = $destacado['color_texto'] ?? '' ;
@endphp

<article class="mb-6 {{ $destacado['post_type'] }} {{ $destacado['formato'] }}">

  {{-- IMAGEN --}}
  @if ($destacado['formato'] === 'imagen')
    <a href="{{ $destacado['link'] }}" class="flex flex-wrap w-full text-black bg-white md:justify-between md:flex-nowrap" style="background-color: {{ $bgc }}; color: {{ $ct }}">
      <header class="w-full p-6 col-datos md:flex md:flex-col md:justify-between">
        <div class="arriba">
          <div class="font-serif text-lg font-bold capitalize meta">{{ $destacado['post_type'] }}</div>
          <h2 class="my-6 text-2xl tracking-widest">{{ $destacado['title'] }}</h2>
        </div>
        <div class="tracking-wide excerpt">
          {!! $destacado['excerpt'] !!}
        </div>
      </header>
      @if ($destacado['has_img'])
        <div class="img">
          <img src="{!! $destacado['url'] !!}" srcset="{!! $destacado['srcset'] !!}" alt="{!! $destacado['alt'] !!}" sizes="(max-width: 768px) 100vw, 40vw">
        </div>
      @endif
    </a>
  @endif

  {{-- IMAGEN GRANDE--}}
  @if ($destacado['formato'] === 'imagen_grande')
    <a href="{{ $destacado['link'] }}" class="flex flex-wrap w-full text-black bg-white md:justify-center md:items-center" style="background-color: {{ $bgc }}; color: {{ $ct }}">
      <header class="w-full p-6 col-datos md:absolute md:bg-white md:flex md:flex-col md:justify-between md:flex-wrap">
        <div class="w-full font-serif text-lg font-bold capitalize meta">{{ $destacado['post_type'] }}</div>
        <h2 class="w-full mt-12 mb-12 text-2xl tracking-widest text-center md:mt-0">{{ $destacado['title'] }}</h2>
        <div class="self-end tracking-wide text-center excerpt">
          {!! $destacado['excerpt'] !!}
        </div>
      </header>
      @if ($destacado['has_img'])
        <div class="overflow-hidden img md:max-h-screen">
          <img src="{!! $destacado['url'] !!}" srcset="{!! $destacado['srcset'] !!}" alt="{!! $destacado['alt'] !!}" sizes="100vw">
        </div>
      @endif
    </a>
  @endif

  {{-- MOSAICO --}}
  @if ($destacado['formato'] === 'mosaico')
    <a href="{{ $destacado['link'] }}" class="flex flex-wrap w-full text-black bg-white md:justify-between md:flex-nowrap" style="background-color: {{ $bgc }}; color: {{ $ct }}">
      <header class="w-full p-6 col-datos md:flex md:flex-col md:justify-between">
        <div class="arriba">
          <div class="font-serif text-lg font-bold capitalize meta">{{ $destacado['post_type'] }}</div>
          <h2 class="my-6 text-2xl tracking-widest">{{ $destacado['title'] }}</h2>
        </div>
        <div class="tracking-wide excerpt">
          {!! $destacado['excerpt'] !!}
        </div>
      </header>
      @if ($destacado['has_msc'])
        <div class="flex flex-wrap items-start msc">
          @foreach ($destacado['mosaico'] as $img)
            <img class="w-2/4" src="{!! $img['url'] !!}" alt="{!! $img['alt'] !!}" sizes="(max-width: 768px) 50vw, 20vw">
          @endforeach
        </div>
      @endif
    </a>
  @endif

  {{-- GALERIA --}}
  @if ($destacado['formato'] === 'galeria')
    <a href="{{ $destacado['link'] }}" class="flex flex-wrap w-full text-black bg-white md:justify-between md:flex-nowrap" style="background-color: {{ $bgc }}; color: {{ $ct }}">
      <header class="w-full p-6 col-datos md:flex md:flex-col md:justify-between">
        <div class="arriba">
          <div class="font-serif text-lg font-bold capitalize meta">{{ $destacado['post_type'] }}</div>
          <h2 class="my-6 text-2xl tracking-widest">{{ $destacado['title'] }}</h2>
        </div>
        <div class="tracking-wide excerpt">
          {!! $destacado['excerpt'] !!}
        </div>
      </header>
      @if ($destacado['has_gal'])

      <div class="contenedor-slider">
        <div class="glide">
          <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">

              @foreach ($destacado['galeria'] as $img)
              <li class="glide__slide">
                <img class="" src="{!! $img['url'] !!}" alt="{!! $img['alt'] !!}" sizes="(max-width: 768px) 100vw, 40vw">
              </li>
              @endforeach

            </ul>
          </div>
        </div>
      </div>



      @endif
    </a>
  @endif

  {{-- REPETICION --}}
  @if ($destacado['formato'] === 'repeticion')
    <a href="{{ $destacado['link'] }}" class="flex flex-wrap w-full text-black bg-white md:justify-between md:flex-nowrap" style="background-color: {{ $bgc }}; color: {{ $ct }}">

      @if ($destacado['has_img'])
        <div class="img">
          <img src="{!! $destacado['url'] !!}" srcset="{!! $destacado['srcset'] !!}" alt="{!! $destacado['alt'] !!}" sizes="(max-width: 768px) 100vw, 40vw">
        </div>
      @endif


      <div class="relative overflow-hidden clip">
        @for ($a = 0; $a < 6; $a++)
          <div class="relative linea">
            @for ($i = 0; $i < 10; $i++)
              <span class="inline-block mx-6 text-2xl tracking-widest title-repetido">{{ $destacado['title'] }}</span>
            @endfor
          </div>
        @endfor
        @if ($destacado['post_type'] === 'Shop')
          <div class="absolute bottom-0 w-full p-6 font-serif text-center bg-white sm:text-3xl artista-producto">
            By {!! $destacado['artist'] !!}
          </div>
        @endif
      </div>

    </a>
  @endif


</article>

