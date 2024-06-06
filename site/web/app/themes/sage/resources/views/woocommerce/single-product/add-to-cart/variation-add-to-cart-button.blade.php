<?php
/**
 * Single variation cart button
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="woocommerce-variation-add-to-cart variations_button mt-20">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<?php
	do_action( 'woocommerce_before_add_to_cart_quantity' );

	woocommerce_quantity_input(
		array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
		)
	);

	do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>

	<div class="inline-block" >
		<div class="flex justify-between my-3 text-sm bg-white mr-6">
		<div class="flex quantity">
			<div id="quantityInput_remove" class="cursor-pointer select-none hover:bg-gris-claro-fb text-2xl h-full border-r-2 inline-flex items-center px-6">
				<svg width="19" height="2" viewBox="0 0 19 2" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0 1L19 1" stroke="#3E2B2F" stroke-width="2"/>
				</svg>                  
			</div>
			<input class="quantityInput py-4 px-8 border-none text-azul h-full w-28 text-xl text-center" type="text" value="1"/>
			<div id="quantityInput_add" class="cursor-pointer select-none hover:bg-gris-claro-fb text-2xl border-l-2 inline-flex items-center px-6">
				<svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M0 10L19 10" stroke="#3E2B2F" stroke-width="2"/>
					<path d="M9.5 19.5L9.5 0.5" stroke="#3E2B2F" stroke-width="2"/>
				</svg>
			</div>
		</div>
		</div>
	</div>

	<button type="submit" class="px-20 py-3 bg-azul clip-path-elipse text-white uppercase tracking-max hover:bg-allo hover:text-black transition-colors<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
	
</div>
