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

    <div style="display: none;">
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
      <div class="ftbs_variationsTable">
        <div id="ftbs_variationsTableRow_0" class="ftbs_variationsTableRow ftbs_variationsTableRowFirst" >
          <div class="flex justify-between my-3 text-sm border border-black ftbs_variationsTableRowPadContainer">
            <div class="invisible w-0 overflow-hidden ftbs_variationsTableRowColumn ftbs_variationsTableRowColumn_radio">
              <input type="radio" name="attribute_pa_medidas" value="" checked="checked"  />
            </div>
            <div class="px-4 ftbs_variationsTableRowColumn ftbs_variationsTableRowColumn_size">
              <span class="ftbsFontStyle4_blackSoft">{!! $variaciones[0]['size'] !!} CM</span>
            </div>
            @if ($precio['is_on_sale'])
              <div class="flex items-center px-4 text-white bg-red-600 price-on-sale"><del>{{ $precio['regular_price'] }}</del> <del class="block woocommerce_price_euro_letter">&nbsp;EUR</del></div>
            @endif
            <div class="px-4 ftbs_variationsTableRowColumn ftbs_variationsTableRowColumn_price">{!! $precio['price'] !!} &nbsp;EUR<span class="invisible">€</span></span>
            </div>
            <div class="relative ftbs_variationsTableRowColumn ftbs_variationsTableRowColumn_quantity">
              <div id="ftbs_variationsTableRowColumn_quantityInput_add" class="cursor-pointer absolute leading-none top-0 right-0 py-1.5 px-2 select-none hover:text-azul text-center">&plus;</div>
              <input class="block h-full p-4 font-bold border-none ftbs_variationsTableRowColumn_quantityInput text-azul" type="text" value="1"/>
              <div id="ftbs_variationsTableRowColumn_quantityInput_remove" class="cursor-pointer absolute leading-none bottom-0 right-0 py-1.5 px-2 select-none hover:text-azul">&minus;</div>
            </div>
          </div>
        </div>
      </div>
      {{-- termina tabla nueva --}}

		<button type="submit" name="add-to-cart" value="{{ $product->get_id() }}" class="single_add_to_cart_button button alt">{{ $product->single_add_to_cart_text() }}</button>

		@php do_action( 'woocommerce_after_add_to_cart_button' ); @endphp
	</form>

	@php do_action( 'woocommerce_after_add_to_cart_form' ); @endphp

@endif
