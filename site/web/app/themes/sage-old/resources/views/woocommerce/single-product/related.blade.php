@php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
@endphp

@if ( $related_products )

	<section class="order-3 w-full mt-40 related products">

    @if ( $artista['rand_products'])
      <h2 class="m-6 mt-10 font-bold tracking-widest text-center uppercase">By {{ $artista['artista']->name }}</h2>
      @foreach ($artista['rand_products'] as $product)
        <h3 class="px-6 py-1 bg-white"><a href="{{ $product['permalink'] }}">{{ $product['title'] }} by {{ $artista['artista']->name }}</a></h3>

        <div id="glide-{{ $product['product_id'] }}-art" class="glide g-by-artist">
          <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
            @foreach ($product['product_gallery'] as $img)
            <li class="glide__slide">
              <img class="block" src="{!! $img['att_url'] !!}" srcset="{!! $img['att_srcset'] !!}" @if ($img['has_alt']) alt="{!! $img['alt'][0] !!}" @endif sizes="(max-width: 792px) 100%, 20%">
            </li>
            @endforeach
            </ul>
          </div>
        </div>
      @endforeach
    @endif

		@php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'You may be interested', 'woocommerce' ) );
    @endphp

		@if ( $heading )
			<h2 class="m-6 mt-40 font-bold tracking-widest text-center uppercase">{{ $heading }}</h2>
		@endif

		@php woocommerce_product_loop_start() @endphp
      @foreach ( $related_products as $related_product )
        @php
          $product_id = $related_product->get_id();
          $product_title = $related_product->get_title();
          $product_permalink = $related_product->get_permalink();
          $post_object = get_post( $product_id );
          $attachment_ids = $related_product->get_gallery_image_ids();
          $artist = get_the_terms($product_id, 'artist');

          $output = array_map( function( $att_id ) {
            $meta = get_post_meta( $att_id );
            $array = [
                'att_url'    => wp_get_attachment_url( $att_id ),
                'att_srcset' => wp_get_attachment_image_srcset( $att_id ),
                'has_alt'    => false,
                'meta'       => $meta,
            ];
            if (array_key_exists('_wp_attachment_image_alt', $meta)) {
                $array['has_alt'] = true;
                $array['alt'] = $meta['_wp_attachment_image_alt'];
            }
            return $array;
          }, $attachment_ids);

        @endphp

        <h3 class="px-6 py-1 bg-white"><a href="{{ $product_permalink }}">{{ $product_title }} by {{$artist['0']->name}}</a></h3>
        <div id="glide-{{ $product_id }}-rel" class="glide g-related g-related-{{ $product_id }}">
          <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
            @foreach ($output as $item)
            <li class="glide__slide">
              <img class="block" src="{!! $item['att_url'] !!}" srcset="{!! $item['att_srcset'] !!}" @if ($item['has_alt']) alt="{!! $item['alt'][0] !!}" @endif sizes="(max-width: 792px) 100%, 20%">
            </li>
            @endforeach
            </ul>
          </div>
        </div>

      @endforeach

		@php woocommerce_product_loop_end() @endphp

	</section>
@endif

@php wp_reset_postdata() @endphp
