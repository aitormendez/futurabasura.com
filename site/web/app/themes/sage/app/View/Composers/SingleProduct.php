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
            'alt_name' => $this->alt_name(),
            // 'variaciones' => $this->variaciones(),
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

        if ($product->is_on_sale()) {
            $output['is_on_sale'] = true;
            $output['sale_price'] = $product->get_sale_price();
        }

        return $output;
    }

    public function alt_name()
    {
        global $product;
        return get_field('single_product_alt_name', $product->get_id());
    }

    public function artista()
    {
        global $post;
        global $product;
        $rand_posts = [];
        $artist = get_the_terms($post->ID, 'artist');
        if ($artist) {
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
        }

        if (! empty($rand_posts)) {
            $rand_products_galleries = array_map(function ($post) {
                $product = wc_get_product($post);
                $attachment_ids = $product->get_gallery_image_ids();


                $product_gallery = array_map(function ($att_id) {

                    $meta = get_post_meta($att_id);

                    $array =  [
                        'att_url'    => wp_get_attachment_url($att_id),
                        'att_srcset' => wp_get_attachment_image_srcset($att_id),
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
                    'permalink'       => get_permalink($product->get_id()),
                    'title'           => $product->get_title(),
                    'product_gallery' => $product_gallery,
                ];
            }, $rand_posts);
        } else {
            $rand_products_galleries = false;
        }

        $output = [
            'rand_products' => $rand_products_galleries,
        ];

        if ($artist) {
            $output['artista'] = $artist[0];
            $output['link'] = get_term_link($artist[0]->term_id);
        }

        return $output;
    }

    public function galeria()
    {
        global $product;
        $attachment_ids = $product->get_gallery_image_ids();

        $output = array_map(function ($att_id) {

            $meta = get_post_meta($att_id);

            $array = [
                'att_url'    => wp_get_attachment_url($att_id),
                'att_srcset' => wp_get_attachment_image_srcset($att_id),
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
                $variation_obj = wc_get_product($variation_id);

                // Obtén los atributos de esta variación específica
                $variation_attributes = $variation_obj->get_variation_attributes();
                // Concatena los atributos y sus valores para mostrar
                $attributes_string = [];
                foreach ($variation_attributes as $attr_key => $attr_value) {
                    $attribute_taxonomy = str_replace('attribute_', '', $attr_key);
                    $attribute_label = wc_attribute_label($attribute_taxonomy);

                    // Comprueba si el atributo actual es el "product type" para omitirlo
                    if ($attribute_taxonomy !== 'pa_product-type' && $attribute_taxonomy !== 'product_type') { // Ajusta la clave de atributo según tu necesidad
                        if ($attr_value) { // Asegúrate de que el valor del atributo no esté vacío
                            $attribute_value = get_term_by('slug', $attr_value, $attribute_taxonomy)->name;
                            $attributes_string[] = $attribute_value;
                        }
                    }
                }
                $attributes_string = implode(', ', $attributes_string);


                $output[$idx] = [
                    'product_type'    => $product_type,
                    'variation_id'    => $variation_id,
                    'variation_obj'   => $variation_obj,
                    'attributes'      => $attributes_string, // Usar esta cadena en lugar de 'size'
                    'price'           => $variation_obj->get_price(),
                    'regular_price'   => $variation_obj->get_regular_price(),
                    'is_on_sale'      => $variation_obj->is_on_sale(),
                    'sale_price'      => $variation_obj->get_sale_price(),
                ];
            }

            return $output;
        } else {
            $attributes = $product->get_attributes();

            // Recoger y concatenar todos los atributos excluyendo 'product_type'
            $attributes_string = [];
            foreach ($attributes as $attribute_name => $attribute) {
                if ($attribute_name != 'product_type') {
                    $attributes_string[] = implode(', ', wc_get_product_terms($product->get_id(), $attribute_name, array('fields' => 'names')));
                }
            }
            $attributes_string = implode(', ', $attributes_string);

            if ($product_type == 'simple') {
                $output = [];
                $output[0] = [
                    'product_type' => $product_type,
                    'attributes'   => $attributes_string,
                ];

                return $output;
            }
        }
    }
}
