@php


/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

@endphp

{!! wc_get_stock_html( $product ) !!}


@if ($product->is_in_stock())

	@php do_action( 'woocommerce_before_add_to_cart_form' ) @endphp

	<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>

		@php do_action( 'woocommerce_before_add_to_cart_button' ) @endphp

    <div class="hidden">
      @php
        woocommerce_quantity_input([
          'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
          'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
          'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
        ]);
      @endphp
    </div>

      @php do_action( 'woocommerce_after_add_to_cart_quantity' ) @endphp

      {{-- tabla nueva --}}
        <div class="inline-block" >
          <div class="flex justify-between my-3 text-sm bg-white pr-6 mr-6">
            @if ($precio['is_on_sale'])
              <div class="flex items-center px-4 text-white bg-red-600 price-on-sale"><del>{{ $precio['regular_price'] }}</del> <del class="block woocommerce_price_euro_letter">&nbsp;EUR</del></div>
            @endif
            <div class="py-4 px-8 text-2xl text-gris-fb">
              {!! $precio['price'] !!} <span>€</span>
            </div>
            <div class="flex quantity">
              <div id="quantityInput_remove" class="cursor-pointer select-none hover:text-azul text-2xl h-full border-r-2 inline-flex items-center pr-6">
                <svg width="19" height="2" viewBox="0 0 19 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M0 1L19 1" stroke="#3E2B2F" stroke-width="2"/>
                </svg>                  
              </div>
              <input class="quantityInput border-none text-azul h-full w-28 text-2xl text-center" type="text" value="1"/>
              <div id="quantityInput_add" class="cursor-pointer select-none hover:text-azul text-2xl border-l-2 inline-flex items-center pl-6">
                <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 10L19 10" stroke="#3E2B2F" stroke-width="2"/>
                <path d="M9.5 19.5L9.5 0.5" stroke="#3E2B2F" stroke-width="2"/>
                </svg>
              </div>
            </div>
          </div>
        </div>
      {{-- termina tabla nueva --}}

		<button type="submit" name="add-to-cart" value="{{ $product->get_id() }}" class="px-20 py-3 bg-azul clip-path-elipse text-white uppercase tracking-max hover:bg-allo hover:text-black transition-colors">{{ $product->single_add_to_cart_text() }}</button>

		@php do_action( 'woocommerce_after_add_to_cart_button' ); @endphp
	</form>

	@php do_action( 'woocommerce_after_add_to_cart_form' ); @endphp

@endif

