@php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );
@endphp

@if (post_password_required())
  {!! get_the_password_form() !!}
  @php return; @endphp
@endif

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'flex flex-wrap', $product ); ?>>

  @php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	@endphp


	<div class="w-full flex flex-col items-center px-6 pt-20 pb-20 text-xl border-b-2 bg-white">
		<h2 class="uppercase artista tracking-max font-bugrino text-3xl"><a href="{{ $artista['link'] }}">{{ $artista['artista']->name }}</a></h2>
		<h1 class="my-10 font-bold product_title entry-title tracking-widest">{!! get_the_title() !!}</h1>

		<div class="excerpt text-md max-w-screen-sm text-center">
			{!! $post->post_excerpt !!}
		</div>
	</div>

	<div class="relative flex justify-center items-center w-1/2 border-r-2 p-6 bg-white">
		<div class="absolute uppercase w-full left-6 top-6">{{$product->get_attribute('Product Type')}}</div>
		@if(has_post_thumbnail($post->ID))
			@php
				$thumbnail_id = get_post_thumbnail_id($post->ID);
				$image_metadata = wp_get_attachment_metadata($thumbnail_id);
				$is_horizontal = $image_metadata['width'] > $image_metadata['height'];
			@endphp

			<div class="product-featured-image {{ $is_horizontal ? 'w-3/4' : 'w-[40%]' }}">
				<img src="{{ get_the_post_thumbnail_url($post->ID, 'large') }}" alt="{{ get_the_title($post->ID) }}">
			</div>
		@endif
	</div>

	<div class="glide-wrap w-1/2">
		<div id="glide" class="relative g-gallery">
		<div class="glide__track" data-glide-el="track">
			<ul class="glide__slides">
			@foreach ($galeria as $item)
			<li class="glide__slide slide">
			<img src="{!! $item['att_url'] !!}" srcset="{!! $item['att_srcset'] !!}" @if ($item['has_alt']) alt="{!! $item['alt'][0] !!}" @endif sizes="(max-width: 792px) 100%, 50%">
			</li>
			@endforeach
			</ul>
		</div>
		<div id="indice" class="absolute bottom-0 right-0 w-20 p-3 text-center bg-white"></div>
		</div>
	</div>


	<div class="flexpt-10">




    	@php
  		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5 REMOVED
		 * @hooked woocommerce_template_single_rating - 10 REMOVED
		 * @hooked woocommerce_template_single_price - 10 REMOVED
		 * @hooked woocommerce_template_single_excerpt - 20 REMOVED
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		@endphp


	</div>

	@php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	@endphp
</div>

@php do_action( 'woocommerce_after_single_product' ); @endphp
