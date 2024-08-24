@php
/**
* Cart Page
*
* This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
*
* HOWEVER, on occasion WooCommerce will need to update template files and you
* (the theme developer) will need to copy the new files to your theme to
* maintain compatibility. We try to do this as little as possible, but it does
* happen. When this occurs the version of the template file will be bumped and
* the readme will list any important changes.
*
* @see https://woocommerce.com/document/template-structure/
* @package WooCommerce\Templates
* @version 7.9.0
*/

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );
@endphp

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
  <?php do_action( 'woocommerce_before_cart_table' ); ?>

  {{-- nueva tabla --}}
  <div class="ticket">
    <div class="w-full ticket-head">
      <div class="w-full ticket-triangulo bg-tk-triangulo"></div>
      <div class="w-full h-10 mb-2 bg-allo-claro"></div>
    </div>

    <div class="tk-body">
      @foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item )
      @php
      $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
      $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item,
      $cart_item_key );
      $artista = get_the_terms( $product_id, 'artist',)[0]->name;
      $product_item = $cart_item['data'];
      /**
      * Filter the product name.
      *
      * @since 2.1.0
      * @param string $product_name Name of the product in the cart.
      * @param array $cart_item The product in the cart.
      * @param string $cart_item_key Key for the product in the cart.
      */
      $product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
      @endphp
      @if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters(
      'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) )
      @php
      $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ?
      $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
      @endphp

      {{-- row --}}
      <div
        class="tracking-wider text-gray-600 mb-2 flex justify-between tk-row bg-allo-claro woocommerce-cart-form__cart-item font-sans {{ apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) }}">
        <div class="flex flex-wrap justify-between w-full md:nowrap md:justify-start col-1">
          {{-- thumbnail --}}
          <div class="p-6 tk-cell product-thumbnail w-1/4">
            @php
            $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item,
            $cart_item_key );
            @endphp

            @if ( ! $product_permalink )
            {!! $thumbnail !!}
            @else
            @php
            printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
            @endphp
            @endif
          </div>
          {{-- / thumbnail --}}

          {{-- datos de producto --}}
          <div class="order-2 w-full px-6 md:pl-0 md:pt-6 md:order-1 md:w-1/3 tk-cell product-data leading-tight">
            <div class="product-name" data-title="{{ esc_attr( translate( 'Product', 'woocommerce' )) }}">

              @if ( ! $product_permalink )
              {!! wp_kses_post($cart_item["data"]->get_title()) !!}
              @else
              {!!wp_kses_post(sprintf('<a href="%s">%s</a><br />', esc_url($product_permalink),
              $cart_item["data"]->get_title())) !!}
              @endif

              @php do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key ) @endphp
            </div>
            {!! wc_get_formatted_cart_item_data( $cart_item ) !!}

            @if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
            {!! wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p
              class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>',
            $product_id ) ) !!}
            @endif

            @if( !empty( $product_item ) && $product_item->is_type( 'variation' ) )
            <div class="format">
              {!! wc_get_formatted_variation( $cart_item["data"]->get_variation_attributes(), true, false, false ) !!}
            </div>
            @else
            <div class="format">
              {!! $product_item->get_attribute("pa_format") !!}
            </div>
            @endif

            <div class="artist">
              {{ $artista }}
            </div>

            <div class="hidden product-price md:block"
              data-title="{{ esc_attr( translate( 'Price', 'woocommerce' )) }}">
              @php
              echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item,
              $cart_item_key ); // PHPCS: XSS ok.
              @endphp
            </div>
          </div>
          <div class="order-3 w-1/2 pb-3 pl-6 italic product-meta md:hidden">
            <div class="tk-cell product-price" data-title="{{ esc_attr( translate( 'Price', 'woocommerce' )) }}">
              <?php
                    echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
                  ?>
            </div>
          </div>
          {{-- / datos de producto --}}

          {{-- input quantity --}}
          <div class="flex items-center order-1 md:bg-white tk-cell product-quantity"
            data-title="{{ esc_attr( translate( 'Quantity', 'woocommerce' )) }}">
            @if ( $_product->is_sold_individually() )
            @php
            $min_quantity = 1;
            $max_quantity = 1;
            @endphp
            @else
            @php
            $min_quantity = 0;
            $max_quantity = $_product->get_max_purchase_quantity();
            @endphp
            @endif

            @php
            $product_quantity = woocommerce_quantity_input(
            array(
            'input_name' => "cart[{$cart_item_key}][qty]",
            'input_value' => $cart_item['quantity'],
            'max_value' => $max_quantity,
            'min_value' => $min_quantity,
            'product_name' => $product_name,
            'classes' => 'h-full text-2xl text-center text-blue-700 font-bold cartQuantityInput bg-transparent
            md:bg-white'
            ),
            $_product,
            false
            );
            @endphp

            {!! apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ) !!}

            <div class="flex flex-col text-2xl botones-qty">
              <div
                class="product-quantity-add cursor-pointer leading-none py-1.5 px-2 select-none hover:text-azul text-center">
                &plus;</div>
              <div class="cursor-pointer leading-none py-1.5 px-2 select-none hover:text-azul product-quantity-remove">
                &minus;</div>
            </div>
          </div>
          {{-- / input quantity --}}

          {{-- subtotal --}}
          <div
            class="self-end justify-end order-4 pb-3 italic font-bold md:pb-0 md:self-center tk-cell product-subtotal md:flex md:ml-12"
            data-title="{{ __( translate( 'Subtotal', 'woocommerce' )) }}">
            {!! apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product,
            $cart_item['quantity'] ), $cart_item, $cart_item_key ) !!}
          </div>
          {{-- / subtotal --}}
        </div>

        {{-- remove item --}}
        <div class="flex items-center justify-center col-2 product-remove">
          <a href="{!! esc_url( wc_get_cart_remove_url( $cart_item_key ) ) !!}"
            aria-label="{!! esc_html__( 'Remove this item', 'woocommerce' ) !!}"
            data-product_id="{!! esc_attr( $product_id ) !!}"
            data-product_sku="{!! esc_attr( $_product->get_sku() ) !!}"
            class="flex items-center w-full h-full p-3 border border-red-600">
            @svg('images.waste', 'fill-rojo w-full')
          </a>
        </div>
        {{-- / remove item --}}
      </div>
      {{-- / row --}}
      @endif
      @endforeach

      {{-- row cupón --}}
      <div class="tk-row">
        <div class="tk-cell actions">

          @if ( wc_coupons_enabled() )
          <div class="coupon">
            <div class="pt-6 bg-allo-claro"></div>
            <div class="flex justify-between central-row">
              <div class="pl-6 lateral bg-allo-claro"></div>
              <div class="flex flex-wrap justify-center central">
                <label class="hidden" for="coupon_code">{{ esc_attr( translate( 'Coupon', 'woocommerce' )) }}</label>

                <input type="text" name="coupon_code"
                  class="w-full font-bold tracking-wider text-center text-red-600 bg-transparent h-36 input-text"
                  id="coupon_code" value="" placeholder="{{ esc_attr( translate( 'Coupon code', 'woocommerce' )) }}" />

                <button class="w-full bg-transparent border-4 btn" type="submit" class="button" name="apply_coupon"
                  value="{{ esc_attr( translate( 'Apply coupon', 'woocommerce' )) }}">{{ esc_attr( translate( 'Apply
                  coupon', 'woocommerce' )) }}
                </button>

                @php do_action( 'woocommerce_cart_coupon' ) @endphp
              </div>
              <div class="pl-6 lateral bg-allo-claro"></div>
            </div>
            <div class="pt-6 bg-allo-claro"></div>
          </div>
          @endif

          <button type="submit" class="hidden button" name="update_cart"
            value="{{ esc_attr( translate( 'Update cart', 'woocommerce' )) }}">{{ esc_attr( translate( 'Update cart',
            'woocommerce' )) }}</button>

          @php
          do_action( 'woocommerce_cart_actions' );
          wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' );
          @endphp
        </div>
      </div>
    </div>
  </div>





  {{-- / nueva tabla --}}


  <?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
  <?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>