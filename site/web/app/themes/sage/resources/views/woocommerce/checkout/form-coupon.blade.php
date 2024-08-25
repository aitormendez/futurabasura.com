@php
    /**
     * Checkout coupon form
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 7.0.1
     */

    defined('ABSPATH') || exit();
@endphp

@php
    if (!wc_coupons_enabled()) {
        return;
    }
@endphp

<div class="woocommerce-form-coupon-toggle font-sans">
    {!! wc_print_notice(
        apply_filters(
            'woocommerce_checkout_coupon_message',
            __('Have a coupon?', 'woocommerce') .
                ' <a href="#" class="showcoupon text-azul">' .
                __('Click here to enter your code', 'woocommerce') .
                '</a>',
        ),
        'notice',
    ) !!}
</div>

<form class="checkout_coupon woocommerce-form-coupon flex flex-col items-center font-sans" method="post"
    style="display:none">

    <p class="mb-6">{{ __('If you have a coupon code, please apply it below.', 'woocommerce') }}</p>

    <p class="form-row form-row-first">
        <label for="coupon_code" class="screen-reader-text">{{ __('Coupon:', 'woocommerce') }}</label>

    <div class="border-2 border-black">
        <input type="text" name="coupon_code"
            class="input-text input-text h-24 w-full bg-transparent text-center font-bold tracking-wider text-rojo"
            placeholder="{{ __('Coupon code', 'woocommerce') }}" id="coupon_code" value="" />
    </div>
    </p>

    <p class="form-row form-row-last">
        <button type="submit"
            class="texts-sm button{{ wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '' }} mb-14 mt-6 rounded !bg-azul px-4 py-2 uppercase tracking-wider text-white hover:!bg-allo hover:text-black"
            name="apply_coupon"
            value="{{ __('Apply coupon', 'woocommerce') }}">{{ __('Apply coupon', 'woocommerce') }}</button>
    </p>

    <div class="clear"></div>
</form>
