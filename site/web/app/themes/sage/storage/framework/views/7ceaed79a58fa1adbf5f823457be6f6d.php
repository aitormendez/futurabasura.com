<?php
    /**
     * TRADUCCIÓN DE LA PLANTILLA ORIGINAL A BLADE
     * Cart totals
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see https://docs.woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 2.3.6
     */

    defined('ABSPATH') || exit();
?>

<div class="cart_totals <?php echo WC()->customer->has_calculated_shipping() ? 'calculated_shipping' : ''; ?> mt-2 bg-allo-claro pt-12 font-sans">

    <?php do_action( 'woocommerce_before_cart_totals' ) ?>

    <h2><?php echo e(__('Cart totals', 'woocommerce')); ?></h2>


    <div class="table w-full">
        <div class="table-row-group">
            <div class="table-row">
                <div class="table-cell w-1/5 border-b-2 border-black p-4 font-bold md:w-1/4 md:pl-12">
                    <?php echo e(__('Subtotal', 'woocommerce')); ?>

                </div>
                <div class="table-cell border-b-2 border-black p-4">
                    <?php echo e(wc_cart_totals_subtotal_html()); ?>

                </div>
            </div>

            <?php $__currentLoopData = WC()->cart->get_coupons(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="table-row">
                    <div class="table-cell w-1/5 border-b-2 border-black p-4 font-bold md:w-1/4 md:pl-12">
                        <?php echo e(wc_cart_totals_coupon_label($coupon)); ?>

                    </div>
                    <div class="table-cell border-b-2 border-black p-4">
                        <?php echo e(wc_cart_totals_coupon_html($coupon)); ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if(WC()->cart->needs_shipping() && WC()->cart->show_shipping()): ?>
                <div class="row-shipping woocommerce-shipping-calculator table-row">
                    <div class="table-cell w-1/5 border-b-2 border-black p-4 font-bold md:w-1/4 md:pl-12">
                        Shipping
                    </div>
                    <div class="table-cell w-full border-b-2 border-black py-4 md:px-4">
                        <?php
                            do_action('woocommerce_cart_totals_before_shipping');
                            wc_cart_totals_shipping_html();
                            do_action('woocommerce_cart_totals_after_shipping');
                        ?>
                    </div>
                </div>
            <?php elseif(WC()->cart->needs_shipping() && 'yes' === get_option('woocommerce_enable_shipping_calc')): ?>
                <div class="row-shipping woocommerce-shipping-calculator table-row">
                    <div class="table-cell w-1/5 border-b-2 border-black p-4 font-bold md:w-1/4 md:pl-12">
                        Shipping
                    </div>
                    <div class="table-cell w-full border-b-2 border-black py-4 md:px-4">
                        <?php
                            woocommerce_shipping_calculator();
                        ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php $__currentLoopData = WC()->cart->get_fees(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="table-row">
                    <div class="table-cell w-1/5 border-b-2 border-black p-4 font-bold md:w-1/4 md:pl-12">
                        <?php echo e($fee->name); ?>

                    </div>
                    <div class="table-cell border-b-2 border-black p-4">
                        <?php wc_cart_totals_fee_html( $fee ) ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            <?php if(wc_tax_enabled() && !WC()->cart->display_prices_including_tax()): ?>
                <?php
                    $taxable_address = WC()->customer->get_taxable_address();
                    $estimated_text = '';
                ?>
                <?php if(WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping()): ?>
                    <?php
                        /* translators: %s location. */
                        $estimated_text = sprintf(
                            ' <small>' . esc_html__('(estimated for %s)', 'woocommerce') . '</small>',
                            WC()->countries->estimated_for_prefix($taxable_address[0]) .
                                WC()->countries->countries[$taxable_address[0]],
                        );
                    ?>
                <?php endif; ?>

                <?php if('itemized' === get_option('woocommerce_tax_total_display')): ?>
                    <?php $__currentLoopData = WC()->cart->get_tax_totals(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="tax-rate tax-rate-<?php echo esc_attr(sanitize_title($code)); ?> table-row">
                            <div class="table-cell w-1/5 border-b-2 border-black p-4 font-bold md:w-1/4 md:pl-12">
                                <?php echo e($tax->label); ?> <?php echo $estimated_text; ?>

                            </div>
                            <div class="table-cell border-b-2 border-black p-4">
                                <?php echo e($tax->label); ?>"><?php echo wp_kses_post($tax->formatted_amount); ?>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="tax-total table-row">
                        <div class="table-cell w-1/5 border-b-2 border-black p-4 font-bold md:w-1/4 md:pl-12">
                            <?php echo e(WC()->countries->tax_or_vat()); ?><?php echo $estimated_text; ?>

                        </div>
                        <div class="table-cell border-b-2 border-black p-4">
                            <?php wc_cart_totals_taxes_total_html()?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php do_action('woocommerce_cart_totals_before_order_total'); ?>

            <div class="table-row text-2xl">
                <div class="table-cell w-1/5 p-4 pl-12 font-bold md:w-1/4">
                    <?php echo e(__('Total', 'woocommerce')); ?>

                </div>
                <div class="table-cell border-black p-4">
                    <?php wc_cart_totals_order_total_html() ?>
                </div>
            </div>

            <?php do_action( 'woocommerce_cart_totals_after_order_total' ) ?>
        </div>
    </div>

    <div class="wc-proceed-to-checkout">
        <?php do_action( 'woocommerce_proceed_to_checkout' )?>
    </div>

    <?php do_action( 'woocommerce_after_cart_totals' )?>

</div>
<?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/woocommerce/cart/cart-totals.blade.php ENDPATH**/ ?>