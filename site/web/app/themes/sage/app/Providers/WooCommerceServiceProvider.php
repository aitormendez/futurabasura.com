<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class WooCommerceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        add_action('woocommerce_before_shop_loop', function () {
            echo <<<HTML
                <div x-data="dropdownFilter()" x-init="init()">
                    <div class="md:min-w-80">
                        <div @click="open = !open" class="relative cursor-pointer bg-white uppercase tracking-[0.2em] px-3 py-2 text-sm text-center">
                            <span x-text="selectedName === '' ? 'Select an artist' : selectedName"></span>
                            <div x-show="open" @click.away="open = false" class="absolute left-0 bg-white z-10 w-full top-9">
                                <ul class="max-h-60 overflow-auto">
                                    <li @click="applyFilter('')" class="p-2 hover:bg-allo cursor-pointer">All artists</li>
                                    <template x-for="artist in artists" :key="artist.slug">
                                        <li @click="applyFilter(artist.slug, artist.name)" x-text="artist.name" class="p-2 hover:bg-allo cursor-pointer leading-tight"></li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <template x-if="bioLink">
                    <div class="clip-path-elipse absolute left-1/2 transform -translate-x-1/2 px-6 pt-[0.1em] m-4 uppercase bg-black  hover:bg-allo text-center tracking-[0.2em] text-sm">
                        <a :href="bioLink" x-text="bioLabel" class="block p-2  text-white  hover:text-black"></a>
                    </div>
                    </template>
                </div>

            HTML;

            // EL SCRIPT ESTÁ EN SHOP.JS (dropdownFilter).

            //Si tu función JavaScript está inline, inclúyela aquí. De lo contrario, asegúrate de que está en un archivo JS que se encola correctamente.
            // echo <<<SCRIPT
            // <script>
            // function dropdownFilter() {
            //     // Tu función dropdownFilter aquí...
            // }
            // </script>
            // SCRIPT;
        }, 25);

        add_action('woocommerce_before_shop_loop', function() {
            ?>
            <div x-data="dropdownSort()" x-init="init()" class="relative md:min-w-80 text-center">
                <!-- Aplicar @click.away en este nivel asegura que cualquier clic fuera del desplegable cerrará las opciones -->
                <div @click.away="open = false" @click="open = !open" class="cursor-pointer bg-white uppercase tracking-[0.2em] px-3 py-2 text-sm w-full">
                    <span x-text="selected"></span>
                    <div x-show="open" class="absolute left-0 bg-white z-10 w-full">
                        <ul>
                            <template x-for="option in options" :key="option.value">
                                <li @click="applySort(option.value)" class="p-2 hover:bg-allo cursor-pointer leading-tight uppercase tracking-[0.2em] text-sm" x-text="option.text"></li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>
            <?php

            // EL SCRIPT ESTÁ EN SHOP.JS (dropdownSort).
        }, 26);

        /**
         * Rodear filtros de la tienda con un div.filtros -- inicio.
         */
        add_action( 'woocommerce_before_shop_loop', function() {
            echo '<div class="relative flex flex-wrap justify-center p-6 filtros md:pt-12 md:pb-20">';
        }, 20 );

        /**
         * Rodear filtros de la tienda con un div.filtros -- fin
         */
        add_action( 'woocommerce_before_shop_loop', function() {
            echo '</div><div id="desplegable" class="relative"></div>';
        }, 30 );

        /**
         * Eliminar estilos WC.
         */
        add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


        /**
         * Eliminar "Showing número de products" de la portada de la tienda.
         */
        remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );



        /**
         * Eliminar funcionalidad (zoom, gallery, lightbox) de single product.
         */
        add_action( 'after_setup_theme', function () {
            remove_theme_support( 'wc-product-gallery-slider' );
            remove_theme_support( 'wc-product-gallery-zoom' );
            remove_theme_support( 'wc-product-gallery-lightbox' );
        }, 20 );

        /**
         * Eliminar reviews de single product y additional information tab.
         */
        add_filter( 'woocommerce_product_tabs', function ($tabs) {
            unset($tabs['reviews']);
            unset( $tabs['additional_information'] );
            return $tabs;
        }, 98 );


        /**
         * Añadir clase simple/variable/etc en body de single-product.
         */

         add_action('template_redirect', function() {
            if (!is_admin() && is_product()) {
                add_filter('body_class', function($classes) {
                    global $post;
                    $product = wc_get_product($post->ID);
                    $tipo = $product->get_type();
    
                    return array_merge($classes, [$tipo]);
                });
            }
        });

        /**
         * Mostrar totales de envío.
         */
        add_filter( 'woocommerce_after_shipping_calculator', function()  {
            echo '<div class="text-xs">' . get_field('exp_car_totals', 'option') . '</div>';
        });

        /**
         * Mostrar etiqueta nuevo producto.
         */

        add_action( 'woocommerce_before_shop_loop_item_title', [$this, 'mostrar_etiqueta_nuevo_producto'], 15 );
        
        

        /**
         * acciones condicionales para móvil y para escritorio
         */

        // añadir tinyEMC a la descripción de la taxonomía artist.
        add_action('artist_edit_form_fields', [$this, 'custom_taxonomy_description_field'], 10, 2);

        // Ocultar campo descripción de la taxonomía artist sin editor TinyMCE por defecto.
        add_action('admin_head', [$this, 'hide_standard_description_field']);

        add_action('woocommerce_after_shop_loop', [$this, 'custom_woocommerce_next_page_link'], 10);

        add_action('pre_get_posts', [$this, 'apply_artist_filter_to_products_query']);

         // Remove the default WooCommerce product link open function
        remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);

        // Add your customized product link open function
        add_action('woocommerce_before_shop_loop_item', [$this, 'custom_woocommerce_template_loop_product_link_open'], 10);

        if ( wp_is_mobile() ) {
            add_action('woocommerce_before_shop_loop_item_title', [$this, 'woocommerce_template_loop_product_thumbnail_mobile'], 10);
            add_action('woocommerce_before_shop_loop_item_title', [$this, 'renderizar_metadatos_mobile_shop_loop'], 15);
        } else {
            add_action('woocommerce_before_shop_loop_item_title', [$this, 'renderizar_card_front'], 10);
            add_action('woocommerce_before_shop_loop_item_title', [$this, 'renderizar_card_back'], 15);
        }
    }

    /**
     * Mostrar etiqueta "new in shop" en los productos de la portada de la tienda.
     */

     public function mostrar_etiqueta_nuevo_producto() {
        global $product;
        // Verifica si el producto tiene la etiqueta "new in shop"
        if ( has_term( 'new-in-shop', 'product_tag', $product->get_id() ) ) {
            if (wp_is_mobile()) {
                echo '<span class="absolute top-0 left-4 uppercase tracking-wider bg-allo px-2 pt-[0.2em]">New</span>';
            } else {
                echo '<span class="absolute top-0 left-0 uppercase tracking-wider bg-allo px-2 pt-[0.2em]">New</span>';
            }
        }
    }

    /**
     * Mostrar artista en los productos de la portada de la tienda.
     */

    private function mostrar_artista_producto() {
        global $product;
        $artist_ids = wp_get_post_terms( $product->get_id(), 'artist', ['fields' => 'names'] );
        // Comprueba si hay artistas asignados y los imprime
        if ( !empty($artist_ids) ) {
            if (wp_is_mobile()) {
                echo '<div class="font-bugrino text-lg my-3">' . join(', ', $artist_ids) . '</div>';

            } else {
                echo '<div class="font-bugrino text-[1.5vw] mt-3">' . join(', ', $artist_ids) . '</div>';
            }
        }
    }

    /**
     * Mostrar las categorías de producto, excluyendo "Uncategorized".
     */
    private function mostrar_tipo_producto() {
        global $product;

        // Obtener las categorías del producto
        $product_categories = wp_get_post_terms($product->get_id(), 'product_cat');

        // Filtrar y eliminar la categoría "Uncategorized"
        $filtered_categories = array_filter($product_categories, function($category) {
            return strtolower($category->name) !== 'uncategorized';
        });

        // Comprobar si quedan categorías después de filtrar "Uncategorized"
        if (!empty($filtered_categories)) {
            $categories_output = '';

            foreach ($filtered_categories as $category) {
                $categories_output .= esc_html($category->name) . ', ';
            }

            // Quitar la última coma y espacio
            $categories_output = rtrim($categories_output, ', ');

            // Determinar el estilo basado en si el usuario está en un dispositivo móvil
            if (wp_is_mobile()) {
                echo '<div class="uppercase text-sm text-gray-400 text-center mb-2 w-full">' . $categories_output . '</div>';
            } else {
                echo '<div class="uppercase text-[1.1vw] text-center border-b border-black w-full">' . $categories_output . '</div>';
            }
        }
    }

    /**
    * mostrar información de producto en el loop de portada.
    */
   
    private function mostrar_informacion_producto() {
        global $product;

        // Comprueba si el producto es variable
        if ( $product->is_type( 'variable' ) ) {
            $variations = $product->get_available_variations();
            foreach ( $variations as $variation ) {
                $variation_obj = new \WC_Product_Variation($variation['variation_id']);

                // Inicializa una cadena para los atributos
                $attributes_str = '';

                // Obtén todos los atributos de la variación
                $attributes = $variation_obj->get_variation_attributes();

                // Itera sobre cada atributo
                foreach ( $attributes as $attribute_name => $attribute_value ) {
                    // Salta el atributo 'product type'
                    if ($attribute_name == 'attribute_pa_product-type') {
                        continue;
                    }

                    // Obtiene el término del atributo para mostrar el nombre legible por humanos
                    // El valor original se debe buscar en los términos del atributo si es que existen
                    $term = get_term_by('slug', $attribute_value, str_replace('attribute_', '', $attribute_name));
                    $attribute_value_formatted = $term ? esc_html($term->name) : esc_html($attribute_value); // Usa el nombre del término si está disponible, de lo contrario usa el valor del atributo

                    // Añade "cm" si el atributo es 'pa_format'
                    if ($attribute_name == 'attribute_pa_format') {
                        $attribute_value_formatted .= ' cm';
                    }

                    // Concatena este atributo con los anteriores
                    if (!empty($attributes_str)) {
                        $attributes_str .= ', '; // Añade coma entre atributos
                    }
                    $attributes_str .= $attribute_value_formatted;
                }

                // HTML para mostrar los atributos
                if (wp_is_mobile()) {
                    echo '<li class="flex w-full justify-between border-t border-black px-2 last:border-b text-sm tracking-wider">';
                } else {
                    echo '<li class="flex w-full justify-between border-t border-black px-2 last:border-b text-[1vw] tracking-wider">';
                }

                echo '<span class="grow">' . $attributes_str . '</span>';
                
                // Precios
                $price = $variation_obj->get_regular_price();
                $sale_price = $variation_obj->get_sale_price();
                if ( !empty($sale_price) && $sale_price < $price ) {
                    echo '<span class="mr-2"><del>' . wc_price( $price ) . '</del></span>';
                    echo '<span class="text-red-600">' . wc_price( $sale_price ) . '</span>';
                } else {
                    echo '<span></span>'; // Espacio para mantener la estructura cuando no hay precio de oferta
                    echo '<span>' . wc_price( $price ) . '</span>';
                }
                echo '</li>';
            }

        } else {
            // Para productos simples y otros tipos
            // Inicializa una cadena para los atributos
            $attributes_str = '';

            // Obtén todos los atributos del producto
            $attributes = $product->get_attributes();

            // Itera sobre cada atributo
            foreach ( $attributes as $attribute_name => $attribute ) {
                // Salta los atributos que no son visibles o son personalizados
                if ( !$attribute->get_visible() || $attribute->get_variation() ) {
                    continue;
                }

                // Obtiene los términos del atributo
                $attribute_values = $product->get_attribute($attribute_name);

                // Separa múltiples valores con comas
                $attribute_values_formatted = implode(', ', array_map('esc_html', explode(', ', $attribute_values)));

                // Añade " cm" si el atributo es 'format' o 'pa_format'
                if ($attribute_name == 'format' || $attribute_name == 'pa_format') {
                    $attribute_values_formatted .= ' cm';
                }

                // Concatena este atributo con los anteriores, solo si $attributes_str no está vacío
                if ( !empty($attributes_str) ) {
                    $attributes_str .= ', '; // Añade coma entre atributos solo si ya hay contenido en la cadena
                }
                $attributes_str .= $attribute_values_formatted;
            }

            // HTML para mostrar los atributos
            if (wp_is_mobile()) {
                echo '<li class="flex w-full justify-between border-y border-black px-2 text-sm tracking-wider">';
            } else {
                echo '<li class="flex w-full justify-between border-y border-black px-2 text-[1vw] tracking-wider">';
            }

            echo '<span class="grow">' . $attributes_str . '</span>';

            // Precios
            $price = $product->get_regular_price();
            $sale_price = $product->get_sale_price();
            if ( !empty($sale_price) && $sale_price < $price ) {
                echo '<span class="mr-4"><del>' . wc_price( $price ) . '</del></span>';
                echo '<span>' . wc_price( $sale_price ) . '</span>';
            } else {
                echo '<span></span>'; // Espacio para mantener la estructura cuando no hay precio de oferta
                echo '<span>' . wc_price( $price ) . '</span>';
            }
            echo '</li>';
        }

    }

    /**
     * mostrar nombre de producto.
     */
    private function woocommerce_template_loop_product_title() {
        if (wp_is_mobile()) {
            echo '<h2 class="text-sm leading-tight uppercase text-center px-2 mb-20 items-center tracking-wider ' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        } else {
            echo '<h2 class="text-[1.2vw] leading-tight uppercase text-center px-2 grow flex items-center tracking-wider ' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
    }

    /**
     * Renderizar thumbnail dentro de un div card-front.
     */
    public function renderizar_card_front() {
        echo '<div class="card-front">';
        echo woocommerce_get_product_thumbnail('large');
        echo '</div>';
    }

    /**
     * Renderizar la imagen de producto con diferente marcado si es horizontal o vertical.
     */

     public function woocommerce_template_loop_product_thumbnail_mobile() {
        $thumbnail_id = get_post_thumbnail_id();
        $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full');
        
        if ($thumbnail_url) {
            $width = $thumbnail_url[1];
            $height = $thumbnail_url[2];
    
            if ($width > $height) {
                echo '<div class="horizontal">' . woocommerce_get_product_thumbnail('large') . '</div>';
            } else {
                echo '<div class="px-4">' . woocommerce_get_product_thumbnail('large') . '</div>';
            }
        } else {
            // No hay imagen, podría renderizar un placeholder o dejar el espacio en blanco
            echo '<div class="no-image">No Image Available</div>';
        }
    }

    public function renderizar_metadatos_mobile_shop_loop() {
        echo '<div class="bg-white flex flex-col items-center mx-4">';
        echo $this->mostrar_artista_producto();
        $this->woocommerce_template_loop_product_title();
        echo $this->mostrar_tipo_producto();
        echo '<ul class="w-full mb-4">';
        echo $this->mostrar_informacion_producto();
        echo '</ul>';
        echo '</div>';
    }
    
    public function renderizar_card_back() {
        echo '<div class="card-back bg-white pt-1 flex flex-col justify-between items-center">';
        echo $this->mostrar_tipo_producto();
        echo $this->mostrar_artista_producto();
        $this->woocommerce_template_loop_product_title();
        echo '<ul class="w-full mb-4">';
        echo $this->mostrar_informacion_producto();
        echo '</ul>';
        echo '</div>';
    }


    /**
     * Insert the opening anchor tag for products in the loop.
     */
    public function custom_woocommerce_template_loop_product_link_open() {
        global $product;

        $link = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product);

        // Verificar si la cookie existe y es igual a 'true'
        $is_mobile = isset($_COOKIE['is_mobile']) && $_COOKIE['is_mobile'] == 'true';

        if ($is_mobile) {
            echo '<a href="' . esc_url($link) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link !text-black">';
        } else {
            echo '<a href="' . esc_url($link) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link card-inner !text-black">';
        }
    }

    /**
     * Aplicar el filtro de artista al query de producto.
     */   

    public function apply_artist_filter_to_products_query($query) {
        // Solo modifica la consulta en la tienda o páginas de archivo de productos y si hay un filtro aplicado
        if (!is_admin() && $query->is_main_query() && ($query->is_post_type_archive('product') || $query->is_product_category()) && isset($_GET['artist_filter']) && !empty($_GET['artist_filter'])) {
            $query->set('tax_query', array(
                array(
                    'taxonomy' => 'artist',
                    'field'    => 'slug',
                    'terms'    => array(sanitize_text_field($_GET['artist_filter'])),
                ),
            ));
        }
    }
    /**
     * Generar el enlace de próxima página en portada de producto para infinite-scroll.
     */  
    public function custom_woocommerce_next_page_link() {
        if (!is_shop() && !is_product_category() && !is_product_taxonomy()) return; // Asegúrate de que esto solo se ejecute en las páginas de la tienda
        
        global $wp_query;
        if ($wp_query->max_num_pages <= 1) return; // No hay necesidad de paginación si solo hay una página
    
        $next_page_link = get_next_posts_page_link($wp_query->max_num_pages);
        if ($next_page_link) {
            echo '<nav class="woocommerce-pagination">';
            echo '<a class="next" href="' . esc_url($next_page_link) . '">' . esc_html__('Next Page', 'woocommerce') . '</a>';
            echo '</nav>';
        }
    }

    /**
     * para añadir el editor TinyMCE al campo de descripción de la taxonomía.
     */  
    public function custom_taxonomy_description_field() {
        ?>
        <tr class="form-field term-description-wrap">
            <th scope="row"><label for="description"><?php _e('Description'); ?></label></th>
            <td><?php
                // Utiliza wp_editor() para añadir el editor TinyMCE al campo de descripción
                $settings = array(
                    'textarea_name' => 'description',
                    'quicktags' => array('buttons' => 'em,strong,link'),
                    'tinymce' => true
                );
                wp_editor(html_entity_decode(get_term_field('description', (int) $_GET['tag_ID'], $_GET['taxonomy'], 'raw')), 'tag_description', $settings);
                ?><br>
                <span class="description"><?php _e('The description is not prominent by default; however, some themes may show it.'); ?></span>
            </td>
        </tr>
        <?php
    }

    /**
     * esconder campo por defecto para añadir el editor TinyMCE al campo de 
     * descripción de la taxonomía. (complementa la función anterior)
     */ 
    function hide_standard_description_field() {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('textarea#description').closest('.form-field').remove(); // Oculta el campo de descripción estándar
            });
        </script>
        <?php
    }
}
