@php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
@endphp

<div class="woocommerce-order">


	@if ( $order )
		<div class="ticket">
			<div class="w-full ticket-head">
				<div class="w-full ticket-triangulo bg-tk-triangulo"></div>
				<div class="w-full h-10 bg-allo-claro"></div>
			</div>

			<div class="ticket-body bg-allo-claro">
				@php do_action( 'woocommerce_before_thankyou', $order->get_id() ) @endphp

				@if ( $order->has_status( 'failed' ) )
	
					<div class="p-4">
						<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>
						<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
							<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'woocommerce' ); ?></a>
							<?php if ( is_user_logged_in() ) : ?>
								<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
							<?php endif; ?>
						</p>
					</div>
	
				@else
					<div class="p-4">
						<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
	
						<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">
		
							<li class="woocommerce-order-overview__order order">
								{{ __( 'Order number:', 'woocommerce' ) }}
								<strong>{!! $order->get_order_number() !!}</strong>
								{{-- phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> --}}
							</li>
		
							<li class="woocommerce-order-overview__date date">
								{{ __( 'Date:', 'woocommerce' ) }}
								<strong>{{ wc_format_datetime( $order->get_date_created() ) }}
									{{-- phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong> --}}
							</li>
		
							@if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() )
								<li class="woocommerce-order-overview__email email">
									{{ __( 'Email:', 'woocommerce' ) }}
									<strong>{{ $order->get_billing_email() }}
										{{-- phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong> --}}
								</li>
							@endif
		
							<li class="woocommerce-order-overview__total total">
								{{ __( 'Total:', 'woocommerce' ) }}
								<strong>{!! $order->get_formatted_order_total() !!}
									{{-- phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong> --}}
							</li>
		
							@if ( $order->get_payment_method_title() )
								<li class="woocommerce-order-overview__payment-method method">
									{{ __( 'Payment method:', 'woocommerce' ) }}
									<strong>{!! wp_kses_post( $order->get_payment_method_title() ) !!} </strong>
								</li>
							@endif
		
						</ul>
					</div>
					
	
				@endif
	
				@php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ) @endphp
				@php do_action( 'woocommerce_thankyou', $order->get_id() ) @endphp
			</div>

			
			
			<div class="w-full ticket-head">
				<div class="w-full ticket-triangulo bg-tk-triangulo-down"></div>
			</div>
		</div>

	@else

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">{!! apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), null ) !!} </p>
		{{--  phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped --}}

	@endif

</div>
