@php
    /**
     * Simple product add to cart
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
     *
     * @see https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 7.0.1
     */

    defined('ABSPATH') || exit();

    global $product;

    if (!$product->is_purchasable()) {
        return;
    }

    // Stock HTML si lo quieres mostrar:
    // echo wc_get_stock_html($product);

@endphp

@if ($product->is_in_stock())

    @php do_action('woocommerce_before_add_to_cart_form') @endphp

    <form class="cart relative"
        action="{{ esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())) }}"
        method="post" enctype="multipart/form-data">

        @php do_action('woocommerce_before_add_to_cart_button') @endphp

        {{-- Campo original oculto para enviar cantidad --}}
        <input type="hidden" name="quantity" value="{{ old('quantity', $product->get_min_purchase_quantity()) }}"
            id="quantity-hidden" />

        {{-- Control personalizado de cantidad + precio --}}
        <div class="md:inline-block">
            <div class="my-3 flex justify-between bg-white text-sm md:mr-6">
                @isset($precio['is_on_sale'])
                    @if ($precio['is_on_sale'])
                        <div class="price-on-sale text-rojo flex items-center px-4 text-2xl">
                            <del>{{ $precio['regular_price'] }}</del>
                            <del class="woocommerce_price_euro_letter block">&nbsp;EUR</del>
                        </div>
                    @endif
                @endisset

                <div class="text-gris-fb px-8 py-4 text-2xl">
                    {!! $precio['price'] ?? wc_price($product->get_price()) !!} <span>€</span>
                </div>

                <div class="quantity flex">
                    <div id="quantityInput_remove"
                        class="hover:bg-gris-claro-fb inline-flex h-full cursor-pointer select-none items-center border-r-2 px-6 text-2xl">
                        <svg width="19" height="2" viewBox="0 0 19 2" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 1L19 1" stroke="#3E2B2F" stroke-width="2" />
                        </svg>
                    </div>
                    <input class="quantityInput text-azul h-full w-28 border-none px-8 py-4 text-center text-xl"
                        type="text" value="1" min="{{ $product->get_min_purchase_quantity() }}"
                        max="{{ $product->get_max_purchase_quantity() }}" inputmode="numeric" pattern="[0-9]*" />
                    <div id="quantityInput_add"
                        class="hover:bg-gris-claro-fb inline-flex cursor-pointer select-none items-center border-l-2 px-6 text-2xl">
                        <svg width="19" height="20" viewBox="0 0 19 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 10L19 10" stroke="#3E2B2F" stroke-width="2" />
                            <path d="M9.5 19.5L9.5 0.5" stroke="#3E2B2F" stroke-width="2" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" name="add-to-cart" value="{{ $product->get_id() }}"
            class="bg-azul clip-path-elipse hover:bg-allo absolute left-1/2 block -translate-x-1/2 translate-y-1/2 whitespace-nowrap px-20 py-6 text-sm uppercase tracking-widest text-white transition-colors hover:text-black">
            {{ $product->single_add_to_cart_text() }}
        </button>

        @php do_action('woocommerce_after_add_to_cart_button') @endphp
    </form>

    @php do_action('woocommerce_after_add_to_cart_form') @endphp

@endif

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputVisible = document.querySelector('.quantityInput');
            const inputHidden = document.getElementById('quantity-hidden');
            const addBtn = document.getElementById('quantityInput_add');
            const removeBtn = document.getElementById('quantityInput_remove');

            function syncQuantity() {
                inputHidden.value = inputVisible.value;
            }

            inputVisible.addEventListener('input', syncQuantity);
            addBtn?.addEventListener('click', () => {
                inputVisible.value = parseInt(inputVisible.value || 1) + 1;
                syncQuantity();
            });
            removeBtn?.addEventListener('click', () => {
                inputVisible.value = Math.max(1, parseInt(inputVisible.value || 1) - 1);
                syncQuantity();
            });
        });
    </script>
@endpush
