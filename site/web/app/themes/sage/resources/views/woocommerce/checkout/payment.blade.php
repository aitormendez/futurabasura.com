@php
    /**
     * Checkout Payment Section
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 8.1.0
     */

    defined('ABSPATH') || exit();
@endphp

@php
    if (!wp_doing_ajax()) {
        do_action('woocommerce_review_order_before_payment');
    }
@endphp

<div id="payment" class="woocommerce-checkout-payment px-4 py-6">
    @if (WC()->cart->needs_payment())
        <ul class="wc_payment_methods payment_methods methods">
            @if (!empty($available_gateways))
                @foreach ($available_gateways as $gateway)
                    @php wc_get_template('checkout/payment-method.php', ['gateway' => $gateway]) @endphp
                @endforeach
            @else
                <li>
                    {!! wc_print_notice(
                        apply_filters(
                            'woocommerce_no_available_payment_methods_message',
                            WC()->customer->get_billing_country()
                                ? __(
                                    'Sorry, it seems that there are no available payment methods. Please contact us if you require assistance or wish to make alternate arrangements.',
                                    'woocommerce',
                                )
                                : __('Please fill in your details above to see available payment methods.', 'woocommerce'),
                        ),
                        'notice',
                    ) !!}
                </li>
            @endif
        </ul>
    @endif
    <div class="form-row place-order">
        <noscript>
            {!! sprintf(
                __(
                    'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.',
                    'woocommerce',
                ),
                '<em>',
                '</em>',
            ) !!}
            <br />
            <button type="submit"
                class="button alt{{ esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '') }}"
                name="woocommerce_checkout_update_totals" value="{{ esc_attr(__('Update totals', 'woocommerce')) }}">
                {{ __('Update totals', 'woocommerce') }}
            </button>
        </noscript>

        @php wc_get_template('checkout/terms.php') @endphp

        @php do_action('woocommerce_review_order_before_submit') @endphp

        {!! apply_filters(
            'woocommerce_order_button_html',
            '<button type="submit" class="button alt' .
                esc_attr(
                    wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '',
                ) .
                '" name="woocommerce_checkout_place_order" id="place_order" value="' .
                esc_attr($order_button_text) .
                '" data-value="' .
                esc_attr($order_button_text) .
                '">' .
                esc_html($order_button_text) .
                '</button>',
        ) !!}

        @php do_action('woocommerce_review_order_after_submit') @endphp

        @php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce') @endphp
    </div>
</div>

@php
    if (!wp_doing_ajax()) {
        do_action('woocommerce_review_order_after_payment');
    }
@endphp