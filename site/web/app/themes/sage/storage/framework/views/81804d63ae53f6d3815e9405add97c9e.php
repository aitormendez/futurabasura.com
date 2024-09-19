

<?php
    $show_shipping = !wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>

<section class="woocommerce-customer-details pb-6">

    <?php if($show_shipping): ?>
        <section class="woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses">
            <div class="woocommerce-column woocommerce-column--1 woocommerce-column--billing-address col-1">
    <?php endif; ?>

    <h2 class="woocommerce-column__title my-6 border-b-2 border-dotted border-negro-fb px-4 text-xl">
        <?php echo e(esc_html__('Billing address', 'woocommerce')); ?></h2>

    <address class="px-4">
        <?php echo wp_kses_post($order->get_formatted_billing_address(esc_html__('N/A', 'woocommerce'))); ?>


        <?php if($order->get_billing_phone()): ?>
            <p class="woocommerce-customer-details--phone"><?php echo e(esc_html($order->get_billing_phone())); ?></p>
        <?php endif; ?>

        <?php if($order->get_billing_email()): ?>
            <p class="woocommerce-customer-details--email"><?php echo e(esc_html($order->get_billing_email())); ?></p>
        <?php endif; ?>

        <?php
            /**
             * Acción después de la dirección de facturación.
             *
             * @since 8.7.0
             * @param string $address_type Tipo de dirección (billing o shipping).
             * @param WC_Order $order Objeto de la orden.
             */
            do_action('woocommerce_order_details_after_customer_address', 'billing', $order);
        ?>
    </address>

    <?php if($show_shipping): ?>

        </div><!-- /.col-1 -->

        <div class="woocommerce-column woocommerce-column--2 woocommerce-column--shipping-address col-2">
            <h2 class="woocommerce-column__title my-6 border-b-2 border-dotted border-negro-fb px-4 text-xl">
                <?php echo e(esc_html__('Shipping address', 'woocommerce')); ?></h2>
            <address class="px-4">
                <?php echo wp_kses_post($order->get_formatted_shipping_address(esc_html__('N/A', 'woocommerce'))); ?>


                <?php if($order->get_shipping_phone()): ?>
                    <p class="woocommerce-customer-details--phone"><?php echo e(esc_html($order->get_shipping_phone())); ?></p>
                <?php endif; ?>

                <?php
                    /**
                     * Acción después de la dirección de envío.
                     *
                     * @since 8.7.0
                     * @param string $address_type Tipo de dirección (billing o shipping).
                     * @param WC_Order $order Objeto de la orden.
                     */
                    do_action('woocommerce_order_details_after_customer_address', 'shipping', $order);
                ?>
            </address>
        </div><!-- /.col-2 -->

</section><!-- /.col2-set -->

<?php endif; ?>

<?php do_action('woocommerce_order_details_after_customer_details', $order); ?>

</section>
<?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/woocommerce/order/order-details-customer.blade.php ENDPATH**/ ?>