{{-- Se usa en la portada de la tienda (archivo) --}}

<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit();

global $product;

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}
?>
<li <?php wc_product_class('', $product); ?>>
    @if ($isMobile) 
    @else
        <div class="card">
            <div class="card-inner">
                <div class="card-front">
                    {!! woocommerce_get_product_thumbnail() !!}
                </div>
                <div class="card-back bg-white pt-1 flex flex-col justify-between items-center">
                    {!! mostrar_tipo_producto() !!}
                    {!! mostrar_artista_producto()  !!}
                    {!! woocommerce_template_loop_product_title() !!}
                    <ul class="w-full">
                        {!! mostrar_informacion_producto() !!}
                    </ul>
                </div>
            </div>
        </div>
    @endif
</li>

