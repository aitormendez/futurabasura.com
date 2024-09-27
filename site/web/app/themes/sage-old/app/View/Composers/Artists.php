<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Artists extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'page-artists',
    ];

    /**
     * Data to be passed to view.
     *
     * @return array
     */
    public function with()
    {
        return [
            'artists' => $this->artists(),
        ];
    }

    /**
     * Returns artist terms.
     *
     * @return array
     */
    public function artists()
    {
        $artists = get_terms('artist');

        $array = array_map(function ($artist) {

            $productos = get_posts(
                [
                    'post_type' => 'product',
                    'numberposts' => -1,
                    'tax_query' => [
                        [
                            'taxonomy' => 'artist',
                            'field' => 'slug',
                            'terms' => $artist,
                            'operator' => 'IN',
                        ]
                    ]
                ]
            );

            $array_prod = [];
            foreach ($productos as $prod) {
                $array_prod[] = [
                    'title'    => $prod->post_title,
                    'prod_img' => get_the_post_thumbnail($prod, 'post-thumbnail'),
                ];
            };

            $a = array_map(function($prod){

            }, $productos);

            $avatar = get_field('artist_avatar', $artist);
            if ($avatar) {
                $srcset = $avatar['sizes']['thumbnail'] . ' ' . $avatar['sizes']['thumbnail-width'] . 'w, ' .
                $srcset = $avatar['sizes']['medium'] . ' ' . $avatar['sizes']['medium-width'] . 'w, ' .
                $srcset = $avatar['sizes']['medium_large'] . ' ' . $avatar['sizes']['thumbnail-width'] . 'w, ' .
                $srcset = $avatar['sizes']['large'] . ' ' . $avatar['sizes']['large-width'] . 'w, '
                ;
            }



            $output = [
                'avatar'      => $avatar,
                'srcset'      => $avatar ? $srcset : '',
                'name'        => $artist->name,
                'slug'        => $artist->slug,
                'description' => $artist->description,
                'name'        => $artist->name,
                'productos'   => $productos,
                'products'    => $array_prod,
                'permalink'   => get_term_link($artist, 'artist'),
            ];
            return $output;
        }, $artists);


        return $array;
    }

}
