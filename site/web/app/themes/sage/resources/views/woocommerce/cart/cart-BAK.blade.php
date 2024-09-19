@php
    /**
     * ES CART BLADE PERO SUSTITUYENDO LA TABLA HTML POR DIVS
     *
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
     * @see https://docs.woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 3.8.0
     */

    defined('ABSPATH') || exit();

    do_action('woocommerce_before_cart');
@endphp

<form class="woocommerce-cart-form" action="{{ wc_get_cart_url() }}" method="post">
    @php do_action( 'woocommerce_before_cart_table' ) @endphp

    {{-- nueva tabla --}}

    <div class="ticket font-sans">
        <div class="ticket-head w-full">
            <div class="ticket-triangulo w-full bg-tk-triangulo"></div>
            <div class="mb-2 h-10 w-full bg-allo-claro"></div>
        </div>
        <div class="tk-body">
            @foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
                @php
                    $_product = apply_filters(
                        'woocommerce_cart_item_product',
                        $cart_item['data'],
                        $cart_item,
                        $cart_item_key,
                    );
                    $product_id = apply_filters(
                        'woocommerce_cart_item_product_id',
                        $cart_item['product_id'],
                        $cart_item,
                        $cart_item_key,
                    );
                    $artista = get_the_terms($product_id, 'artist')[0]->name;
                    $product_item = $cart_item['data'];
                @endphp


                @if (
                    $_product &&
                        $_product->exists() &&
                        $cart_item['quantity'] > 0 &&
                        apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key))
                    @php
                        $product_permalink = apply_filters(
                            'woocommerce_cart_item_permalink',
                            $_product->is_visible() ? $_product->get_permalink($cart_item) : '',
                            $cart_item,
                            $cart_item_key,
                        );
                    @endphp
                    {{-- row --}}
                    <div
                        class="text-gray-600 tk-row woocommerce-cart-form__cart-item {{ apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key) }} mb-2 flex justify-between bg-allo-claro tracking-wider">

                        <div class="md:nowrap col-1 flex w-full flex-wrap justify-between md:justify-start">
                            {{-- thumbnail --}}
                            <div class="tk-cell product-thumbnail p-6">
                                @php
                                    $thumbnail = apply_filters(
                                        'woocommerce_cart_item_thumbnail',
                                        $_product->get_image(),
                                        $cart_item,
                                        $cart_item_key,
                                    );
                                @endphp

                                @if (!$product_permalink)
                                    {!! $thumbnail !!}
                                @else
                                    @php
                                        printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                                    @endphp
                                @endif
                            </div>

                            {{-- datos de producto --}}
                            <div
                                class="tk-cell product-data order-2 w-full px-6 leading-tight md:order-1 md:w-auto md:pl-0 md:pt-6">
                                <div class="product-name"
                                    data-title="{{ esc_attr(translate('Product', 'woocommerce')) }}">

                                    @if (!$product_permalink)
                                        {!! wp_kses_post($cart_item['data']->get_title()) !!}
                                    @else
                                        {!! wp_kses_post(
                                            sprintf('<a href="%s">%s</a><br />', esc_url($product_permalink), $cart_item['data']->get_title()),
                                        ) !!}
                                    @endif

                                    @php do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key ) @endphp
                                </div>
                                {!! wc_get_formatted_cart_item_data($cart_item) !!}

                                @if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity']))
                                    {!! wp_kses_post(
                                        apply_filters(
                                            'woocommerce_cart_item_backorder_notification',
                                            '<p
                                                  class="backorder_notification">' .
                                                esc_html__('Available on backorder', 'woocommerce') .
                                                '</p>',
                                            $product_id,
                                        ),
                                    ) !!}
                                @endif

                                @if (!empty($product_item) && $product_item->is_type('variation'))
                                    <div class="format">
                                        {!! wc_get_formatted_variation($cart_item['data']->get_variation_attributes(), true, false, false) !!}
                                    </div>
                                @else
                                    <div class="format">
                                        {!! $product_item->get_attribute('pa_format') !!}
                                    </div>
                                @endif

                                <div class="artist">
                                    {{ $artista }}
                                </div>

                                <div class="product-price hidden md:block"
                                    data-title="{{ esc_attr(translate('Price', 'woocommerce')) }}">
                                    <?php
                                    echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                    ?>
                                </div>
                            </div>

                            <div class="product-meta order-3 w-1/2 pb-3 pl-6 italic md:hidden">
                                <div class="tk-cell product-price"
                                    data-title="{{ esc_attr(translate('Price', 'woocommerce')) }}">
                                    <?php
                                    echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                    ?>
                                </div>
                            </div>

                            {{-- input quantity --}}
                            <div class="tk-cell product-quantity order-1 flex items-center md:bg-white"
                                data-title="{{ esc_attr(translate('Quantity', 'woocommerce')) }}">
                                @if ($_product->is_sold_individually())
                                    @php
                                        $product_quantity = sprintf(
                                            '1 <input type="hidden" name="cart[%s][qty]" value="1" />',
                                            $cart_item_key,
                                        );
                                    @endphp
                                @else
                                    @php
                                        $product_quantity = woocommerce_quantity_input(
                                            [
                                                'input_id' => 'ftbsCartProduct_' . $cart_item['product_id'],
                                                'input_name' => "cart[{$cart_item_key}][qty]",
                                                'input_value' => $cart_item['quantity'],
                                                'max_value' => $_product->get_max_purchase_quantity(),
                                                'min_value' => '0',
                                                'product_name' => $_product->get_name(),
                                                'classes' => 'h-full text-2xl text-center text-blue-700 font-bold ftbsCartQuantityInput bg-transparent
            md:bg-white',
                                            ],
                                            $_product,
                                            false,
                                        );
                                    @endphp
                                @endif

                                {!! apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item) !!}
                                <div class="botones-qty flex flex-col text-2xl">
                                    <div
                                        class="product-quantity-add cursor-pointer select-none px-2 py-1.5 text-center leading-none hover:text-azul">
                                        &plus;</div>
                                    <div
                                        class="product-quantity-remove cursor-pointer select-none px-2 py-1.5 leading-none hover:text-azul">
                                        &minus;</div>
                                </div>
                            </div>

                            <div class="tk-cell product-subtotal order-4 justify-end self-end pb-3 font-bold italic md:flex md:self-center md:pb-0"
                                data-title="{{ __(translate('Subtotal', 'woocommerce')) }}">
                                {!! apply_filters(
                                    'woocommerce_cart_item_subtotal',
                                    WC()->cart->get_product_subtotal($_product, $cart_item['quantity']),
                                    $cart_item,
                                    $cart_item_key,
                                ) !!}
                            </div>
                        </div>

                        {{-- /col-1 --}}

                        <div class="col-2 product-remove flex items-center justify-center">
                            <a href="{!! esc_url(wc_get_cart_remove_url($cart_item_key)) !!}" aria-label="{!! esc_html__('Remove this item', 'woocommerce') !!}"
                                data-product_id="{!! esc_attr($product_id) !!}" data-product_sku="{!! esc_attr($_product->get_sku()) !!}"
                                class="border-red-600 flex h-full w-full items-center border p-3">
                                @svg('images.waste', 'fill-rojo w-full')
                            </a>
                        </div>


                    </div>
                @endif
            @endforeach

            <?php do_action('woocommerce_cart_contents'); ?>

            <div class="tk-row">
                <div class="tk-cell actions">

                    @if (wc_coupons_enabled())
                        <div class="coupon">
                            <div class="bg-allo-claro pt-6"></div>
                            <div class="central-row flex justify-between">
                                <div class="lateral bg-allo-claro pl-6"></div>
                                <div class="central flex flex-wrap justify-center">
                                    <label class="hidden"
                                        for="coupon_code">{{ esc_attr(translate('Coupon', 'woocommerce')) }}</label>

                                    <input type="text" name="coupon_code"
                                        class="text-red-600 input-text h-36 w-full bg-transparent text-center font-bold tracking-wider"
                                        id="coupon_code" value=""
                                        placeholder="{{ esc_attr(translate('Coupon code', 'woocommerce')) }}" />

                                    <button class="btn w-full border-4 bg-transparent" type="submit" class="button"
                                        name="apply_coupon"
                                        value="{{ esc_attr(translate('Apply coupon', 'woocommerce')) }}">{{ esc_attr(
                                            translate(
                                                'Apply
                                                          coupon',
                                                'woocommerce',
                                            ),
                                        ) }}
                                    </button>

                                    @php do_action( 'woocommerce_cart_coupon' ) @endphp
                                </div>
                                <div class="lateral bg-allo-claro pl-6"></div>
                            </div>
                            <div class="bg-allo-claro pt-6"></div>
                        </div>
                    @endif

                    <button type="submit" class="button hidden" name="update_cart"
                        value="{{ esc_attr(translate('Update cart', 'woocommerce')) }}">{{ esc_attr(translate('Update cart', 'woocommerce')) }}</button>

                    @php
                        do_action('woocommerce_cart_actions');
                        wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce');
                    @endphp
                </div>
            </div>

            @php do_action( 'woocommerce_after_cart_contents' ) @endphp

        </div>

    </div>

    {{-- termina nueva tabla --}}

    @php do_action( 'woocommerce_after_cart_table' ) @endphp
</form>

@php do_action( 'woocommerce_before_cart_collaterals' ) @endphp

<div class="cart-collaterals">
    @php
        /**
         * Cart collaterals hook.
         *
         * @hooked woocommerce_cross_sell_display
         * @hooked woocommerce_cart_totals - 10
         */
        do_action('woocommerce_cart_collaterals');
    @endphp
    <div class="ticket-head w-full">
        <div class="ticket-triangulo w-full bg-tk-triangulo-down"></div>
    </div>
</div>

<div class="ticket-head w-full bg-tk-triangulo-down"></div>

@php do_action( 'woocommerce_after_cart' ) @endphp
