<?php
    /**
     * Review order table
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 5.2.0
     */

    defined('ABSPATH') || exit();
?>

<div class="woocommerce-checkout-review-order-table table w-full border-b-2 border-black">
    <!-- Encabezado de la tabla -->
    <div class="table-header-group">
        <div class="table-row">
            <div class="table-cell border-b-2 border-black px-4 text-left font-bold"><?php echo e(__('Product')); ?></div>
            <div class="table-cell border-b-2 border-black text-left font-bold"><?php echo e(__('Subtotal')); ?></div>
        </div>
    </div>

    <!-- Contenido de la tabla -->
    <div class="table-row-group">
        <?php
            do_action('woocommerce_review_order_before_cart_contents');
        ?>

        <?php $__currentLoopData = WC()->cart->get_cart(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_item_key => $cart_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $_product = apply_filters(
                    'woocommerce_cart_item_product',
                    $cart_item['data'],
                    $cart_item,
                    $cart_item_key,
                );
            ?>

            <?php if(
                $_product &&
                    $_product->exists() &&
                    $cart_item['quantity'] > 0 &&
                    apply_filters('woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key)): ?>
                <div
                    class="<?php echo e(esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key))); ?> table-row">
                    <div class="product-name table-cell border-b-2 border-black bg-white p-4">
                        <?php echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key)); ?>&nbsp;
                        <?php echo apply_filters(
                            'woocommerce_checkout_cart_item_quantity',
                            ' <strong class="product-quantity">' . sprintf('&times;&nbsp;%s', $cart_item['quantity']) . '</strong>',
                            $cart_item,
                            $cart_item_key,
                        ); ?>

                        <?php echo wc_get_formatted_cart_item_data($cart_item); ?>

                    </div>
                    <div class="product-total p-y table-cell border-b-2 border-black bg-white">
                        <?php echo apply_filters(
                            'woocommerce_cart_item_subtotal',
                            WC()->cart->get_product_subtotal($_product, $cart_item['quantity']),
                            $cart_item,
                            $cart_item_key,
                        ); ?>

                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php
            do_action('woocommerce_review_order_after_cart_contents');
        ?>
    </div>

    <!-- Pie de la tabla -->
    <div class="table-footer-group">
        <div class="cart-subtotal table-row">
            <div class="table-cell border-b-2 border-black py-4 pl-4 font-bold"><?php echo e(__('Subtotal')); ?></div>
            <div class="table-cell border-b-2 border-black py-4"><?php echo wc_cart_totals_subtotal_html(); ?></div>
        </div>

        <?php $__currentLoopData = WC()->cart->get_coupons(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cart-discount coupon-<?php echo e(esc_attr(sanitize_title($code))); ?> table-row">
                <div class="table-cell border-b-2 border-black py-4 pl-4 font-bold text-rojo"><?php echo wc_cart_totals_coupon_label($coupon); ?>

                </div>
                <div class="table-cell border-b-2 border-black py-4"><?php echo wc_cart_totals_coupon_html($coupon); ?></div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if(WC()->cart->needs_shipping() && WC()->cart->show_shipping()): ?>
            <?php
                do_action('woocommerce_review_order_before_shipping');
            ?>

            <?php echo wc_cart_totals_shipping_html(); ?>


            <?php
                do_action('woocommerce_review_order_after_shipping');
            ?>
        <?php endif; ?>

        <?php $__currentLoopData = WC()->cart->get_fees(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="fee table-row">
                <div class="table-cell font-bold"><?php echo e(esc_html($fee->name)); ?></div>
                <div class="table-cell"><?php echo wc_cart_totals_fee_html($fee); ?></div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if(wc_tax_enabled() && !WC()->cart->display_prices_including_tax()): ?>
            <?php if(get_option('woocommerce_tax_total_display') === 'itemized'): ?>
                <?php $__currentLoopData = WC()->cart->get_tax_totals(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="tax-rate tax-rate-<?php echo e(esc_attr(sanitize_title($code))); ?> table-row">
                        <div class="table-cell font-bold"><?php echo e(esc_html($tax->label)); ?></div>
                        <div class="table-cell"><?php echo wp_kses_post($tax->formatted_amount); ?></div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="tax-total table-row">
                    <div class="table-cell font-bold"><?php echo e(esc_html(WC()->countries->tax_or_vat())); ?></div>
                    <div class="table-cell"><?php echo wc_cart_totals_taxes_total_html(); ?></div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php
            do_action('woocommerce_review_order_before_order_total');
        ?>

        <div class="order-total table-row">
            <div class="table-cell py-4 pl-4 text-2xl font-bold"><?php echo e(__('Total')); ?></div>
            <div class="table-cell text-2xl"><?php echo wc_cart_totals_order_total_html(); ?></div>
        </div>

        <?php
            do_action('woocommerce_review_order_after_order_total');
        ?>
    </div>
</div>
<?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/woocommerce/checkout/review-order.blade.php ENDPATH**/ ?>