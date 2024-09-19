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
?>

<?php if(!defined('ABSPATH')): ?>
    <?php exit; ?>
<?php endif; ?>


<?php do_action('woocommerce_before_checkout_form', $checkout); ?>


<?php if(!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()): ?>
    <p><?php echo e(__('You must be logged in to checkout.', 'woocommerce')); ?></p>
    <?php return; ?>
<?php endif; ?>


<form name="checkout" method="post" class="checkout woocommerce-checkout font-sans" action="<?php echo e(wc_get_checkout_url()); ?>"
    enctype="multipart/form-data">

    
    <div class="ticket">
        <div class="ticket-head w-full">
            <div class="ticket-triangulo w-full bg-tk-triangulo"></div>
            <div class="h-10 w-full bg-allo-claro"></div>
        </div>
        <div class="tk-body bg-allo-claro">
            <?php if($checkout->get_checkout_fields()): ?>
                
                <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                <div class="col2-set flex w-full flex-col md:!flex-row" id="customer_details">
                    <div class="col-1 px-4 md:w-1/2">
                        
                        <?php do_action('woocommerce_checkout_billing'); ?>
                    </div>
                    <div class="col-2 px-4 md:w-1/2">
                        
                        <?php do_action('woocommerce_checkout_shipping'); ?>
                    </div>
                </div>

                
                <?php do_action('woocommerce_checkout_after_customer_details'); ?>
            <?php endif; ?>

            
            <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

            <h3 class="ml-4 mt-14" id="order_review_heading"><?php echo e(__('Your order', 'woocommerce')); ?></h3>

            
            <?php do_action('woocommerce_checkout_before_order_review'); ?>

            <div id="order_review" class="woocommerce-checkout-review-order">
                
                <?php do_action('woocommerce_checkout_order_review'); ?>
            </div>

            

        </div>
        <div class="ticket-head w-full">
            <div class="h-10 w-full bg-allo-claro"></div>
            <div class="ticket-triangulo w-full bg-tk-triangulo-down"></div>
        </div>
    </div>

</form>


<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
<?php /**PATH /srv/www/futurabasura.com/current/web/app/themes/sage/resources/views/woocommerce/checkout/form-checkout.blade.php ENDPATH**/ ?>