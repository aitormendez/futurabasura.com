{{-- Se usa en la portada de la tienda (archivo) --}}

@php
defined( 'ABSPATH' ) || exit;
global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
@endphp

<li class="inline-block producto infinite-scroll-item">
  <a href="{!! $producto['url'] !!}" class="relative block">
    <img src="{!! $producto['img_url'] !!}" alt="{!! $producto['title'] !!}" srcset="{!! $producto['img_srcset'] !!}" sizes="(max-width: 768px) 100vw, 25vw" class="block">
    <div class="inset-0 p-4 font-bold tracking-widest uppercase hover md:bg-negro-fb md:absolute md:text-white">
      <p class="mb-4">{{ $producto['title'] }}</p>
      <p class="mb-4">{{ $producto['artist'] }}</p>

      @if ($producto['product_type'] == 'simple')
        @if ($producto['has_format'])
          <p class="mb-4">{{ $producto['format'] }} cm</p>
        @endif
        @if ($producto['has_sale_price'])
          <p class="mb-4 text-red-600 line-through">{{ $producto['regular_price'] }} €</p>
          <p class="mb-4">{{ $producto['sale_price'] }} €</p>
        @else
          <p class="mb-4">{{ $producto['regular_price'] }} €</p>
        @endif
      @elseif($producto['product_type'] == 'variable')
        @foreach ($producto['variaciones'] as $v)
          @if ($v['sale_price'] != '')
            <p>{{ $v['format'] }} cm <span class="text-red-600 line-through">{{ $v['regular_price'] }} €</span> {{ $v['sale_price'] }} €</p>
          @else
          <p>{{ $v['format'] }} cm {{ $v['regular_price'] }} €</p>
          @endif
           
        @endforeach
      @endif


    </div>

  </a>
</li>
