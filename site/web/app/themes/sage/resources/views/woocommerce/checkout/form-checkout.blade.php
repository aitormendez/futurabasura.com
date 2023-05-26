@php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

 @endphp
@if ( ! defined( 'ABSPATH' ) )
	@php exit @endphp
@endif
<div class="w-full ticket-head">
  <div class="w-full ticket-triangulo bg-tk-triangulo"></div>
  <div class="w-full h-10 bg-allo-claro"></div>
</div>

@php do_action( 'woocommerce_before_checkout_form', $checkout ); @endphp

{{-- If checkout registration is disabled and not logged in, the user cannot checkout. --}}
@if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() )
	{{ apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) }}
	@php return @endphp
@endif

<form name="checkout" method="post" class="p-6 checkout woocommerce-checkout bg-allo-claro" action="{!! esc_url( wc_get_checkout_url() ) !!}" enctype="multipart/form-data">

	@if ( $checkout->get_checkout_fields() )

		@php do_action( 'woocommerce_checkout_before_customer_details' ); @endphp

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				@php do_action( 'woocommerce_checkout_billing' ) @endphp
			</div>

			<div class="col-2">
				@php do_action( 'woocommerce_checkout_shipping' ) @endphp
			</div>
		</div>

		@php do_action( 'woocommerce_checkout_after_customer_details' ) @endphp

	@endif

	@php do_action( 'woocommerce_checkout_before_order_review_heading' ) @endphp

	<h3 id="order_review_heading">{{ __( 'Your order', 'woocommerce' ) }}</h3>

	@php do_action( 'woocommerce_checkout_before_order_review' ) @endphp

	<div id="order_review" class="woocommerce-checkout-review-order">
		@php do_action( 'woocommerce_checkout_order_review' ) @endphp
	</div>

	@php do_action( 'woocommerce_checkout_after_order_review' ) @endphp

</form>

@php do_action( 'woocommerce_after_checkout_form', $checkout ) @endphp

<div class="w-full ticket-head">
  <div class="w-full h-10 bg-allo-claro"></div>
  <div class="w-full ticket-triangulo bg-tk-triangulo-down"></div>
</div>
