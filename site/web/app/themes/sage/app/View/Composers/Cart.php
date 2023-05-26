<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Cart extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'woocommerce.cart-totals',
    ];

    /**
     * Data to be passed to view.
     *
     * @return array
     */
    public function with()
    {
        return [
            // 'exp_cart_totals' => $this->artists(),
        ];
    }

}
