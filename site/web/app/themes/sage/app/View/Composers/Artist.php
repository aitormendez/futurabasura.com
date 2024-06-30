<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Artist extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'woocommerce.archive-product',
    ];

    /**
     * Data to be passed to view.
     *
     * @return array
     */
    public function with()
    {
        return [
            'artist_hero' => $this->artistHero(),
        ];
    }

    public function artistHero()
    {
        if (is_tax('artist')) {
            $term = get_queried_object();
            $hero = get_field('artist_hero', $term);

            $output = [
                'term' => $term,
                'has_hero_img' => false,
                'hero_img' => $hero,

            ];

            if ($hero) {
                $output['has_hero_img'] = true;
                $output['hero_srcset'] = wp_get_attachment_image_srcset($hero['ID']);
            }

            return $output;
        }
    }

}
