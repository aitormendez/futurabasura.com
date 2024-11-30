@php
    /**
     * Review order table
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 5.2.0
     */

    defined('ABSPATH') || exit();
@endphp

<div class="woocommerce-checkout-review-order-table table w-full border-b-2 border-black">
    <!-- Encabezado de la tabla -->
    <div class="table-header-group">
        <div class="table-row">
            <div class="table-cell border-b-2 border-black px-4 text-left font-bold">{{ __('Product') }}</div>
            <div class="table-cell border-b-2 border-black text-left font-bold">{{ __('Subtotal') }}</div>
        </div>
    </div>

    <!-- Contenido de la tabla -->
    <div class="table-row-group">
        @php
            do_action('woocommerce_review_order_before_cart_contents');
        @endphp

        @foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
            @php
                $_product = apply_filters(
                    'woocommerce_cart_item_product',
                    $cart_item['data'],
                    $cart_item,
                    $cart_item_key,
                );
            @endphp

            @if (
                $_product &&
                    $_product->exists() &&
                    $cart_item['quantity'] > 0 &&
                    apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key))
                <div
                    class="{{ esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)) }} table-row">
                    <div class="product-name table-cell w-[150px] border-b-2 border-black bg-white p-4 md:w-auto">
                        {!! wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)) !!}&nbsp;
                        {!! apply_filters(
                            'woocommerce_checkout_cart_item_quantity',
                            ' <strong class="product-quantity">' . sprintf('&times;&nbsp;%s', $cart_item['quantity']) . '</strong>',
                            $cart_item,
                            $cart_item_key,
                        ) !!}
                        {!! wc_get_formatted_cart_item_data($cart_item) !!}
                    </div>
                    <div class="product-total p-y table-cell border-b-2 border-black bg-white">
                        {!! apply_filters(
                            'woocommerce_cart_item_subtotal',
                            WC()->cart->get_product_subtotal($_product, $cart_item['quantity']),
                            $cart_item,
                            $cart_item_key,
                        ) !!}
                    </div>
                </div>
            @endif
        @endforeach

        @php
            do_action('woocommerce_review_order_after_cart_contents');
        @endphp
    </div>

    <!-- Pie de la tabla -->
    <div class="table-footer-group">
        <div class="cart-subtotal table-row">
            <div class="table-cell border-b-2 border-black py-4 pl-4 font-bold">{{ __('Subtotal') }}</div>
            <div class="table-cell border-b-2 border-black py-4">{!! wc_cart_totals_subtotal_html() !!}</div>
        </div>

        @foreach (WC()->cart->get_coupons() as $code => $coupon)
            <div class="cart-discount coupon-{{ esc_attr(sanitize_title($code)) }} table-row">
                <div class="table-cell border-b-2 border-black py-4 pl-4 font-bold text-rojo">{!! wc_cart_totals_coupon_label($coupon) !!}
                </div>
                <div class="table-cell border-b-2 border-black py-4">{!! wc_cart_totals_coupon_html($coupon) !!}</div>
            </div>
        @endforeach

        @if (WC()->cart->needs_shipping() && WC()->cart->show_shipping())
            @php
                do_action('woocommerce_review_order_before_shipping');
            @endphp

            {!! wc_cart_totals_shipping_html() !!}

            @php
                do_action('woocommerce_review_order_after_shipping');
            @endphp
        @endif

        @foreach (WC()->cart->get_fees() as $fee)
            <div class="fee table-row">
                <div class="table-cell font-bold">{{ esc_html($fee->name) }}</div>
                <div class="table-cell">{!! wc_cart_totals_fee_html($fee) !!}</div>
            </div>
        @endforeach

        @if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax())
            @if (get_option('woocommerce_tax_total_display') === 'itemized')
                @foreach (WC()->cart->get_tax_totals() as $code => $tax)
                    <div class="tax-rate tax-rate-{{ esc_attr(sanitize_title($code)) }} table-row">
                        <div class="table-cell font-bold">{{ esc_html($tax->label) }}</div>
                        <div class="table-cell">{!! wp_kses_post($tax->formatted_amount) !!}</div>
                    </div>
                @endforeach
            @else
                <div class="tax-total table-row">
                    <div class="table-cell font-bold">{{ esc_html(WC()->countries->tax_or_vat()) }}</div>
                    <div class="table-cell">{!! wc_cart_totals_taxes_total_html() !!}</div>
                </div>
            @endif
        @endif

        @php
            do_action('woocommerce_review_order_before_order_total');
        @endphp

        <div class="order-total table-row">
            <div class="table-cell py-4 pl-4 text-2xl font-bold">{{ __('Total') }}</div>
            <div class="table-cell text-2xl">{!! wc_cart_totals_order_total_html() !!}</div>
        </div>

        @php
            do_action('woocommerce_review_order_after_order_total');
        @endphp
    </div>
</div>
