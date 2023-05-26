@php


/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' );

@endphp

<form class="variations_form cart" action="{{ apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) }}" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	@php do_action( 'woocommerce_before_variations_form' ) @endphp

  @if ( empty( $available_variations ) && false !== $available_variations )
		<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
	@else
		<table class="invisible variations" cellspacing="0">
			<tbody>


				@foreach ( $attributes as $attribute_name => $options )
					<tr>
						<td class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></td>
						<td class="value">
							<?php
								wc_dropdown_variation_attribute_options(
									array(
										'options'   => $options,
										'attribute' => $attribute_name,
										'product'   => $product,
									)
								);
								// echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
							?>
						</td>
					</tr>
        @endforeach
			</tbody>
		</table>

      {{-- tabla nueva --}}
      <div class="ftbs_variationsTableContainer">
        @php
          // $product_variations_list = $product->get_available_variations();
          // $product_variations_list = array_reverse($product_variations_list);
        @endphp

        @foreach($variaciones as $idx => $variation)
          <div id="ftbs_variationsTableRow_<?php echo $idx; ?>" class="ftbs_variationsTableRow ftbs_variationsTableRow {{ ($idx===0)?'ftbs_variationsTableRowFirst':'ftbs_variationsTableRow_unselected' }}" attributename='attribute_pa_format' attributevalue='{!! $variation['size_slug'] !!}'>
            <!-- data-attribute_name="attribute_pa_format"  value="{!! $variation['size_slug'] !!}"-->
            <div class="ftbs_variationsTableRowPadContainer @if ($idx!==0) ftbs_variationsTableRowPadContainer_inactive @endif flex justify-between border my-3 text-sm">

              <div class="ftbs_variationsTableRowColumn ftbs_variationsTableRowColumn_radio">
                <input id="ftbs_variationsTableRowColumn_radioInput_{{ $idx }}" class="invisible hidden overflow-hidden ftbs_variationsTableRowColumn_radioInput" type="radio" @if ($idx===0) name="attribute_pa_format" @endif variation_id="{!! $variation["variation_id"] !!}" value="{!! $variation['size_slug'] !!}" {!!($idx===0)?'checked="checked"':'' !!} />
              </div>

              <div class="ftbs_variationsTableRowColumn ftbs_variationsTableRowColumn_size">
                <span class="ftbsFontStyle4_blackSoft">{!! $variation["size"] !!}</span>
              </div>

              @if ($variation['is_on_sale'])
                <div class="flex items-center px-4 text-white bg-red-600 price-on-sale"><del>{{ $variation['regular_price'] }}</del> <del class="block woocommerce_price_euro_letter">&nbsp;EUR</del></div>
              @endif

              <div class="ftbs_variationsTableRowColumn ftbs_variationsTableRowColumn_price">
                <span class="ftbsFontStyle4_blackSoft">{!! $variation["price"] !!}<span class="woocommerce_price_euro_letter">&nbsp;EUR</span><span class="invisible woocommerce_price_euro_symbol">€</span></span>
              </div>

              <div id="ftbs_variationsTableRowColumn_quantity_{{ $idx }}" class="relative ftbs_variationsTableRowColumn ftbs_variationsTableRowColumn_quantity">
                @if ($idx===0)
                  <div id="ftbs_variationsTableRowColumn_quantityInput_add" class="ftbs_variationsTableRowColumn_quantityInput_add cursor-pointer absolute leading-none top-0 right-0 py-1.5 px-2 select-none hover:text-azul text-center">&plus;</div>
                  <input id="ftbs_variationsTableRowColumn_quantityInput" class="block h-full p-4 font-bold border-none ftbs_variationsTableRowColumn_quantityInput text-azul" type="text" value="1" />
                  <div id="ftbs_variationsTableRowColumn_quantityInput_remove" class="ftbs_variationsTableRowColumn_quantityInput_remove cursor-pointer absolute leading-none bottom-0 right-0 py-1.5 px-2 select-none hover:text-azul">&minus;</div>
                @else
                  <div class="ftbs_variationsTableRowColumn_quantityInput_add_inactive cursor-pointer absolute leading-none top-0 right-0 py-1.5 px-2 select-none hover:text-azul text-center">&plus;</div>
                  <input class="block h-full p-4 font-bold border-none ftbs_variationsTableRowColumn_quantityInput_inactive ftbs_variationsTableRowColumn_quantityInput text-azul" value="" />
                  <div class="ftbs_variationsTableRowColumn_quantityInput_remove_inactive cursor-pointer absolute leading-none bottom-0 right-0 py-1.5 px-2 select-none hover:text-azul">&minus;</div>
                @endif
              </div>

            </div>
          </div>
        @endforeach
      </div>

      {{-- termina tabla nueva --}}

		<div class="single_variation_wrap">
			<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
  @endif

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
