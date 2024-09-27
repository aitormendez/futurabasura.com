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
@endphp

@if (!defined('ABSPATH'))
    @php exit; @endphp
@endif

{{-- Acción personalizada antes de mostrar el formulario de checkout --}}
@php do_action('woocommerce_before_checkout_form', $checkout); @endphp

{{-- Si el registro de checkout está deshabilitado y el usuario no está logueado --}}
@if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in())
    <p>{{ __('You must be logged in to checkout.', 'woocommerce') }}</p>
    @php return; @endphp
@endif


<form name="checkout" method="post" class="checkout woocommerce-checkout font-sans" action="{{ wc_get_checkout_url() }}"
    enctype="multipart/form-data">

    {{-- ticket --}}
    <div class="ticket">
        <div class="ticket-head w-full">
            <div class="ticket-triangulo w-full bg-tk-triangulo"></div>
            <div class="h-10 w-full bg-allo-claro"></div>
        </div>
        <div class="tk-body bg-allo-claro">
            @if ($checkout->get_checkout_fields())
                {{-- Acción personalizada antes de los detalles del cliente --}}
                @php do_action('woocommerce_checkout_before_customer_details'); @endphp

                <div class="col2-set flex w-full flex-col md:!flex-row" id="customer_details">
                    <div class="col-1 px-4 md:w-1/2">
                        {{-- Acción personalizada para la sección de facturación --}}
                        @php do_action('woocommerce_checkout_billing'); @endphp
                    </div>
                    <div class="col-2 px-4 md:w-1/2">
                        {{-- Acción personalizada para la sección de envío --}}
                        @php do_action('woocommerce_checkout_shipping'); @endphp
                    </div>
                </div>

                {{-- Acción personalizada después de los detalles del cliente --}}
                @php do_action('woocommerce_checkout_after_customer_details'); @endphp
            @endif

            {{-- Acción personalizada antes del título de la revisión de la orden --}}
            @php do_action('woocommerce_checkout_before_order_review_heading'); @endphp

            <h3 class="ml-4 mt-14" id="order_review_heading">{{ __('Your order', 'woocommerce') }}</h3>

            {{-- Acción personalizada antes de la revisión de la orden --}}
            @php do_action('woocommerce_checkout_before_order_review'); @endphp

            <div id="order_review" class="woocommerce-checkout-review-order">
                {{-- Acción personalizada para la revisión de la orden --}}
                @php do_action('woocommerce_checkout_order_review'); @endphp
            </div>

            {{-- Acción personalizada después de la revisión de la orden --}}
            @php do_action('woocommerce_checkout_after_order_review'); @endphp
        </div>
        <div class="ticket-head w-full">
            <div class="h-10 w-full bg-allo-claro"></div>
            <div class="ticket-triangulo w-full bg-tk-triangulo-down"></div>
        </div>
    </div>

</form>

{{-- Acción personalizada después de mostrar el formulario de checkout --}}
@php do_action('woocommerce_after_checkout_form', $checkout); @endphp
