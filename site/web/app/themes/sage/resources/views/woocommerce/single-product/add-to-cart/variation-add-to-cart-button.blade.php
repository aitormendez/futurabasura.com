<?php
/**
 * Single variation cart button
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit();

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button relative mt-10 w-full">
    <?php do_action('woocommerce_before_add_to_cart_button'); ?>

    <?php
    do_action('woocommerce_before_add_to_cart_quantity');
    
    woocommerce_quantity_input([
        'min_value' => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
        'max_value' => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
        'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
    ]);
    
    do_action('woocommerce_after_add_to_cart_quantity');
    ?>

    <div class="inline-block">
        <div class="mr-6 flex justify-between bg-white text-sm">
            <div class="quantity flex">
                <div id="quantityInput_remove"
                    class="hover:bg-gris-claro-fb inline-flex h-full cursor-pointer select-none items-center border-r-2 px-6 text-2xl">
                    <svg width="19" height="2" viewBox="0 0 19 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 1L19 1" stroke="#3E2B2F" stroke-width="2" />
                    </svg>
                </div>
                <input class="quantityInput text-azul h-full w-28 border-none px-8 py-4 text-center text-xl"
                    type="text" value="1" />
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

    @if (wp_is_mobile())
        <div class="mt-12 flex w-full justify-center">
            <button type="submit"
                class="<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?> bg-azul clip-path-elipse hover:bg-allo px-20 py-6 text-sm uppercase tracking-widest text-white transition-colors hover:text-black"><?php echo esc_html($product->single_add_to_cart_text()); ?>
            </button>
        </div>
    @else
        <button type="submit"
            class="<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?> bg-azul clip-path-elipse hover:bg-allo -translate-x-1/2 px-10 py-6 text-sm uppercase tracking-widest text-white transition-colors hover:text-black md:absolute md:left-1/2 md:top-1/2 md:-translate-y-1/2"><?php echo esc_html($product->single_add_to_cart_text()); ?>
        </button>
    @endif

    <?php do_action('woocommerce_after_add_to_cart_button'); ?>

    <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
    <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
    <input type="hidden" name="variation_id" class="variation_id" value="0" />

</div>
