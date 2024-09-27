<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Cupones extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.cupones',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'cupones' => $this->cupones(),
        ];
    }

    public function cupones()
    {
        $cupones_portada = get_posts([
            'posts_per_page'   => -1,
            'orderby'          => 'title',
            'order'            => 'asc',
            'post_type'        => 'shop_coupon',
            'post_status'      => 'publish',
            'meta_key'		   => 'mostrar_cupon_en_portada',
            'meta_value'	   => true,
        ]);

        return $cupones_portada;
    }
}
