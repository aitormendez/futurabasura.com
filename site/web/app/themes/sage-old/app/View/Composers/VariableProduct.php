<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use WC_Product_Variable;
use WC_Product;

class VariableProduct extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'woocommerce.single-product.add-to-cart.variable',
    ];

    /**
     * Data to be passed to view before rendering, but after merging.
     *
     * @return array
     */
    public function with()
    {
        return [
            'precio_variacion' => $this->precioVariacion(),
        ];
    }

    /**
     * Obtiene el precio del producto variable o el rango de precios.
     *
     * @return array
     */
    public function precioVariacion()
    {
        // Obtener el producto actual
        global $product;

        if (!$product instanceof WC_Product_Variable) {
            return [
                'price' => '',
                'is_range' => false,
            ];
        }

        // Obtener el precio mínimo y máximo
        $price_min = wc_price($product->get_variation_price('min'));
        $price_max = wc_price($product->get_variation_price('max'));

        // Verificar si es un rango de precios o un solo precio
        $is_range = ($price_min !== $price_max);

        if ($is_range) {
            return [
                'price' => "{$price_min} - {$price_max}",
                'is_range' => true,
            ];
        } else {
            return [
                'price' => $price_min,
                'is_range' => false,
            ];
        }
    }
}
