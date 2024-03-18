<?php


/**
 * Shortcode con desplegable de artistas.
 *
 * @link https://stackoverflow.com/questions/56120607/make-a-dropdown-for-a-woocommerce-taxonomy-like-product-tags
 */

add_shortcode( 'product_tax_artist_dropdown', function( $atts ) {
    // Attributes
    $atts = shortcode_atts(
        [
        'hide_empty'   => '1', // or '0'
        'show_count'   => '1', // or '0'
        'orderby'      => 'name', // or 'order'
        'taxonomy'     => 'artist',
        ],
        $atts,
        'product_tax_artist_dropdown'
    );

    global $wp_query;

    $taxonomy      = $atts['taxonomy'];
    $taxonomy_name = get_taxonomy( $taxonomy )->labels->singular_name;

    ob_start();

    wp_dropdown_categories( [
        'hide_empty' => $atts['hide_empty'],
        'show_count' => $atts['show_count'],
        'orderby'    => $atts['orderby'],
        'selected'           => isset( $wp_query->query_vars[$taxonomy] ) ? $wp_query->query_vars[$taxonomy] : '',
        'show_option_none'   => sprintf( __( 'Select an %s', 'sage' ), $taxonomy_name ),
        'option_none_value'  => '',
        'value_field'        => 'slug',
        'taxonomy'   => $taxonomy,
        'name'       => $taxonomy,
        'class'      => 'dropdown_'.$taxonomy,
     ] );
    return ob_get_clean();
} );

/**
 * Rodear filtros de la tienda con un div.filtros -- inicio.
 */
add_action( 'woocommerce_before_shop_loop', function() {
    echo '<div class="relative flex flex-wrap justify-center p-6 filtros md:pt-12 md:pb-20">';
}, 20 );


add_action( 'woocommerce_before_shop_loop', function() {
    echo '<form class="fb_artist-ordering woocommerce-ordering">';
    echo do_shortcode('[product_tax_artist_dropdown]');
    echo '</form>';
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
 * Eliminar "Showing número de products".
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

/**
 * Eliminar "Sale!".
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

/**
 * Eliminar galería de producto.
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

/**
 * Eliminar breadcrumb y wraper divs.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10, 0 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10, 0 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

/**
 * Eliminar datos de single product summary.
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5, 0 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10, 0 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10, 0 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20, 0 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40, 0 );



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

add_action( 'template_redirect', 'template_redirect_action' );
function template_redirect_action() {
    if ( ! is_admin() && is_product() ) {
        add_filter( 'body_class', function ( $classes ) {
            global $post;
            $product = wc_get_product( $post->ID );
            $tipo    = $product->get_type();

            return array_merge( $classes, array( $tipo ) );
        } );
    }
}


/**
 * Eliminar ordenar por popularidad.
 * https://www.pixelninja.me/remove-woocommerce-product-sorting-options/
 */

// Customizes the WooCommerce product sorting options
// Available options are: menu_order, rating, date, popularity, price, price-desc

  add_filter( "woocommerce_catalog_orderby", function( $orderby ) {
    unset($orderby["popularity"]);
    return $orderby;
}, 20 );


/**
 * Eliminar reviews de single product y additional information tab.
 */
add_filter( 'woocommerce_after_shipping_calculator', function()  {
    echo '<div class="text-xs">' . get_field('exp_car_totals', 'option') . '</div>';
});

// ajax add to cart
// https://quadlayers.com/woocommerce-ajax-add-to-cart/

// add_action('wp_enqueue_scripts', function() {
//     if (function_exists('is_product') && is_product()) {
//        wp_enqueue_script('custom_script', get_bloginfo('stylesheet_directory') . '/js/ajax_add_to_cart.js', array('jquery'),'1.0' );
//     }
// });


// LOOP TIENDA
// _________________________________________________________________________________________________

/**
 * Mostrar etiqueta "new in shop" en los productos de la portada de la tienda.
 */
add_action( 'woocommerce_before_shop_loop_item_title', 'mostrar_etiqueta_nuevo_producto', 15 );

function mostrar_etiqueta_nuevo_producto() {
    global $product;
    // Verifica si el producto tiene la etiqueta "new in shop"
    if ( has_term( 'new-in-shop', 'product_tag', $product->get_id() ) ) {
        // Añade tu HTML personalizado para la etiqueta aquí
        echo '<span class="new-in-shop-badge">New in Shop</span>';
    }
}

/**
 * Mostrar artista en los productos de la portada de la tienda.
 */
add_action( 'woocommerce_shop_loop_item_title', 'mostrar_artista_producto', 11 );

function mostrar_artista_producto() {
    global $product;
    $artist_ids = wp_get_post_terms( $product->get_id(), 'artist', ['fields' => 'names'] );
    // Comprueba si hay artistas asignados y los imprime
    if ( !empty($artist_ids) ) {
        echo '<div class="font-bugrino text-xl mt-3">' . join(', ', $artist_ids) . '</div>';
    }
}



/**
 * Insert the opening anchor tag for products in the loop.
 */
// function woocommerce_template_loop_product_link_open() {
//     global $product;

//     $link = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product);

//     // Verificar si la cookie existe y es igual a 'true'
//     $is_mobile = isset($_COOKIE['is_mobile']) && $_COOKIE['is_mobile'] == 'true';

//     if ($is_mobile) {
//         echo '<a href="' . esc_url($link) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link mobile">';
//     } else {
//         echo '<a href="' . esc_url($link) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
//     }
// }

/**
 * mostrar tipo de impresión.
 */
function mostrar_tipo_producto() {
    global $product;

    // Usa un array para almacenar los tipos de impresión únicos
    $print_types = array();

    if ( $product->is_type( 'variable' ) ) {
        // Para productos variables, recolecta todos los valores de tipos de impresión
        $variations = $product->get_available_variations();
        foreach ( $variations as $variation ) {
            $variation_obj = new WC_Product_Variation( $variation['variation_id'] );
            $print_type = $variation_obj->get_attribute( 'pa_product-type' );
            if ( $print_type && !isset($print_types[$print_type]) ) {
                // Solo añade el tipo de impresión si aún no ha sido añadido
                $print_types[$print_type] = true;
            }
        }
    } else {
        // Para productos simples y otros tipos
        $print_type = $product->get_attribute( 'pa_product-type' );
        if ( $print_type ) {
            $print_types[$print_type] = true;
        }
    }

    // Muestra los tipos de impresión únicos
    foreach ($print_types as $print_type => $value) {
        echo '<div class="uppercase text-center border-b border-black w-full">' . esc_html( $print_type ) . '</div>';
    }
}


/**
 * mostrar información de producto en el loop de portada.
 */

 function mostrar_informacion_producto() {
    global $product;

    // Comprueba si el producto es variable
    if ( $product->is_type( 'variable' ) ) {
        $variations = $product->get_available_variations();
        foreach ( $variations as $variation ) {
            $variation_obj = new WC_Product_Variation($variation['variation_id']);
            $format = $variation_obj->get_attribute('pa_format'); // Asume que el slug del atributo de formato es 'pa_format'
            $price = $variation_obj->get_regular_price();
            $sale_price = $variation_obj->get_sale_price();

            echo '<li class="flex w-full justify-between border-t border-black px-2">';
            echo '<span class="grow">' . ($format ? esc_html( $format ) . ' cm' : '') . '</span>';
            if ( !empty($sale_price) && $sale_price < $price ) {
                echo '<span class="mr-4"><del>' . wc_price( $price ) . '</del></span>';
                echo '<span>' . wc_price( $sale_price ) . '</span>';
            } else {
                echo '<span></span>'; // Espacio para mantener la estructura cuando no hay precio de oferta
                echo '<span>' . wc_price( $price ) . '</span>';
            }
            echo '</li>';
        }
    } else {
        // Para productos simples y otros tipos
        $format = $product->get_attribute('pa_format');
        $price = $product->get_regular_price();
        $sale_price = $product->get_sale_price();

        echo '<li class="flex w-full justify-between border-t border-black px-2">';
        echo '<span class="grow">' . ($format ? esc_html( $format ) . ' cm' : '') . '</span>';
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
function woocommerce_template_loop_product_title() {
    echo '<h2 class=" uppercase text-center px-2 grow flex items-center ' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title' ) ) . '">' . get_the_title() . '</h2>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}