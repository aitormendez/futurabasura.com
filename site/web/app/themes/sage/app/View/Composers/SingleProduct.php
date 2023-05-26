<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class SingleProduct extends Composer
{
    protected static $views = [
        'woocommerce.content-single-product',
        'woocommerce.single-product.add-to-cart.simple',
        'woocommerce.single-product.add-to-cart.variable',
        'woocommerce.single-product.related',
    ];

    public function with()
    {
        return [
            'galeria' => $this->galeria(),
            'artista' => $this->artista(),
            'precio' => $this->precio(),
            'variaciones' => $this->variaciones(),
        ];
    }

    public function precio()
    {
        global $product;

        $output = [
            'product'       => $product,
            'product_id'    => $product->get_id(),
            'price' => $product->get_price(),
            'regular_price' => $product->get_regular_price(),
            'is_on_sale'    => false,
        ];

        if ( $product->is_on_sale() )  {
            $output['is_on_sale'] = true;
            $output['sale_price'] = $product->get_sale_price();
        }

        return $output;

    }

    public function artista()
    {
        global $post;
        global $product;
        $artist = get_the_terms($post->ID, 'artist');
        $rand_posts = get_posts([
            'post_type'    => 'product',
            'orderby'      => 'rand',
            'post__not_in' => [$product->get_id()],
            'tax_query'    => [
                [
                    'taxonomy' => 'artist',
                    'field'    => 'term_id',
                    'terms'     => $artist[0]->term_id
                ]
            ],
        ]);

        if (! empty($rand_posts)) {
            $rand_products_galleries = array_map( function( $post ) {
                $product = wc_get_product($post);
                $attachment_ids = $product->get_gallery_image_ids();


                $product_gallery = array_map( function( $att_id ) {

                    $meta = get_post_meta( $att_id );

                    $array =  [
                        'att_url'    => wp_get_attachment_url( $att_id ),
                        'att_srcset' => wp_get_attachment_image_srcset( $att_id ),
                        'has_alt'    => false,
                    ];

                    if (array_key_exists('_wp_attachment_image_alt', $meta)) {
                        $array['has_alt'] = true;
                        $array['alt'] = $meta['_wp_attachment_image_alt'];
                    }

                    return $array;

                }, $attachment_ids);

                return [
                    'product'         => $product,
                    'product_id'      => $product->get_id(),
                    'permalink'       => get_permalink( $product->get_id() ),
                    'title'           => $product->get_title(),
                    'product_gallery' => $product_gallery,
                ];

            }, $rand_posts);
        } else {
            $rand_products_galleries = false;
        }




        return [
            'artista'       => $artist[0],
            'link'          => get_term_link($artist[0]->term_id),
            'rand_products' => $rand_products_galleries,
        ] ;
    }

    public function galeria()
    {
        global $product;
        $attachment_ids = $product->get_gallery_image_ids();

        $output = array_map( function( $att_id ) {

            $meta = get_post_meta( $att_id );

            $array = [
                'att_url'    => wp_get_attachment_url( $att_id ),
                'att_srcset' => wp_get_attachment_image_srcset( $att_id ),
                'has_alt'    => false,
                'meta'       => $meta,
            ];

            if (array_key_exists('_wp_attachment_image_alt', $meta)) {
                $array['has_alt'] = true;
                $array['alt'] = $meta['_wp_attachment_image_alt'];
            }
            return $array;

        }, $attachment_ids);

        return $output;
    }

    public function variaciones()
    {
        global $product;
        $product_type = $product->get_type();

        if ($product_type == 'variable') {

            $product_variations_list = $product->get_available_variations();

            $output = [];

            foreach ($product_variations_list as $idx => $variation) {
                $variation_id = $variation["variation_id"];
                $variable_product = wc_get_product($variation_id);
                $variation_obj = wc_get_product( $variation_id );

                $output[$idx] = [
                    'product_type'  => $product_type,
                    'variation_id'  => $variation_id,
                    'variation_obj' => $variation_obj,
                    'size_slug'     => implode(', ', $variation["attributes"]),
                    'size'          => $variation_obj->get_attribute( 'format' ),
                    'price'         => $variable_product->get_price(),
                    'regular_price' => $variable_product->get_regular_price(),
                    'is_on_sale'    => $variation_obj->is_on_sale(),
                    'sale_price'    => $variable_product->get_sale_price(),
                ];
            }

            return $output;

        } else {

            $output = [];
            $output[0] = [
                'product_type' => $product_type,
                'size'         => $product->get_attribute('format'),
            ];

            return $output;
        }

    }



}
