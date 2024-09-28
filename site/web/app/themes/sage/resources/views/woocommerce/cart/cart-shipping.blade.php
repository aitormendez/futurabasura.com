@php
    /**
     * Shipping Methods Display
     *
     * In 2.1 we show methods per package. This allows for multiple methods per order if so desired.
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-shipping.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 8.8.0
     */

    defined('ABSPATH') || exit();

    $formatted_destination = isset($formatted_destination)
        ? $formatted_destination
        : WC()->countries->get_formatted_address($package['destination'], ', ');
    $has_calculated_shipping = !empty($has_calculated_shipping);
    $show_shipping_calculator = !empty($show_shipping_calculator);
    $calculator_text = '';
@endphp

<div class="woocommerce-shipping-totals shipping table-row">
    <!-- Encabezado de la fila -->
    @if (isset($package_name))
        <div class="table-cell border-b-2 border-black py-4 pl-4 font-bold">{!! $package_name !!}</div>
    @endif
    <!-- Contenido de la celda -->
    <div class="table-cell border-b-2 border-black py-4" data-title="{!! $package_name !!}">
        @if (!empty($available_methods) && is_array($available_methods))
            <div id="shipping_method" class="woocommerce-shipping-methods">
                @foreach ($available_methods as $method)
                    <div class="mb-2">
                        @if (count($available_methods) > 1)
                            <input type="radio" name="shipping_method[{{ esc_attr($index) }}]"
                                data-index="{{ esc_attr($index) }}"
                                id="shipping_method_{{ esc_attr($index) }}_{{ esc_attr(sanitize_title($method->id)) }}"
                                value="{{ esc_attr($method->id) }}" class="shipping_method"
                                {{ $method->id == $chosen_method ? 'checked' : '' }}>
                        @else
                            <input type="hidden" name="shipping_method[{{ $index }}]"
                                data-index="{{ $index }}"
                                id="shipping_method_{{ $index }}_{{ sanitize_title($method->id) }}"
                                value="{{ $method->id }}" class="shipping_method">
                        @endif
                        <label for="shipping_method_{{ $index }}_{{ sanitize_title($method->id) }}">
                            {!! wc_cart_totals_shipping_method_label($method) !!}
                        </label>
                        @php do_action('woocommerce_after_shipping_rate', $method, $index) @endphp
                    </div>
                @endforeach
            </div>

            @if (is_cart())
                <p class="woocommerce-shipping-destination mt-4">
                    @if ($formatted_destination)
                        {!! __('Shipping to ', 'woocommerce') !!} <strong>{!! $formatted_destination !!}</strong>.
                        @php $calculator_text = __('Change address', 'woocommerce') @endphp
                    @else
                        {!! apply_filters(
                            'woocommerce_shipping_estimate_html',
                            __('Shipping options will be updated during checkout.', 'woocommerce'),
                        ) !!}
                    @endif
                </p>
            @endif
        @elseif (!$has_calculated_shipping || !$formatted_destination)
            @if (is_cart() && get_option('woocommerce_enable_shipping_calc') == 'no')
                <p>
                    {!! esc_html(
                        apply_filters(
                            'woocommerce_shipping_not_enabled_on_cart_html',
                            __('Shipping costs are calculated during checkout.', 'woocommerce'),
                        ),
                    ) !!}
                </p>
            @else
                <p>
                    {!! apply_filters(
                        'woocommerce_shipping_may_be_available_html',
                        __('Enter your address to view shipping options.', 'woocommerce'),
                    ) !!}
                </p>
            @endif
        @elseif (!is_cart())
            <p>
                {!! apply_filters(
                    'woocommerce_no_shipping_available_html',
                    __(
                        'There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.',
                        'woocommerce',
                    ),
                ) !!}
            </p>
        @else
            <p>
                {!! apply_filters(
                    'woocommerce_cart_no_shipping_available_html',
                    sprintf(
                        __('No shipping options were found for %s.', 'woocommerce') . ' ',
                        '<strong>' . $formatted_destination . '</strong>',
                    ),
                    $formatted_destination,
                ) !!}
                @php $calculator_text = __('Enter a different address', 'woocommerce') @endphp
            </p>
        @endif

        @if ($show_package_details)
            <p class="woocommerce-shipping-contents"><small>{!! $package_details !!}</small></p>
        @endif

        @if ($show_shipping_calculator)
            <div class="mt-4">
                @php woocommerce_shipping_calculator($calculator_text) @endphp
            </div>
        @endif
    </div>
</div>
