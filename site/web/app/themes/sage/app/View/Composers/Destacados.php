<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Destacados extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'front-page',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */
    public function with()
    {
        return [
            'destacados' => $this->destacados(),
        ];
    }

    public function destacados()
    {

        $posts = get_posts([
            'posts_per_page'   => -1,
            'post_type'        => ['product', 'story', 'project'],
            'post_status'      => 'publish',
            'meta_key'		   => 'mostrar_en_portada',
            'meta_value'	   => '1'
        ]);

        $posts_array = array_map(function ($post) {
            $formato = get_field('contenido_formato', $post->ID);

            $post_type = get_post_type( $post->ID );

            if ($post_type === 'project') {
                $post_type = "Projects";
            } elseif ($post_type === 'story') {
                $post_type = "News";
            } elseif ($post_type === 'product') {
                $post_type = "Shop";
            };

            $out = [
                'post_type' => $post_type,
                'title'     => get_the_title($post->ID),
                'formato'   => $formato,
                'excerpt'   => get_the_excerpt( $post->ID ),
                'link'      => get_permalink( $post->ID  ),
                'fondo'     => get_field('color_de_fondo', $post->ID),
                'color_texto'     => get_field('color_de_texto', $post->ID),
            ];

            if ($out['post_type'] === 'Shop') {
                $artists = wp_get_post_terms($post->ID, 'artist');
                $out['artist'] = $artists[0]->name;
            }

            if ($formato === 'imagen' || $formato === 'repeticion') {

                $procedencia_img = get_field('procedencia_img', $post->ID);

                if ($procedencia_img === 'nueva') {
                    $img = get_field ('contenido_imagen_portada', $post->ID);
                    if ($img) {
                        $out['has_img'] = true;
                        $out['url'] = $img['url'];
                        $out['srcset'] = wp_get_attachment_image_srcset($img['ID']);
                        $out['alt'] = $img['alt'];
                    } else {
                        $out['has_img'] = false;
                    }
                } elseif ($procedencia_img === 'destacada') {
                    $thumb_id = get_post_thumbnail_id($post->ID );
                    if ($thumb_id) {
                        $thumb_url = wp_get_attachment_image_src($thumb_id, 'full');
                        $thumb_srcset = wp_get_attachment_image_srcset($thumb_id, 'full');
                        $thumb_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                        $out['has_img'] = true;
                        $out['url'] = $thumb_url[0];
                        $out['srcset'] = $thumb_srcset;
                        $out['alt'] = $thumb_alt;
                    } else {
                        $out['has_img'] = false;
                    }
                }


            } elseif($formato === 'imagen_grande') {

                $img = get_field ('contenido_imagen_grande_portada', $post->ID);
                if ($img) {
                    $out['has_img'] = true;
                    $out['url'] = $img['url'];
                    $out['srcset'] = wp_get_attachment_image_srcset($img['ID']);
                    $out['alt'] = $img['alt'];
                } else {
                    $out['has_img'] = false;
                }

            } elseif ($formato === 'mosaico') {

                $mosaico = get_field ('contenido_mosaico_portada', $post->ID);
                if ($mosaico) {
                    $out['has_msc'] = true;

                    $msc = array_map(function($img) {
                        $srcset = wp_get_attachment_image_srcset($img['ID']);
                        return [
                            'alt'    => $img['alt'],
                            'url'    => $img['url'],
                            'srcset' => $srcset,
                        ];
                    }, $mosaico);

                    $out['mosaico'] = $msc;
                } else {
                    $out['has_msc'] = false;
                }

            } elseif ($formato === 'galeria') {

                $galeria = get_field ('contenido_galeria_portada', $post->ID);
                if ($galeria) {
                    $out['has_gal'] = true;

                    $msc = array_map(function($img) {
                        $srcset = wp_get_attachment_image_srcset($img['ID']);
                        return [
                            'alt'    => $img['alt'],
                            'url'    => $img['url'],
                            'srcset' => $srcset,
                        ];
                    }, $galeria);

                    $out['galeria'] = $msc;
                } else {
                    $out['has_gal'] = false;
                }

            }

            return $out;
        }, $posts);

        $output = [
            'posts' => $posts_array,
        ];

        if (count($posts) !== 0) {
            $output['has_posts'] = true;
        } else {
            $output['has_posts'] = false;
        }

        return $output;
    }
}
