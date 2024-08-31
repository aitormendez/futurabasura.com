<?php
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

    defined('ABSPATH') || exit();

    $formatted_destination = isset($formatted_destination)
        ? $formatted_destination
        : WC()->countries->get_formatted_address($package['destination'], ', ');
    $has_calculated_shipping = !empty($has_calculated_shipping);
    $show_shipping_calculator = !empty($show_shipping_calculator);
    $calculator_text = '';
?>

<div class="woocommerce-shipping-totals shipping table-row">
    <!-- Encabezado de la fila -->
    <div class="table-cell border-b-2 border-black py-4 pl-4 font-bold">
        <?php echo $package_name; ?>

    </div>
    <!-- Contenido de la celda -->
    <div class="table-cell border-b-2 border-black py-4" data-title="<?php echo $package_name; ?>">
        <?php if(!empty($available_methods) && is_array($available_methods)): ?>
            <div id="shipping_method" class="woocommerce-shipping-methods">
                <?php $__currentLoopData = $available_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mb-2">
                        <?php if(count($available_methods) > 1): ?>
                            <input type="radio" name="shipping_method[<?php echo e($index); ?>]"
                                data-index="<?php echo e($index); ?>"
                                id="shipping_method_<?php echo e($index); ?>_<?php echo e(sanitize_title($method->id)); ?>"
                                value="<?php echo e($method->id); ?>" class="shipping_method"
                                <?php echo e($method->id == $chosen_method ? 'checked' : ''); ?>>
                        <?php else: ?>
                            <input type="hidden" name="shipping_method[<?php echo e($index); ?>]"
                                data-index="<?php echo e($index); ?>"
                                id="shipping_method_<?php echo e($index); ?>_<?php echo e(sanitize_title($method->id)); ?>"
                                value="<?php echo e($method->id); ?>" class="shipping_method">
                        <?php endif; ?>
                        <label for="shipping_method_<?php echo e($index); ?>_<?php echo e(sanitize_title($method->id)); ?>">
                            <?php echo wc_cart_totals_shipping_method_label($method); ?>

                        </label>
                        <?php do_action('woocommerce_after_shipping_rate', $method, $index) ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <?php if(is_cart()): ?>
                <p class="woocommerce-shipping-destination mt-4">
                    <?php if($formatted_destination): ?>
                        <?php echo __('Shipping to ', 'woocommerce'); ?> <strong><?php echo $formatted_destination; ?></strong>.
                        <?php $calculator_text = __('Change address', 'woocommerce') ?>
                    <?php else: ?>
                        <?php echo apply_filters(
                            'woocommerce_shipping_estimate_html',
                            __('Shipping options will be updated during checkout.', 'woocommerce'),
                        ); ?>

                    <?php endif; ?>
                </p>
            <?php endif; ?>
        <?php elseif(!$has_calculated_shipping || !$formatted_destination): ?>
            <?php if(is_cart() && get_option('woocommerce_enable_shipping_calc') == 'no'): ?>
                <p>
                    <?php echo apply_filters(
                        'woocommerce_shipping_not_enabled_on_cart_html',
                        __('Shipping costs are calculated during checkout.', 'woocommerce'),
                    ); ?>

                </p>
            <?php else: ?>
                <p>
                    <?php echo apply_filters(
                        'woocommerce_shipping_may_be_available_html',
                        __('Enter your address to view shipping options.', 'woocommerce'),
                    ); ?>

                </p>
            <?php endif; ?>
        <?php elseif(!is_cart()): ?>
            <p>
                <?php echo apply_filters(
                    'woocommerce_no_shipping_available_html',
                    __(
                        'There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.',
                        'woocommerce',
                    ),
                ); ?>

            </p>
        <?php else: ?>
            <p>
                <?php echo apply_filters(
                    'woocommerce_cart_no_shipping_available_html',
                    sprintf(
                        __('No shipping options were found for %s.', 'woocommerce') . ' ',
                        '<strong>' . $formatted_destination . '</strong>',
                    ),
                    $formatted_destination,
                ); ?>

                <?php $calculator_text = __('Enter a different address', 'woocommerce') ?>
            </p>
        <?php endif; ?>

        <?php if($show_package_details): ?>
            <p class="woocommerce-shipping-contents"><small><?php echo $package_details; ?></small></p>
        <?php endif; ?>

        <?php if($show_shipping_calculator): ?>
            <div class="mt-4">
                <?php woocommerce_shipping_calculator($calculator_text) ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/woocommerce/cart/cart-shipping.blade.php ENDPATH**/ ?>