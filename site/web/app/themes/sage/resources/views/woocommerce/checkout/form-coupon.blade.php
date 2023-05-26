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
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;
@endphp

@if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	@php return @endphp
@endif

<div class="p-6 tracking-wider cupon bg-allo-claro">
  <div class="woocommerce-form-coupon-toggle">
    @php wc_print_notice( apply_filters( 'woocommerce_checkout_coupon_message', esc_html__( 'Have a coupon?', 'woocommerce' ) . ' <a href="#" class="showcoupon">' . esc_html__( 'Click here to enter your code', 'woocommerce' ) . '</a>' ), 'notice' ) @endphp
  </div>

  <form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">

    <p>{{  __( 'If you have a coupon code, please apply it below.', 'woocommerce' ) }}</p>

    <p class="my-6 form-row form-row-first">
      <input type="text" name="coupon_code" class="w-full text-center input-text" placeholder="{{  __( 'Coupon code', 'woocommerce' ) }}" id="coupon_code" value="" />
    </p>

    <p class="form-row form-row-last">
      <button type="submit" class="button btn" name="apply_coupon" value="{{  __( 'Apply coupon', 'woocommerce' ) }}">{{ __( 'Apply coupon', 'woocommerce' ) }}</button>
    </p>

    <div class="clear"></div>
  </form>
</div>
