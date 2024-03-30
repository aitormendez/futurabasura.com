<?php
// todo se ha pasad al service provider de Woocommerce

// /**
//  * Shortcode con desplegable de artistas.
//  *
//  * @link https://stackoverflow.com/questions/56120607/make-a-dropdown-for-a-woocommerce-taxonomy-like-product-tags
//  */

// add_shortcode( 'product_tax_artist_dropdown', function( $atts ) {
//     // Attributes
//     $atts = shortcode_atts(
//         [
//         'hide_empty'   => '1', // or '0'
//         'show_count'   => '1', // or '0'
//         'orderby'      => 'name', // or 'order'
//         'taxonomy'     => 'artist',
//         ],
//         $atts,
//         'product_tax_artist_dropdown'
//     );

//     global $wp_query;

//     $taxonomy      = $atts['taxonomy'];
//     $taxonomy_name = get_taxonomy( $taxonomy )->labels->singular_name;

//     ob_start();

//     wp_dropdown_categories( [
//         'hide_empty' => $atts['hide_empty'],
//         'show_count' => $atts['show_count'],
//         'orderby'    => $atts['orderby'],
//         'selected'           => isset( $wp_query->query_vars[$taxonomy] ) ? $wp_query->query_vars[$taxonomy] : '',
//         'show_option_none'   => sprintf( __( 'Select an %s', 'sage' ), $taxonomy_name ),
//         'option_none_value'  => '',
//         'value_field'        => 'slug',
//         'taxonomy'   => $taxonomy,
//         'name'       => $taxonomy,
//         'class'      => 'dropdown_'.$taxonomy,
//     ] );
//     return ob_get_clean();
// } );

// /**
//  * Rodear filtros de la tienda con un div.filtros -- inicio.
//  */
// add_action( 'woocommerce_before_shop_loop', function() {
//     echo '<div class="relative flex flex-wrap justify-center p-6 filtros md:pt-12 md:pb-20">';
// }, 20 );

// /**
//  * Rodear filtros de la tienda con un div.filtros -- fin
//  */
// add_action( 'woocommerce_before_shop_loop', function() {
//     echo '</div><div id="desplegable" class="relative"></div>';
// }, 30 );


// /**
//  * Eliminar estilos WC.
//  */
// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// /**
//  * Eliminar "Showing número de products".
//  */
// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

// /**
//  * Eliminar galería de producto.
//  */
// remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

// /**
//  * Eliminar breadcrumb y wraper divs.
//  */
// remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10, 0 );
// remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10, 0 );
// remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// /**
//  * Eliminar datos de single product summary.
//  */
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5, 0 );
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10, 0 );
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10, 0 );
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20, 0 );
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40, 0 );



// /**
//  * Eliminar funcionalidad (zoom, gallery, lightbox) de single product.
//  */
// add_action( 'after_setup_theme', function () {
//     remove_theme_support( 'wc-product-gallery-slider' );
//     remove_theme_support( 'wc-product-gallery-zoom' );
//     remove_theme_support( 'wc-product-gallery-lightbox' );
// }, 20 );



// /**
//  * Eliminar reviews de single product y additional information tab.
//  */
// add_filter( 'woocommerce_product_tabs', function ($tabs) {
//     unset($tabs['reviews']);
//     unset( $tabs['additional_information'] );
//     return $tabs;
// }, 98 );

// /**
//  * Añadir clase simple/variable/etc en body de single-product.
//  */

// add_action( 'template_redirect', 'template_redirect_action' );
// function template_redirect_action() {
//     if ( ! is_admin() && is_product() ) {
//         add_filter( 'body_class', function ( $classes ) {
//             global $post;
//             $product = wc_get_product( $post->ID );
//             $tipo    = $product->get_type();

//             return array_merge( $classes, array( $tipo ) );
//         } );
//     }
// }


// /**
//  * Eliminar ordenar por popularidad.
//  * https://www.pixelninja.me/remove-woocommerce-product-sorting-options/
//  */

// // Customizes the WooCommerce product sorting options
// // Available options are: menu_order, rating, date, popularity, price, price-desc

//   add_filter( "woocommerce_catalog_orderby", function( $orderby ) {
//     unset($orderby["popularity"]);
//     return $orderby;
// }, 20 );


// /**
//  * Mostrar totales de envío.
//  */
// add_filter( 'woocommerce_after_shipping_calculator', function()  {
//     echo '<div class="text-xs">' . get_field('exp_car_totals', 'option') . '</div>';
// });


// // LOOP TIENDA
// // _________________________________________________________________________________________________

// /**
//  * Mostrar etiqueta "new in shop" en los productos de la portada de la tienda.
//  */

// function mostrar_etiqueta_nuevo_producto() {
//     global $product;
//     // Verifica si el producto tiene la etiqueta "new in shop"
//     if ( has_term( 'new-in-shop', 'product_tag', $product->get_id() ) ) {
//         if (wp_is_mobile()) {
//             echo '<span class="absolute top-0 left-4 uppercase tracking-wider bg-yellow-300 px-2 pt-[0.2em]">New</span>';
//         } else {
//             echo '<span class="absolute top-0 left-0 uppercase tracking-wider bg-yellow-300 px-2 pt-[0.2em]">New</span>';
//         }
//     }
// }

// /**
//  * Mostrar artista en los productos de la portada de la tienda.
//  */

// function mostrar_artista_producto() {
//     global $product;
//     $artist_ids = wp_get_post_terms( $product->get_id(), 'artist', ['fields' => 'names'] );
//     // Comprueba si hay artistas asignados y los imprime
//     if ( !empty($artist_ids) ) {
//         if (wp_is_mobile()) {
//             echo '<div class="font-bugrino text-lg my-3">' . join(', ', $artist_ids) . '</div>';

//         } else {
//             echo '<div class="font-bugrino text-[1.5vw] mt-3">' . join(', ', $artist_ids) . '</div>';
//         }
//     }
// }



// /**
//  * Insert the opening anchor tag for products in the loop.
//  */
// function woocommerce_template_loop_product_link_open() {
//     global $product;

//     $link = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product);

//     // Verificar si la cookie existe y es igual a 'true'
//     $is_mobile = isset($_COOKIE['is_mobile']) && $_COOKIE['is_mobile'] == 'true';

//     if ($is_mobile) {
//         echo '<a href="' . esc_url($link) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link !text-black">';
//     } else {
//         echo '<a href="' . esc_url($link) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link card-inner !text-black">';
//     }
// }

// /**
//  * mostrar tipo de impresión (ahora es tipo de producto).
//  */
// function mostrar_tipo_producto() {
//     global $product;

//     // Almacenar el tipo de producto
//     $product_type = $product->get_attribute('pa_product-type');

//     // Comprobar si el atributo de tipo de producto existe y mostrarlo
//     if ($product_type) {
//         // Determinar el estilo basado en si el usuario está en un dispositivo móvil
//         if (wp_is_mobile()) {
//             echo '<div class="uppercase text-sm text-gray-400 text-center mb-2 w-full">' . esc_html($product_type) . '</div>';
//         } else {
//             echo '<div class="uppercase text-[1.1vw] text-center border-b border-black w-full">' . esc_html($product_type) . '</div>';
//         }
//     }
// }



// /**
//  * mostrar información de producto en el loop de portada.
//  */

//  function mostrar_informacion_producto() {
//     global $product;

//     // Comprueba si el producto es variable
//     if ( $product->is_type( 'variable' ) ) {
//         $variations = $product->get_available_variations();
//         foreach ( $variations as $variation ) {
//             $variation_obj = new WC_Product_Variation($variation['variation_id']);

//             // Inicializa una cadena para los atributos
//             $attributes_str = '';

//             // Obtén todos los atributos de la variación
//             $attributes = $variation_obj->get_variation_attributes();

//             // Itera sobre cada atributo
//             foreach ( $attributes as $attribute_name => $attribute_value ) {
//                 // Salta el atributo 'product type'
//                 if ($attribute_name == 'attribute_pa_product-type') {
//                     continue;
//                 }

//                 // Obtiene el término del atributo para mostrar el nombre legible por humanos
//                 // El valor original se debe buscar en los términos del atributo si es que existen
//                 $term = get_term_by('slug', $attribute_value, str_replace('attribute_', '', $attribute_name));
//                 $attribute_value_formatted = $term ? esc_html($term->name) : esc_html($attribute_value); // Usa el nombre del término si está disponible, de lo contrario usa el valor del atributo

//                 // Añade "cm" si el atributo es 'pa_format'
//                 if ($attribute_name == 'attribute_pa_format') {
//                     $attribute_value_formatted .= ' cm';
//                 }

//                 // Concatena este atributo con los anteriores
//                 if (!empty($attributes_str)) {
//                     $attributes_str .= ', '; // Añade coma entre atributos
//                 }
//                 $attributes_str .= $attribute_value_formatted;
//             }

//             // HTML para mostrar los atributos
//             if (wp_is_mobile()) {
//                 echo '<li class="flex w-full justify-between border-t border-black px-2 last:border-b text-sm tracking-wider">';
//             } else {
//                 echo '<li class="flex w-full justify-between border-t border-black px-2 last:border-b text-[1vw] tracking-wider">';
//             }

//             echo '<span class="grow">' . $attributes_str . '</span>';
            
//             // Precios
//             $price = $variation_obj->get_regular_price();
//             $sale_price = $variation_obj->get_sale_price();
//             if ( !empty($sale_price) && $sale_price < $price ) {
//                 echo '<span class="mr-2"><del>' . wc_price( $price ) . '</del></span>';
//                 echo '<span class="text-red-600">' . wc_price( $sale_price ) . '</span>';
//             } else {
//                 echo '<span></span>'; // Espacio para mantener la estructura cuando no hay precio de oferta
//                 echo '<span>' . wc_price( $price ) . '</span>';
//             }
//             echo '</li>';
//         }

//     } else {
//         // Para productos simples y otros tipos
//         // Inicializa una cadena para los atributos
//         $attributes_str = '';

//         // Obtén todos los atributos del producto
//         $attributes = $product->get_attributes();

//         // Itera sobre cada atributo
//         foreach ( $attributes as $attribute_name => $attribute ) {
//             // Salta los atributos que no son visibles o son personalizados
//             if ( !$attribute->get_visible() || $attribute->get_variation() ) {
//                 continue;
//             }

//             // Obtiene los términos del atributo
//             $attribute_values = $product->get_attribute($attribute_name);

//             // Separa múltiples valores con comas
//             $attribute_values_formatted = implode(', ', array_map('esc_html', explode(', ', $attribute_values)));

//             // Añade " cm" si el atributo es 'format' o 'pa_format'
//             if ($attribute_name == 'format' || $attribute_name == 'pa_format') {
//                 $attribute_values_formatted .= ' cm';
//             }

//             // Concatena este atributo con los anteriores, solo si $attributes_str no está vacío
//             if ( !empty($attributes_str) ) {
//                 $attributes_str .= ', '; // Añade coma entre atributos solo si ya hay contenido en la cadena
//             }
//             $attributes_str .= $attribute_values_formatted;
//         }

//         // HTML para mostrar los atributos
//         if (wp_is_mobile()) {
//             echo '<li class="flex w-full justify-between border-y border-black px-2 text-sm tracking-wider">';
//         } else {
//             echo '<li class="flex w-full justify-between border-y border-black px-2 text-[1vw] tracking-wider">';
//         }

//         echo '<span class="grow">' . $attributes_str . '</span>';

//         // Precios
//         $price = $product->get_regular_price();
//         $sale_price = $product->get_sale_price();
//         if ( !empty($sale_price) && $sale_price < $price ) {
//             echo '<span class="mr-4"><del>' . wc_price( $price ) . '</del></span>';
//             echo '<span>' . wc_price( $sale_price ) . '</span>';
//         } else {
//             echo '<span></span>'; // Espacio para mantener la estructura cuando no hay precio de oferta
//             echo '<span>' . wc_price( $price ) . '</span>';
//         }
//         echo '</li>';
//     }

// }


// /**
//  * mostrar nombre de producto.
//  */
// function woocommerce_template_loop_product_title() {
//     if (wp_is_mobile()) {
//         echo '<h2 class="text-sm leading-tight uppercase text-center px-2 mb-20 items-center tracking-wider ' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
//     } else {
//         echo '<h2 class="text-[1.2vw] leading-tight uppercase text-center px-2 grow flex items-center tracking-wider ' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
//     }
// }


// /**
//  * Renderizar thumbnail dentro de un div card-front.
//  */
// function renderizar_card_front() {
//     echo '<div class="card-front">';
//     echo woocommerce_get_product_thumbnail('large');
//     echo '</div>';
// }



// /**
//  * Renderizar metadatos dentro de un div card-back.
//  */
// function renderizar_card_back() {
//     echo '<div class="card-back bg-white pt-1 flex flex-col justify-between items-center">';
//     echo mostrar_tipo_producto();
//     echo mostrar_artista_producto();
//     woocommerce_template_loop_product_title();
//     echo '<ul class="w-full mb-4">';
//     echo mostrar_informacion_producto();
//     echo '</ul>';
//     echo '</div>';
// }

// /**
//  * Renderizar la imagen de producto con diferente marcado si es horizontal o vertical.
//  */
// function woocommerce_template_loop_product_thumbnail_mobile() {
//     $thumbnail_id = get_post_thumbnail_id();
//     $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'full');
    
//     if ($thumbnail_url) {
//         $width = $thumbnail_url[1];
//         $height = $thumbnail_url[2];

//         if ($width > $height) {
//             echo '<div class="horizontal">' . woocommerce_get_product_thumbnail('large') . '</div>';
//         } else {
//             echo '<div class="px-4">' . woocommerce_get_product_thumbnail('large') . '</div>';
//         }
//     } else {
//         // No hay imagen, podría renderizar un placeholder o dejar el espacio en blanco
//         echo '<div class="no-image">No Image Available</div>';
//     }
// }

// function renderizar_metadatos_mobile_shop_loop() {
//     echo '<div class="bg-white flex flex-col items-center mx-4">';
//     echo mostrar_artista_producto();
//     woocommerce_template_loop_product_title();
//     echo mostrar_tipo_producto();
//     echo '<ul class="w-full mb-4">';
//     echo mostrar_informacion_producto();
//     echo '</ul>';
//     echo '</div>';
// }

// function filter_products_by_artist_dropdown() {
//     if (!is_shop() && !is_product_category()) return; // Asegúrate de que esto solo se muestre en la portada de la tienda o en las páginas de categoría de productos

//     $terms = get_terms('artist', array('hide_empty' => true));
//     if (count($terms) <= 0) return;

//     echo '<form id="artist-filter-form" action="'. get_permalink(woocommerce_get_page_id('shop')) .'" method="GET">';
//     echo '<select name="artist_filter" onchange="document.getElementById(\'artist-filter-form\').submit();">';
//     echo '<option value="">Select an artist</option>';
//     foreach ($terms as $term) {
//         echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
//     }
//     echo '</select>';
//     echo '</form>';
// }
// add_action('woocommerce_before_shop_loop', 'filter_products_by_artist_dropdown', 31);

// function apply_artist_filter_to_products_query($query) {
//     // Solo modifica la consulta en la tienda o páginas de archivo de productos y si hay un filtro aplicado
//     if (!is_admin() && $query->is_main_query() && ($query->is_post_type_archive('product') || $query->is_product_category()) && isset($_GET['artist_filter']) && !empty($_GET['artist_filter'])) {
//         $query->set('tax_query', array(
//             array(
//                 'taxonomy' => 'artist',
//                 'field'    => 'slug',
//                 'terms'    => array(sanitize_text_field($_GET['artist_filter'])),
//             ),
//         ));
//     }
// }
// add_action('pre_get_posts', 'apply_artist_filter_to_products_query');




// /**
//  * acciones condicionales para móviles y para escritorio
//  */

// if ( wp_is_mobile() ) {
//     add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail_mobile', 10);
//     add_action('woocommerce_before_shop_loop_item_title', 'renderizar_metadatos_mobile_shop_loop', 15);
//     add_action( 'woocommerce_before_shop_loop_item_title', 'mostrar_etiqueta_nuevo_producto', 15 );
//     remove_action('woocommerce_before_shop_loop_item_title', 'renderizar_card_front', 10);
//     remove_action('woocommerce_before_shop_loop_item_title', 'renderizar_card_back', 15);
// } else {
//     add_action( 'woocommerce_before_shop_loop_item_title', 'mostrar_etiqueta_nuevo_producto', 15 );
//     add_action('woocommerce_before_shop_loop_item_title', 'renderizar_card_back', 15);
//     add_action('woocommerce_before_shop_loop_item_title', 'renderizar_card_front', 10);
// }