<?php
    /**
     * Checkout billing information form
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 3.6.0
     * @global WC_Checkout $checkout
     */

    defined('ABSPATH') || exit();
?>

<div class="woocommerce-billing-fields">
    <?php if(wc_ship_to_billing_address_only() && WC()->cart->needs_shipping()): ?>
        <h3><?php echo e(__('Billing & Shipping', 'woocommerce')); ?></h3>
    <?php else: ?>
        <h3><?php echo e(__('Billing details', 'woocommerce')); ?></h3>
    <?php endif; ?>

    <?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>

    <div class="woocommerce-billing-fields__field-wrapper">
        <?php
            $fields = $checkout->get_checkout_fields('billing');
        ?>

        <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>
</div>

<?php if(!is_user_logged_in() && $checkout->is_registration_enabled()): ?>
    <div class="woocommerce-account-fields">
        <?php if(!$checkout->is_registration_required()): ?>
            <p class="form-row form-row-wide create-account">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
                        id="createaccount" <?php if(true === $checkout->get_value('createaccount') ||
                                true === apply_filters('woocommerce_create_account_default_checked', false)): echo 'checked'; endif; ?> type="checkbox" name="createaccount"
                        value="1" /> <span><?php echo e(__('Create an account?', 'woocommerce')); ?></span>
                </label>
            </p>
        <?php endif; ?>

        <?php do_action('woocommerce_before_checkout_registration_form', $checkout); ?>

        <?php if($checkout->get_checkout_fields('account')): ?>
            <div class="create-account">
                <?php $__currentLoopData = $checkout->get_checkout_fields('account'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="clear"></div>
            </div>
        <?php endif; ?>

        <?php do_action('woocommerce_after_checkout_registration_form', $checkout); ?>
    </div>
<?php endif; ?>
<?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/woocommerce/checkout/form-billing.blade.php ENDPATH**/ ?>