<?php
    /**
     * Order details
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 9.0.0
     *
     * @var bool $show_downloads Controls whether the downloads table should be rendered.
     */

    // phpcs:disable WooCommerce.Commenting.CommentHooks.MissingHookComment

    defined('ABSPATH') || exit();

    $order = wc_get_order($order_id); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

    if (!$order) {
        return;
    }

    $order_items = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));
    $show_purchase_note = $order->has_status(
        apply_filters('woocommerce_purchase_note_order_statuses', ['completed', 'processing']),
    );
    $downloads = $order->get_downloadable_items();

    // We make sure the order belongs to the user. This will also be true if the user is a guest, and the order belongs to a guest (userID === 0).
    $show_customer_details = $order->get_user_id() === get_current_user_id();

?>

<?php if($show_downloads): ?>
    <?php echo $__env->make('order.order-downloads', ['downloads' => $downloads, 'show_title' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<section class="woocommerce-order-details">
    <?php do_action('woocommerce_order_details_before_order_table', $order) ?>

    <h2 class="woocommerce-order-details__title my-6 border-b-2 border-dotted border-negro-fb px-4 text-xl">
        <?php esc_html_e('Order details', 'woocommerce'); ?></h2>

    <div class="woocommerce-table woocommerce-table--order-details shop_table order_details table w-full">

        <div class="table-header-group">
            <div class="table-row">
                <div class="woocommerce-table__product-name product-name table-cell border-b-2 border-negro-fb px-4 text-left font-bold"
                    role="columnheader">
                    <?php esc_html_e('Product', 'woocommerce'); ?>
                </div>

                <div class="woocommerce-table__product-table product-total table-cell border-b-2 border-negro-fb font-bold"
                    role="columnheader">
                    <?php esc_html_e('Total', 'woocommerce'); ?>
                </div>
            </div>
        </div>

        <div class="table-row-group">
            <?php do_action('woocommerce_order_details_before_order_table_items', $order) ?>
            <?php $__currentLoopData = $order_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $product = $item->get_product();

                    wc_get_template('order/order-details-item.php', [
                        'order' => $order,
                        'item_id' => $item_id,
                        'item' => $item,
                        'show_purchase_note' => $show_purchase_note,
                        'purchase_note' => $product ? $product->get_purchase_note() : '',
                        'product' => $product,
                    ]);
                ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php do_action('woocommerce_order_details_after_order_table_items', $order) ?>
        </div>

        <div class="table-footer-group">
            <?php $__currentLoopData = $order->get_order_item_totals(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $total): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="table-row">
                    <?php if($key === 'order_total'): ?>
                        <div class="table-cell border-b-2 border-negro-fb bg-negro-fb p-4 text-left text-xl font-bold text-white"
                            role="rowheader">
                            <?php echo e($total['label']); ?></div>
                        <div class="table-cell border-b-2 border-negro-fb bg-negro-fb text-xl font-bold text-white">
                            <?php echo $total['value']; ?></div>
                    <?php else: ?>
                        <div class="table-cell border-b-2 border-negro-fb px-4 py-1 text-left font-bold"
                            role="rowheader">
                            <?php echo e($total['label']); ?></div>
                        <div class="table-cell border-b-2 border-negro-fb"><?php echo $total['value']; ?>

                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($order->get_customer_note()): ?>
                <div class="table-row">
                    <div class="table-cell border-b-2 border-negro-fb font-bold" role="rowheader">
                        <?php echo e(__('Note:', 'woocommerce')); ?></div>
                    <div class="table-cell border-b-2 border-negro-fb"><?php echo nl2br(e($order->get_customer_note())); ?></div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php do_action('woocommerce_order_details_after_order_table', $order) ?>
</section>

<?php
    /**
     * Action hook fired after the order details.
     *
     * @since 4.4.0
     * @param WC_Order $order Order data.
     */
    do_action('woocommerce_after_order_details', $order);
?>

<?php if($show_customer_details): ?>
    <?php wc_get_template('order/order-details-customer.php', ['order' => $order]); ?>
<?php endif; ?>
<?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/woocommerce/order/order-details.blade.php ENDPATH**/ ?>