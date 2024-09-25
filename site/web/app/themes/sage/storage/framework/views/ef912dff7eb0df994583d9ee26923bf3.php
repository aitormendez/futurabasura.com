<?php
    /**
     * Simple product add to cart
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see https://docs.woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 3.4.0
     */

    defined('ABSPATH') || exit();

    global $product;

    if (!$product->is_purchasable()) {
        return;
    }

?>


<?php if($product->is_in_stock()): ?>

    <?php do_action( 'woocommerce_before_add_to_cart_form' ) ?>

    <form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>

        <?php do_action( 'woocommerce_before_add_to_cart_button' ) ?>

        <div class="hidden">
            <?php
                woocommerce_quantity_input([
                    'min_value' => apply_filters(
                        'woocommerce_quantity_input_min',
                        $product->get_min_purchase_quantity(),
                        $product,
                    ),
                    'max_value' => apply_filters(
                        'woocommerce_quantity_input_max',
                        $product->get_max_purchase_quantity(),
                        $product,
                    ),
                    'input_value' => isset($_POST['quantity'])
                        ? wc_stock_amount(wp_unslash($_POST['quantity']))
                        : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                ]);
            ?>
        </div>

        <?php do_action( 'woocommerce_after_add_to_cart_quantity' ) ?>

        
        <div class="inline-block">
            <div class="my-3 mr-6 flex justify-between bg-white text-sm">
                <?php if($precio['is_on_sale']): ?>
                    <div class="price-on-sale flex items-center px-4 text-2xl text-rojo">
                        <del><?php echo e($precio['regular_price']); ?></del> <del
                            class="woocommerce_price_euro_letter block">&nbsp;EUR</del>
                    </div>
                <?php endif; ?>
                <div class="px-8 py-4 text-2xl text-gris-fb">
                    <?php echo $precio['price']; ?> <span>€</span>
                </div>
                <div class="quantity flex">
                    <div id="quantityInput_remove"
                        class="inline-flex h-full cursor-pointer select-none items-center border-r-2 px-6 text-2xl hover:bg-gris-claro-fb">
                        <svg width="19" height="2" viewBox="0 0 19 2" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 1L19 1" stroke="#3E2B2F" stroke-width="2" />
                        </svg>
                    </div>
                    <input class="quantityInput h-full w-28 border-none px-8 py-4 text-center text-xl text-azul"
                        type="text" value="1" />
                    <div id="quantityInput_add"
                        class="inline-flex cursor-pointer select-none items-center border-l-2 px-6 text-2xl hover:bg-gris-claro-fb">
                        <svg width="19" height="20" viewBox="0 0 19 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 10L19 10" stroke="#3E2B2F" stroke-width="2" />
                            <path d="M9.5 19.5L9.5 0.5" stroke="#3E2B2F" stroke-width="2" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        

        <button type="submit" name="add-to-cart" value="<?php echo e($product->get_id()); ?>"
            class="bg-azul px-10 py-3 uppercase tracking-max text-white transition-colors clip-path-elipse hover:bg-allo hover:text-black"><?php echo e($product->single_add_to_cart_text()); ?></button>

        <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
    </form>

    <?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
<?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/woocommerce/single-product/add-to-cart/simple.blade.php ENDPATH**/ ?>