<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Slider extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.slider',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'slider' => $this->slider(),
        ];
    }

    /**
     * Devuelve los productos seleccionados para el slider.
     *
     * @return array
     */
    public function slider()
    {
        $posts = get_posts([
            'post_type'		=> 'product',
            'posts_per_page'	=> -1,
            'meta_query'	=> [
                [
                    'key'	 	=> 'mostrar_en_slider',
                    'value'	  	=> 1,
                ]
            ]
        ]);

        $array = array_map(function ($post) {
            $img = get_field('img_producto', $post->ID);
            $formato = get_field('formato', $post->ID);

            if ($formato == '50x70v') {
                $formato_humano = '50 x 70 cm';
            } elseif ($formato == '50x70h') {
                $formato_humano = '70 x 50 cm';
            } elseif ($formato == '61x91v') {
                $formato_humano = '61 x 91 cm';
            } elseif ($formato == '61x91h') {
                $formato_humano = '91 x 61 cm';
            }

            $nombre = $post->post_title;
            $permalink = get_permalink($post->ID);
            $artist = get_the_terms($post->ID, 'artist');
            $product = wc_get_product($post->ID);
            $regular_price = $product->get_regular_price();
            $format = $product->get_attribute( 'format' );
            $sale_prize = $product->get_sale_price();

            $output = [
                'post_id'        => $post->ID,
                'formato'        => $formato,
                'post'           => $post,
                'product'        => $product,
                'nombre'         => $nombre,
                'url'            => $permalink,
                'formato_humano' => $formato_humano,
                'regular_price'  => $regular_price,
                'product_type'   => $product->get_type(),
                'has_format'     => false,
                'has_sale_prize' => false,
            ];

            if ($sale_prize) {
                $output['has_sale_prize'] = true;
                $output['sale_prize'] = $sale_prize;
            }

            if ($format) {
                $output['has_format'] = true;
                $output['format'] = $format;
            }    

            if ( $product->is_type( 'variable' ) ) {
                $variations = $product->get_available_variations();
                $variaciones_ids = $product->get_children();
    
                $vrtns = array_map(function($v) {
                    $prod = wc_get_product($v);
                    $atts = $prod->get_attributes();
                    return [
                        'prod'          => $prod,
                        'sale_price'    =>  $prod->get_sale_price(),
                        'regular_price' =>  $prod->get_regular_price(),
                        'atts'          =>  $atts,
                        'format'        => str_replace('-', ' ', $atts['pa_format']),
    
                    ];
                }, $variaciones_ids);
    
                $output['variaciones'] = $vrtns;
            }

            if ($img) {
                 $output['img'] = $img;
                 $output['srcset'] = wp_get_attachment_image_srcset($img['ID']);
            }

            if ($artist) {
                $output['artist'] = $artist[0]->name;
            }


            return $output;
        }, $posts);

        return $array;
    }

}
