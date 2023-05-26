<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;
use Log1x\Navi\Facades\Navi;

class Navigation extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.header',
        'partials.footer',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'primary_nav' => $this->navigation(),
            'info_nav' => $this->infoNavigation(),
            'social_nav' => $this->socialNavigation(),
            'shop_nav' => $this->shopNavigation(),
            'contents_nav' => $this->contentsNavigation(),
            'items_cart' => $this->itemsInCart(),
            'frase' => $this->frase(),
        ];
    }

    /**
     * Returns the primary navigation.
     *
     * @return array
     */
    public function navigation()
    {
        if (Navi::build()->isEmpty()) {
            return;
        }

        return Navi::build()->toArray();
    }

    /**
     * Returns the info navigation.
     *
     * @return array
     */
    public function infoNavigation()
    {
        if (Navi::build()->isEmpty()) {
            return;
        }

        return Navi::build('info')->toArray();
    }

    /**
     * Returns the social navigation.
     *
     * @return array
     */
    public function socialNavigation()
    {
        if (Navi::build()->isEmpty()) {
            return;
        }

        return Navi::build('social')->toArray();
    }

    /**
     * Returns the shop navigation.
     *
     * @return array
     */
    public function shopNavigation()
    {
        if (Navi::build()->isEmpty()) {
            return;
        }

        return Navi::build('shop')->toArray();
    }

    /**
     * Returns the contents navigation.
     *
     * @return array
     */
    public function contentsNavigation()
    {
        if (Navi::build()->isEmpty()) {
            return;
        }

        return Navi::build('contents')->toArray();
    }

    /**
     * Returns number of items in cart.
     *
     * @return string
     */
    public function itemsInCart()
    {
        global $woocommerce;
        return $woocommerce->cart->cart_contents_count;
    }

    /**
     * Frases para brand. Se proporciona la primera frase que aparece en el banner.
     *
     * @return string
     */
    public function frase()
    {
        $frases = get_field('frases', 'option');

        if( $frases ) {
            $frases_array = [];
            foreach( $frases as $frase ) {
                $frases_array[] = $frase['frase'];
            };
        }

        return $frases_array[array_rand($frases_array)];
    }


}
